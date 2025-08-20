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

            // $nestedData['no'] = ++$no;
            // $nestedData['nota'] = $item->nota;
            // $nestedData['pelanggan_name'] = $item->pelanggan ? $item->pelanggan->name : 'No Customer';
            // $nestedData['email'] = $item->email;
            // $nestedData['phone'] = $item->phone;
            // $nestedData['address'] = $item->address;
            // $nestedData['brand'] = $item->brand;
            // $nestedData['model'] = $item->model;
            // $nestedData['reported_issue'] = $item->reported_issue;
            // $nestedData['serial_number'] = $item->serial_number;
            // $nestedData['technician_note'] = $item->technician_note ?: '-';
            // $nestedData['status'] = $item->status ?: 'Perangkat Baru Masuk';
            // $nestedData['price'] = $item->price ? 'Rp ' . number_format($item->price, 0, ',', '.') : '-';
            // $nestedData['created_at'] = $item->created_at ? $item->created_at->format('d/m/Y') : '-';
            // $nestedData['complete_in'] = $item->complete_in ? $item->complete_in->format('d/m/Y') : '-';
            // columns: 
            columns: [
                {data: 'no', name: 'no', title: 'No', width: '5%'},
                {data: 'nota', name: 'nota', title: 'Nota', width: '15%'},
                {data: 'pelanggan_name', name: 'pelanggan_name', title: 'Pelanggan', width: '15%'},
                {data: 'email', name: 'email', title: 'Email', width: '15%'},
                {data: 'phone', name: 'phone', title: 'Telepon', width: '15%'},
                {data: 'address', name: 'address', title: 'Alamat', width: '15%'},
                {data: 'brand', name: 'brand', title: 'Brand', width: '10%'},
                {data: 'model', name: 'model', title: 'Model', width: '10%'},
                {data: 'reported_issue', name: 'reported_issue', title: 'Masalah', width: '15%'},
                {data: 'serial_number', name: 'serial_number', title: 'SN', width: '10%'},
                {data: 'technician_note', name: 'technician_note', title: 'Catatan Teknisi', width: '15%'},
                {data: 'status', name: 'status', title: 'Status', width: '15%'},
                {data: 'price', name: 'price', title: 'Harga', width: '15%'},
                {data: 'created_at', name: 'created_at', title: 'Dibuat', width: '15%'},
                {data: 'complete_in', name: 'complete_in', title: 'Selesai', width: '15%'},
            ]

        });
    });
</script>
@endpush
