@extends('layouts.admin.app')

@section('header')
    <header class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Device Repair</h1>
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.cms.DeviceRepair.index') }}">Device Repair</a>
                    </li>
                    <li class="breadcrumb-item active">Tambah Device Repair</li>
                </ol>
            </div>
        </div>
    </header>
@endsection

@section('content')
    <div class="content-body">
        <form id="form-validation" method="POST" action="{{ route('admin.cms.DeviceRepair.store') }}" enctype="multipart/form-data">
            <div class="card">
                <div class="card-body">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="pelanggan_id">Pelanggan</label>
                            <select name="pelanggan_id" class="form-control" required>
                                <option value="">Pilih Pelanggan</option>
                                @foreach(\App\Models\Cms\Pelanggan::all() as $pelanggan)
                                    <option value="{{ $pelanggan->id }}">{{ $pelanggan->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="brand">Brand</label>
                            <input type="text" name="brand" class="form-control" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="model">Model</label>
                            <input type="text" name="model" class="form-control" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="reported_issue">Reported Issue</label>
                            <textarea name="reported_issue" class="form-control" required></textarea>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="serial_number">Serial Number</label>
                            <input type="text" name="serial_number" class="form-control" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="technician_note">Technician Note</label>
                            <textarea name="technician_note" class="form-control"></textarea>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="status">Status</label>
                            <select name="status" class="form-control" required>
                                <option value="Perangkat Baru Masuk">Perangkat Baru Masuk</option>
                                <option value="Sedang Diperbaiki">Sedang Diperbaiki</option>
                                <option value="Menunggu Spare Part">Menunggu Spare Part</option>
                                <option value="Selesai Diperbaiki">Selesai Diperbaiki</option>
                                <option value="Siap Diambil">Siap Diambil</option>
                                <option value="Sudah Diambil">Sudah Diambil</option>
                            </select>
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

        $('#descriptionInput').summernote({
            height: 300, // Change the height here
        })
    })
  </script>
@endpush
