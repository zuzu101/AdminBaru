@extends('layouts.admin.app')

@section('header')
<header class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Data Pelanggan</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Pelanggan</li>
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
                <a href="{{ route('admin.cms.pelanggan.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Pelanggan</a>
            </div>
        </div>
    </article>
    <article class="card-body">
        <table class="table table-striped table-bordered" id="datatable">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No. HP</th>
                    <th>Alamat</th>
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
                url: "{{ route('admin.cms.pelanggan.data') }}",
                dataType: "json",
                type: "POST"
            },
            columns: [
                { data: 'no', name: 'no', className: "text-center align-middle" },
                { data: 'name', name: 'name', className: "align-middle" },
                { data: 'email', name: 'email', className: "align-middle" },
                { data: 'phone', name: 'phone', className: "align-middle" },
                { data: 'address', name: 'address', className: "align-middle" },
                { data: 'actions', name: 'actions', className: "align-middle", sortable: false, searchable: false },
            ]
        });
    });

    function deletePelanggan(id) {
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            $.ajax({
                url: "{{ route('admin.cms.pelanggan.index') }}/" + id,
                method: 'DELETE',
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                success: function(response) {
                    if (response.success) {
                        alert('Data berhasil dihapus');
                        $('#datatable').DataTable().ajax.reload();
                    }
                }
            });
        }
    }
</script>
@endpush