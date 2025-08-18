@extends('layouts.admin.app')

@section('header')
<header class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Status</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Status</li>
            </ol>
        </div>
    </div>
</header>
@endsection

@section('content')
<section class="card">
    <article class="card-header">
        <div class="float-right">
            <div class="btn-group">
                <button type="button" class="btn btn-danger fw-bold" onclick="filterStatus('Perangkat Baru Masuk')">Baru</button>
                <button type="button" class="btn btn-primary fw-bold" onclick="filterStatus('Sedang Diperbaiki')">Dikerjakan</button>
                <button type="button" class="btn btn-success fw-bold" onclick="filterStatus('Selesai')">Selesai</button>
                <button type="button" class="btn btn-secondary fw-bold" onclick="filterStatus('all')">Semua</button>
            </div>
        </div>
    </article>
    <article class="card-body">
        <table class="table table-striped table-bordered" id="datatable">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Pelanggan</th>
                    <th>Merek</th>
                    <th>Model</th>
                    <th>Masalah</th>
                    <th>Nomor Seri</th>
                    <th>Catatan Teknisi</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </article>
</section>
@endsection

@push('js')
<script>
    let dataTable;
    
    $(function() {
        dataTable = $('#datatable').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            pageLength: 10,
            pagingType: "simple_numbers",
            ajax: {
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                url: "{{ route('admin.cms.Status.data') }}",
                dataType: "json",
                type: "POST",
                data: function(d) {
                    d.status_filter = $('#status_filter').val();
                }
            },
            columns: [
                { data: 'no', name: 'no', className: "text-center align-middle" },
                { data: 'pelanggan_name', name: 'pelanggan_name', className: "align-middle" },
                { data: 'brand', name: 'brand', className: "align-middle" },
                { data: 'model', name: 'model', className: "align-middle" },
                { data: 'reported_issue', name: 'reported_issue', className: "align-middle" },
                { data: 'serial_number', name: 'serial_number', className: "align-middle" },
                { data: 'technician_note', name: 'technician_note', className: "align-middle" },
                { data: 'status', name: 'status', className: "align-middle" },
                { data: 'actions', name: 'actions', className: "align-middle", sortable: false, searchable: false }
            ]
        });
    });

    function filterStatus(status) {
        // Set nilai filter
        if (!$('#status_filter').length) {
            $('body').append('<input type="hidden" id="status_filter" value="">');
        }
        
        $('#status_filter').val(status === 'all' ? '' : status);
        
        // Update button aktif
        $('.btn-group button').removeClass('active');
        $('button[onclick="filterStatus(\'' + status + '\')"]').addClass('active');
        
        // Reload DataTable dengan filter baru
        dataTable.ajax.reload();
    }

    function deleteStatus(id) {
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            $.ajax({
                url: "{{ route('admin.cms.Status.index') }}/" + id,
                method: 'DELETE',
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                success: function(response) {
                    if (response.message) {
                        alert('Data berhasil dihapus');
                        dataTable.ajax.reload();
                    }
                },
                error: function(xhr) {
                    alert('Error saat menghapus data');
                }
            });
        }
    }
    
    function updateStatus(id, status) {
        if (confirm('Apakah Anda yakin ingin mengubah status perangkat ini ke "' + status + '"?')) {
            $.ajax({
                url: "{{ route('admin.cms.Status.index') }}/" + id + '/update-status',
                method: 'POST',
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                data: {
                    status: status
                },
                success: function(response) {
                    if (response.message) {
                        alert('Status berhasil diperbarui');
                        dataTable.ajax.reload();
                    }
                },
                error: function(xhr) {
                    alert('Error saat memperbarui status');
                    console.log(xhr.responseText);
                }
            });
        }
    }
</script>
@endpush