@extends('layouts.admin.app')

@section('header')
    <header class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Perbaharui Talent - {{ $talent->name }}</h1>
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.master_data.talents.index') }}">Talent</a>
                    </li>
                    <li class="breadcrumb-item active">Perbaharui Talent {{ $talent->name }}</li>
                </ol>
            </div>
        </div>
    </header>
@endsection

@section('content')
<a class="btn btn-primary mb-4" href="{{ route('admin.master_data.talents.index') }}">
    <i class="fas fa-arrow-left mr-2"></i>
    Kembali ke halaman Talent
</a>

<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
      <a class="nav-link {{ Route::is('admin.master_data.talents.show') ? 'active' : '' }}" href="{{ route('admin.master_data.talents.show', $talent->id) }}" id="nav-profile-tab"  role="tab" aria-controls="nav-profile" aria-selected="true">Data Diri</a>
      <a class="nav-link {{ Route::is('admin.master_data.talents.talent_rating.*') ? 'active' : '' }}" href="{{ route('admin.master_data.talents.talent_rating.index', $talent->id) }}" id="nav-rating-tab" aria-controls="nav-rating" aria-selected="false">Rating</a>
      <a class="nav-link {{ Route::is('admin.master_data.talents.talent_price.*') ? 'active' : '' }}" href="{{ route('admin.master_data.talents.talent_price.index', $talent->id) }}" id="nav-prices-tab" aria-controls="nav-prices" aria-selected="false">Harga Paket</a>
      <a class="nav-link {{ Route::is('admin.master_data.talents.talent_photo.*') ? 'active' : '' }}" href="{{ route('admin.master_data.talents.talent_photo.index', $talent->id) }}" id="nav-photos-tab" aria-controls="nav-photos" aria-selected="false">Foto - Foto</a>
      <a class="nav-link {{ Route::is('admin.master_data.talents.talent_spotlight.*') ? 'active' : '' }}" href="{{ route('admin.master_data.talents.talent_spotlight.index', $talent->id) }}" id="nav-spotlight-tab" aria-controls="nav-spotlight" aria-selected="false">Spotlight</a>
      <a class="nav-link {{ Route::is('admin.master_data.talents.talent_categories.*') ? 'active' : '' }}" href="{{ route('admin.master_data.talents.talent_categories.index', $talent->id) }}" id="nav-categories-tab" aria-controls="nav-categories" aria-selected="false">Kategori</a>
    </div>
</nav>

<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade {{ Route::is('admin.master_data.talents.show') ? 'show active' : '' }}" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">@yield('profile')</div>
    <div class="tab-pane fade {{ Route::is('admin.master_data.talents.talent_rating.*') ? 'show active' : '' }}" id="nav-rating" role="tabpanel" aria-labelledby="nav-rating-tab">@yield('rating')</div>
    <div class="tab-pane fade {{ Route::is('admin.master_data.talents.talent_price.*') ? 'show active' : '' }}" id="nav-prices" role="tabpanel" aria-labelledby="nav-prices-tab">@yield('prices')</div>
    <div class="tab-pane fade {{ Route::is('admin.master_data.talents.talent_photo.*') ? 'show active' : '' }}" id="nav-photos" role="tabpanel" aria-labelledby="nav-photos-tab">@yield('photos')</div>
    <div class="tab-pane fade {{ Route::is('admin.master_data.talents.talent_spotlight.*') ? 'show active' : '' }}" id="nav-spotlight" role="tabpanel" aria-labelledby="nav-spotlight-tab">@yield('spotlight')</div>
    <div class="tab-pane fade {{ Route::is('admin.master_data.talents.talent_categories.*') ? 'show active' : '' }}" id="nav-categories" role="tabpanel" aria-labelledby="nav-categories-tab">@yield('categories')</div>
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
