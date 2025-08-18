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
    $(function() {
        $('#datatable').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            pageLength: 10,
            pagingType: "simple_numbers",
            ajax: {
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                url: "{{ route('admin.cms.DeviceRepair.data') }}",
                dataType: "json",
                type: "POST"
            },
            //column for DeviceRepair
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

    function deleteDeviceRepair(id) {
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            $.ajax({
                url: "{{ route('admin.cms.DeviceRepair.index') }}/" + id,
                method: 'DELETE',
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                success: function(response) {
                    if (response.message) {
                        alert('Data berhasil dihapus');
                        $('#datatable').DataTable().ajax.reload();
                    }
                },
                error: function(xhr) {
                    alert('Error saat menghapus data');
                }
            });
        }
    }
</script>
@endpush