@extends('layouts.admin.app')

@section('header')
<header class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Order Talent</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Order Talent</li>
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
                    <th>Id Order</th>
                    <th>Tanggal Order</th>
                    <th>Nama Pemesan</th>
                    <th>Talent</th>
                    <th>Tanggal Booking</th>
                    <th>Durasi</th>
                    <th>Status Bayar</th>
                    <th>Aksi</th>
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
                url: "{{ route('admin.e-commerce.booking.is_paid.data') }}",
                dataType: "json",
                type: "POST"
            },
            columns: [
                { data: 'no', name: 'no', className: "text-center align-middle"},
                { data: 'code', name: 'code', className: "align-middle" },
                { data: 'created_at_format', name: 'created_at_format', className: "align-middle" },
                { data: 'member_name', name: 'member_name', className: "align-middle" },
                { data: 'talent_name', name: 'talent_name', className: "align-middle" },
                { data: 'date_format', name: 'date_format', className: "align-middle" },
                { data: 'duration_total', name: 'duration_total', className: "align-middle" },
                { data: 'is_paid_label', name: 'is_paid_label', className: "align-middle" },
                { data: 'actions', name: 'actions', className: "align-middle", sortable: false },
            ]
        });
    });
</script>
@endpush
