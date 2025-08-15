@extends('back.master-data.talent.show')

@section('rating')
<section class="card">
    <article class="card-header">
        <div class="float-right">
            <div class="btn-group">
                <a href="{{ route('admin.master_data.talents.talent_rating.create', $talent) }}" class="btn btn-success"><i class="fa fa-plus"></i></a>
            </div>
        </div>
    </article>
    <article class="card-body">
        <table class="table table-striped table-bordered" id="datatable">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Client</th>
                    <th>Rating</th>
                    <th>Status</th>
                    <th>Comment</th>
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
                url: "{{ route('admin.master_data.talents.talent_rating.data', [$talent]) }}",
                dataType: "json",
                type: "POST"
            },
            columns: [
                { data: 'no', name: 'no', className: "text-center align-middle"},
                { data: 'name', name: 'name', className: "align-middle" },
                { data: 'rating', name: 'rating', className: "align-middle" },
                { data: 'status', name: 'status', className: "align-middle" },
                { data: 'comment', name: 'comment', className: "align-middle" },
                { data: 'actions', name: 'actions', className: "align-middle", sortable: false },
            ]
        });
    });
</script>
@endpush
