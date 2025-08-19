@extends('layouts.admin.app')

@section('header')
    <header class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Device</h1>
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.cms.DeviceRepair.index') }}">Device</a>
                    </li>
                    <li class="breadcrumb-item active">Perbaharui Device</li>
                </ol>
            </div>
        </div>
    </header>
@endsection

@section('content')
    <div class="content-body">
        <form method="POST" action="{{ route('admin.cms.DeviceRepair.update', $deviceRepair) }}" enctype="multipart/form-data">
            <div class="card">
                <div class="card-body">
                    @method('PATCH')
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="pelanggan_id">Pelanggan</label>
                            <select name="pelanggan_id" id="pelanggan_id" class="form-control select2" required>
                                <option value="">Ketik nama pelanggan...</option>
                                @foreach(\App\Models\Cms\Pelanggan::all() as $pelanggan)
                                    <option value="{{ $pelanggan->id }}" {{ $deviceRepair->pelanggan_id == $pelanggan->id ? 'selected' : '' }}>
                                        {{ $pelanggan->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="brand">Brand</label>
                            <input type="text" name="brand" value="{{ $deviceRepair->brand }}" class="form-control" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="model">Model</label>
                            <input type="text" name="model" value="{{ $deviceRepair->model }}" class="form-control" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="reported_issue">Reported Issue</label>
                            <input type="text" name="reported_issue" value="{{ $deviceRepair->reported_issue }}" class="form-control" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="serial_number">Serial Number</label>
                            <input type="text" name="serial_number" value="{{ $deviceRepair->serial_number }}" class="form-control" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="technician_note">Technician Note</label>
                            <textarea name="technician_note" class="form-control">{{ $deviceRepair->technician_note }}</textarea>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="status">Status</label>
                            <select name="status" class="form-control" required>
                                <option value="Perangkat Baru Masuk" {{ $deviceRepair->status == 'Perangkat Baru Masuk' ? 'selected' : '' }}>Perangkat Baru Masuk</option>
                                <option value="Sedang Diperbaiki" {{ $deviceRepair->status == 'Sedang Diperbaiki' ? 'selected' : '' }}>Sedang Diperbaiki</option>
                                <option value="Selesai" {{ $deviceRepair->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="price">Estimasi Biaya</label>
                            <input type="number" name="price" value="{{ $deviceRepair->price }}" class="form-control" min="0" step="0.01" placeholder="0.00">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="complete_in">Target Selesai</label>
                            <input type="date" name="complete_in" value="{{ $deviceRepair->complete_in ? $deviceRepair->complete_in->format('Y-m-d') : '' }}" class="form-control">
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
        // Initialize Select2 for pelanggan field
        $('#pelanggan_id').select2({
            placeholder: 'Ketik nama pelanggan...',
            allowClear: true,
            width: '100%',
            theme: 'bootstrap-5'
        });

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
