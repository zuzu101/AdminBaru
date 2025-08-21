@extends('layouts.admin.app')

@section('header')
<header class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Riwayat Transaksi</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Riwayat Transaksix</li>
            </ol>
        </div>
    </div>
</header>
@endsection

@section('content')
<section class="card">
    <article class="card-header">
        <div class="float-right">
            <span class="text-muted">Cetak Nota / Struk Service</span>
        </div>
    </article>
    <article class="card-body">
        <table class="table table-striped table-bordered" id="datatable">
            <thead>
                <tr>
                    {{-- tabel untuk  --}}
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
                url: "{{ route('admin.cms.Transaction.data') }}",
                dataType: "json",
                type: "POST"
            },

            columns: [
                {data: 'no', name: 'no', title: 'No', autoWidth: true},
                {data: 'nota', name: 'nota', title: 'Nota', autoWidth: true},
                {data: 'pelanggan_name', name: 'pelanggan_name', title: 'Pelanggan', autoWidth: true},
                {data: 'email', name: 'email', title: 'Email', autoWidth: true},
                {data: 'phone', name: 'phone', title: 'Telepon', autoWidth: true},
                {data: 'address', name: 'address', title: 'Alamat', autoWidth: true},
                {data: 'brand', name: 'brand', title: 'Brand', autoWidth: true},
                {data: 'model', name: 'model', title: 'Model', autoWidth: true},
                {data: 'reported_issue', name: 'reported_issue', title: 'Masalah', autoWidth: true},
                {data: 'serial_number', name: 'serial_number', title: 'SN', autoWidth: true},
                {data: 'technician_note', name: 'technician_note', title: 'Catatan Teknisi', autoWidth: true},
                {data: 'status', name: 'status', title: 'Status', autoWidth: true},
                {data: 'price', name: 'price', title: 'Harga', autoWidth: true},
                {data: 'created_at', name: 'created_at', title: 'Dibuat', autoWidth: true},
                {data: 'complete_in', name: 'complete_in', title: 'Selesai', autoWidth: true},
            ]

        });
    });
</script>
@endpush
