@extends('layouts.admin.app')

@section('header')
    <header class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Client</h1>
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.master_data.members.index') }}">Client</a>
                    </li>
                    <li class="breadcrumb-item active">Tambah Client</li>
                </ol>
            </div>
        </div>
    </header>
@endsection

@section('content')
    <div class="content-body">
        <form id="form-validation" action="{{ route('admin.master_data.members.store') }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-body form-row">
                    <section class="col-lg-6 form-group">
                        <label class="body-1 color-text" for="name">Full Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </section>

                    <section class="col-lg-6 form-group">
                        <label class="body-1 color-text" for="category">Personal / Company</label>
                        <select name="category" class="form-control" id="categorySelect" required>
                            <option value="" selected disabled>Select Category</option>
                            <option value="Personal">Personal</option>
                            <option value="Company">Company</option>
                        </select>
                    </section>

                    <section class="col-lg-6 form-group" id="companyNameInput" style="display: none">
                        <label class="body-1 color-text" for="company_name">Company Name</label>
                        <input type="text" class="form-control" name="company_name">
                    </section>

                    <section class="col-lg-6 form-group">
                        <label class="body-1 color-text" for="email">Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </section>

                    <section class="col-lg-6 form-group">
                        <label class="body-1 color-text" for="phone">Phone Number</label>
                        <input type="tel" class="form-control" name="phone" required>
                    </section>

                    <section class="col-lg-12 form-group">
                        <label class="body-1 color-text" for="address">Address</label>
                        <textarea class="form-control" name="address" rows="3" required></textarea>
                    </section>

                    <section class="col-lg-6 form-group">
                        <label class="body-1 color-text" for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </section>

                    <section class="col-lg-6 form-group">
                        <label class="body-1 color-text" for="">Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control" required>
                    </section>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success float-right">Register Account</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('js')
  <script>
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
