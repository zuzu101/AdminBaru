@extends('layouts.admin.app')

@section('header')
    <header class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Perbaharui Jadwal Talent</h1>
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.e-commerce.schedule.index') }}">Jadwal Talent</a>
                    </li>
                    <li class="breadcrumb-item active">Perbaharui Jadwal Talent</li>
                </ol>
            </div>
        </div>
    </header>
@endsection

@section('content')
    <div class="content-body">
        <form method="POST" action="{{ route('admin.e-commerce.schedule.update', ['schedule' => $schedule ]) }}" enctype="multipart/form-data">
            <div class="card">
                <div class="card-body">
                    @method('PATCH')
                    @csrf
                    <div class="form-group">
                        <label for="is_paid">Sudah Taking Content</label>
                        <select name="has_content" class="form-control" required>
                            <option value="0" {{ $schedule->has_content == 0 ? 'selected' : '' }}>Belum Taking Content</option>
                            <option value="1" {{ $schedule->has_content == 1 ? 'selected' : '' }}>Sudah Taking Content</option>
                        </select>
                    </div>

                    <hr>

                    <h2>Data Booking</h2>
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <label for="is_paid">Status Pembayaran</label>
                            <select name="is_paid" class="form-control" id="isPaidSelect" readonly>
                                <option value="0" {{ $schedule->is_paid == 0 ? 'selected' : '' }}>Belum Lunas</option>
                                <option value="1" {{ $schedule->is_paid == 1 ? 'selected' : '' }}>Sudah Lunas</option>
                            </select>
                        </div>

                        <div class="form-group col-lg-6" id="receiptContainer">
                            <label for="is_paid" class="d-block">Upload Bukti Pembayaran</label>
                            <a class="btn btn-primary btn-sm mt-2" target="_blank" href="{{ asset($schedule->receipt) }}">Lihat Bukti Pembayaran</a>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name">Id Order</label>
                            <input type="text" value="{{ $schedule->code }}" class="form-control" readonly>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name">Nama Penyewa / Pelanggan</label>
                            <input type="text" value="{{ $schedule->member->name ?? '' }}" class="form-control" readonly>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name">Tanggal Order</label>
                            <input type="date" value="{{ $schedule->created_at->format('Y-m-d') }}" class="form-control" readonly>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name">Email</label>
                            <input type="text" value="{{ $schedule->member->email ?? '' }}" class="form-control" readonly>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name">No telepon</label>
                            <input type="text" value="{{ $schedule->member->phone ?? '' }}" class="form-control" readonly>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name">Company / Perorangan</label>
                            <input type="text" value="{{ $schedule->member->category ?? '' }}" class="form-control" readonly>
                        </div>
                    </div>

                    <hr>

                    <h2>Data Pake & Talent</h2>
                    <table class="table table-bordered mb-4">
                        <thead>
                            <tr>
                                <th colspan="2">Nama Paket</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($prices as $price)
                            <tr>
                                <td colspan="2">{{ $price->name ?? '' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name">Nama Talent</label>
                            <input type="text" value="{{ $schedule->talent->name ?? '' }}" class="form-control" readonly>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name">Tanggal Event</label>
                            <input type="date" value="{{ $schedule->date }}" class="form-control" readonly>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name">Waktu Event</label>
                            <input type="time" value="{{ $schedule->time }}" class="form-control" readonly>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name">Durasi Event</label>
                            <input type="text" value="{{ $schedule->duration_total }}" class="form-control" readonly>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name">Total Harga</label>
                            <input type="text" value="Rp {{ $schedule->total_payment_format }}" class="form-control" readonly>
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

        $('#isPaidSelect').on('change', function() {
            let val = $(this).val()

            if(val == 1) {
                $('#receiptContainer').show()
            } else {
                $('#receiptContainer').hide()
            }
        })
    })
  </script>
@endpush
