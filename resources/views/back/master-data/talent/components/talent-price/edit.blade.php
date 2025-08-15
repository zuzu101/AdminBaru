@extends('layouts.admin.app')

@section('header')
    <header class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Perbaharui Harga Paket</h1>
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.master_data.talents.index') }}">Talent</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.master_data.talents.talent_price.index', [$talent]) }}">{{ $talent->name }} / Harga Paket</a>
                    </li>
                    <li class="breadcrumb-item active">Perbaharui Harga Paket</li>
                </ol>
            </div>
        </div>
    </header>
@endsection

@section('content')
    <div class="content-body">
        <form method="POST" action="{{ route('admin.master_data.talents.talent_price.update', [$talent, $talentPrice]) }}" enctype="multipart/form-data">
            <div class="card">
                <div class="card-body">
                    @method('PATCH')
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name">Nama Paket</label>
                            <input type="text" name="name" value="{{ $talentPrice->name }}" class="form-control" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="price">Harga</label>
                            <input type="text" name="price" value="{{ $talentPrice->format_price }}" id="priceInput" class="form-control" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="session">Sesi</label>
                            <input type="text" name="session" value="{{ $talentPrice->session }}" class="form-control" required>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="description">Deskripsi</label>
                            <textarea name="description" class="form-control" id="descriptionInput" rows="4" required>{{ $talentPrice->description }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success float-right">
                        <i class="la la-check-square-o"></i> Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('js')
  <script>
    $(document).ready(function() {
        $('#form-validation').validate({
            rules: {},
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        })

        $('#priceInput').on('input', function () {
            let formattedRupiah = numberFormatToRupiah($(this).val());

            return $(this).val(formattedRupiah)
        })

        $('#descriptionInput').summernote({
            height: 300, // Change the height here
        })
    })
  </script>
@endpush
