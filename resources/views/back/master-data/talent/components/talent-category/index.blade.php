@extends('back.master-data.talent.show')

@section('categories')
<section class="card">
    <article class="card-header">
        <div class="float-right">
            <div class="btn-group">
                <button class="btn btn-success" id="createCategoryButton"><i class="fa fa-plus"></i></button>
            </div>
        </div>
    </article>
    <article class="card-body">
        <table class="table table-striped table-bordered" id="datatable">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </article>
</section>

<div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Tambah Kategori</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.master_data.talents.talent_categories.store', [$talent]) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="category_id">Pilih Kategori</label>
                        <select name="category_id" class="form-control" id="categorySelect"></select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success float-right">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
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
                url: "{{ route('admin.master_data.talents.talent_categories.data', [$talent]) }}",
                dataType: "json",
                type: "POST"
            },
            columns: [
                { data: 'no', name: 'no', className: "text-center align-middle"},
                { data: 'name', name: 'name', className: "align-middle" },
                { data: 'actions', name: 'actions', className: "align-middle", sortable: false },
            ]
        });
    });

    $('#createCategoryButton').click(function () {
        fetchCategories()
    })

    function fetchCategories() {
        $.ajax({
            url: "{{ route('admin.master_data.talents.talent_categories.get_categories_by_talent', [$talent]) }}",
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                let options = '<option value="">Pilih Kategori</option>'

                $.each(response, function() {
                    options += `<option value="${this.id}">${this.name}</option>`
                })

                $('#categorySelect').html(options).select2()
                $('#createCategoryModal').modal('show')
            }
        });
    }
</script>
@endpush
