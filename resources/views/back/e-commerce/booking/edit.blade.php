@extends('layouts.admin.app')

@section('header')
    <header class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Perbaharui Order Booking</h1>
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.e-commerce.booking.is_paid') }}">Order Talent</a>
                    </li>
                    <li class="breadcrumb-item active">Perbaharui Order Booking</li>
                </ol>
            </div>
        </div>
    </header>
@endsection

@section('content')
    <div class="content-body">
        <form method="POST" action="{{ route('admin.e-commerce.booking.update', $booking) }}" enctype="multipart/form-data">
            <div class="card">
                <div class="card-body">
                    @method('PATCH')
                    @csrf
                    <div class="form-group">
                        <label for="is_paid">Status Pembayaran</label>
                        <select name="is_paid" class="form-control" id="isPaidSelect">
                            <option value="0" {{ $booking->is_paid == 0 ? 'selected' : '' }}>Belum Lunas</option>
                            <option value="1" {{ $booking->is_paid == 1 ? 'selected' : '' }}>Sudah Lunas</option>
                        </select>
                    </div>

                    <div class="form-group" id="receiptContainer" style="display: none">
                        <label for="is_paid">Upload Bukti Pembayaran</label>
                        <input type="file" class="form-control" name="receipt" required>
                    </div>

                    <hr>

                    <h2>Data Booking</h2>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name">Id Order</label>
                            <input type="text" value="{{ $booking->code }}" class="form-control" readonly>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name">Nama Penyewa / Pelanggan</label>
                            <input type="text" value="{{ $booking->member->name ?? '' }}" class="form-control" readonly>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name">Tanggal Order</label>
                            <input type="date" value="{{ $booking->created_at->format('Y-m-d') }}" class="form-control" readonly>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name">Email</label>
                            <input type="text" value="{{ $booking->member->email ?? '' }}" class="form-control" readonly>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name">No telepon</label>
                            <input type="text" value="{{ $booking->member->phone ?? '' }}" class="form-control" readonly>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name">Company / Perorangan</label>
                            <input type="text" value="{{ $booking->member->category ?? '' }}" class="form-control" readonly>
                        </div>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between mb-3">
                        <h2>Data Pake & Talent</h2>
                    </div>
                    <table class="table table-bordered mb-4">
                        <thead>
                            <tr>
                                <th>Nama Paket</th>
                                <th>Harga Paket</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($prices as $price)
                            <tr>
                                <td>{{ $price->name ?? '' }}</td>
                                <td>
                                    Rp {{ $price->format_price ?? '' }}
                                    <input type="hidden" class="pricesInput" value="{{ $price->price ?? '' }}">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name">Nama Talent</label>
                            <select name="talent_id" class="form-control" readonly>
                                @foreach ($talents as $talent)
                                <option value="{{ $talent->id }}" {{ $booking->talent_id == $talent->id ? 'selected' : '' }}>{{ $talent->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name">Tanggal Event</label>
                            <input type="date" name="date" value="{{ $booking->date }}" class="form-control" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name">Waktu Event</label>
                            <input type="time" name="time" value="{{ $booking->time }}" class="form-control" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name">Durasi Event (Jam)</label>
                            <input type="number" name="duration" value="{{ $booking->duration }}" id="durationInput" class="form-control" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name">Total Harga</label>
                            <input type="text" value="Rp {{ $booking->total_payment_format }}" class="form-control" id="totalPaymentLabel" readonly>
                            <input type="hidden" name="total_payment" value="{{ $booking->total_payment }}" id="totalPayment">
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

        $('#durationInput').on('input', function () {
            calculateTotalPayment()
        })

        function calculateTotalPayment() {
            let total = 0
            let duration = $('#durationInput').val()

            $.each($('body').find('.pricesInput'), function (index) {
                let price = parseInt(this.value)
                total += price
                parseInt(total)
            })

            total = total * duration;

            $('#totalPayment').val(total)
            $('#totalPaymentLabel').val(`Rp ${numberFormatToRupiah(total.toString())}`)
        }

        function numberFormatToRupiah(number, prefix) {
            var number_string = number.replace(/[^,\d]/g, '').toString(),
            split   = number_string.split(','),
            over    = split[0].length % 3,
            rupiah  = split[0].substr(0, over),
            thousand  = split[0].substr(over).match(/\d{3}/gi);

            if(thousand){
                separator = over ? '.' : '';
                rupiah += separator + thousand.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
        }
    })
  </script>
@endpush
