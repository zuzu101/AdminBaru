@extends('layouts.admin.app')

@section('header')
    <header class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Rating Talent</h1>
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.master_data.talents.index') }}">Talent</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.master_data.talents.talent_rating.index', [$talent]) }}">{{ $talent->name }} / Talent </a>
                    </li>
                    <li class="breadcrumb-item active">Tambah Talent </li>
                </ol>
            </div>
        </div>
    </header>
@endsection

@section('content')
    <div class="content-body">
        <form id="form-validation" method="POST" action="{{ route('admin.master_data.talents.talent_rating.store', [$talent]) }}" enctype="multipart/form-data">
            <div class="card">
                <div class="card-body">
                    @csrf
                    <div class="form-row">
                        <input type="hidden" name="talent_id" value="{{ $talent->id }}">

                        <div class="form-group col-md-6">
                            <label for="member_id">Client</label>
                            <select name="member_id" class="form-control select2" id="">
                                <option value="" disabled selected>Pilih Client</option>
                                @foreach ($members as $member)
                                    <option value="{{ $member->id }}">{{ $member->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="">Rating</label>
                            <select name="rating" class="form-control">
                                <option value="" disabled selected>Berikan Rating</option>
                                <option value="5">5 - Sangat Baik</option>
                                <option value="4">4 - Baik</option>
                                <option value="3">3 - Cukup</option>
                                <option value="2">2 - Kurang</option>
                                <option value="1">1 - Buruk</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="status">Status</label>
                            <select name="status" class="form-control">
                                <option value="0">Belum Aktif</option>
                                <option value="1">Sudah Aktif</option>
                            </select>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="comment">Komentar</label>
                            <textarea name="comment" rows="4" class="form-control" placeholder="Komentar Disini"></textarea>
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
    })
  </script>
@endpush
