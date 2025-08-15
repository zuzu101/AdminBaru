@extends('layouts.common.app')

@section('content')
<header class="page-header">
    <div class="container-fluid">

        <div class="row justify-content-center">
            <section class="col-lg-6">
                <div class="card auth-card">
                    <h1 class="text-center header-title mb-2">Come And Join With Us</h1>
                    <p class="text-center body-1 color-text">
                        Jangan lewatkan kesempatan untuk menjadi bagian dari sesuatu yang luar biasa. Daftarkan diri Anda sekarang dan jadilah bagian dari komunitas kami yang terus berkembang.
                    </p>
                    <p class="text-center body-1 color-text mb-32">
                        Already have an account?
                        <a class="color-primary" href="{{ route('member.auth.login.index') }}">Sign In Client Here</a>
                    </p>

                    <div class="card-body">
                        <form id="form-validation" action="{{ route('member.auth.registers.store') }}" method="POST">
                            @csrf
                            <section class="form-group">
                                <label class="body-1 color-text" for="name">Full Name</label>
                                <input type="text" class="form-control" name="name" required>
                            </section>

                            <section class="form-group">
                                <label class="body-1 color-text" for="category">Personal / Company</label>
                                <select name="category" class="form-control" id="categorySelect" required>
                                    <option value="" selected disabled>Select Category</option>
                                    <option value="Personal">Personal</option>
                                    <option value="Company">Company</option>
                                </select>
                            </section>

                            <section class="form-group" id="companyNameInput" style="display: none">
                                <label class="body-1 color-text" for="company_name">Company Name</label>
                                <input type="text" class="form-control" name="company_name">
                            </section>

                            <section class="form-group">
                                <label class="body-1 color-text" for="email">Email</label>
                                <input type="email" class="form-control" name="email" required>
                            </section>

                            <section class="form-group">
                                <label class="body-1 color-text" for="phone">Phone Number</label>
                                <input type="tel" class="form-control" name="phone" required>
                            </section>

                            <section class="form-group">
                                <label class="body-1 color-text" for="address">Address</label>
                                <textarea class="form-control" name="address" rows="3" required></textarea>
                            </section>

                            <section class="form-group">
                                <label class="body-1 color-text" for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="password" required>
                            </section>

                            <section class="form-group">
                                <label class="body-1 color-text" for="">Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control" required>
                            </section>

                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn header-btn">Register Account</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
</header>
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('css/pages/member/register.css') }}">
@endpush

@push('js')
<script src="{{ asset('back_assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('back_assets/plugins/jquery-validation/additional-methods.min.js') }}"></script>
<script>
    jQuery.extend(jQuery.validator.messages, {
        required: "Formulir ini wajib diisi.",
        email: "Isi dengan email yang valid.",
        url: "Isi dengan URL yang valid.",
        date: "Isi dengan tanggal yang valid",
        dateISO: "Please enter a valid date (ISO).",
        number: "Isi dengan angka yang valid",
        digits: "Hanya boleh memasukkan angka.",
        creditcard: "Harap masukkan nomor kartu kredit yang benar.",
        equalTo: "Harap masukkan kembali nilai yang sama.",
        accept: "Harap masukkan nilai dengan ekstensi yang valid.",
        maxlength: jQuery.validator.format("Harap masukkan tidak lebih dari {0} karakter."),
        minlength: jQuery.validator.format("Harap masukkan setidaknya {0} karakter."),
        rangelength: jQuery.validator.format("Harap masukkan nilai antara {0} dan {1} karakter."),
        range: jQuery.validator.format("Harap masukkan nilai antara {0} dan {1}."),
        max: jQuery.validator.format("Harap masukkan nilai kurang dari atau sama dengan {0}."),
        min: jQuery.validator.format("Harap masukkan nilai yang lebih besar dari atau sama dengan {0}.")
    })

    $(document).ready(function() {
        $('#form-validation').validate({
            rules: {
                phone: {
                    digits: true
                },
                password: {
                    minlength: 8
                },
                confirm_password: {
                    equalTo: '#password'
                }
            },
            messages: {
                confirm_password: {
                    equalTo: 'Password tidak sama'
                }
            },
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

        $('#categorySelect').change(function () {
            var selectedValue = $(this).val();

            if (selectedValue === 'Company') {
                $('#companyNameInput').show();
            } else {
                $('#companyNameInput').hide();
            }
        })
    })
</script>
@endpush
