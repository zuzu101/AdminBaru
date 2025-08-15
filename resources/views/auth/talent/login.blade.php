@extends('layouts.common.app')

@section('content')
<header class="page-header">
    <div class="container-fluid">
        <h1 class="text-center header-title mb-2">Login Your Talent Account Here</h1>
        <p class="text-center body-1 color-text mb-32">
            Don't have an account yet?
            <a class="color-primary" href="{{ route('talent.auth.registers.index') }}">Register Talent Here</a>
        </p>

        <div class="row justify-content-center">
            <section class="col-lg-5">
                <div class="card auth-card">
                    <div class="card-body">
                        <form action="{{ route('talent.auth.login.authentication') }}" method="POST">
                            @csrf
                            <section class="form-group">
                                <label class="body-1 color-text" for="">Phone Number</label>
                                <input type="tel" name="phone" class="form-control" required>
                            </section>

                            <section class="form-group">
                                <label class="body-1 color-text" for="">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </section>

                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn header-btn">Login Account</button>
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
<link rel="stylesheet" href="{{ asset('css/pages/member/login.css') }}">
@endpush
