@extends('layouts.common.app')

@section('content')
<header class="page-header">
    <div class="container-fluid">

        <div class="row justify-content-center">
            <section class="col-lg-6">
                <h1 class="text-center header-title mb-2">Come And Join With Us</h1>
                <p class="text-center body-1 color-text">
                    Jangan lewatkan kesempatan untuk menjadi bagian dari sesuatu yang luar biasa. Daftarkan diri Anda sekarang dan jadilah bagian dari komunitas kami yang terus berkembang.
                </p>
                <p class="text-center body-1 color-text mb-32">
                    Already have an account?
                    <a class="color-primary" href="{{ route('talent.auth.login.index') }}">Sign In Talent Here</a>
                </p>

                <div class="card auth-card">
                    <div class="card-body">
                        <form id="form-validation" action="{{ route('talent.auth.registers.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="description" value="-">
                            <section class="form-group" id="nilaiParasMu">
                                <h2 class="heading-2 text-white font-weight-600">Nilai Parasmu</h2>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="appereance" value="Cakep Banget" checked>
                                    <label class="form-check-label" for="appereance">
                                      Cakep Banget
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="appereance" value="Cakep">
                                    <label class="form-check-label" for="appereance">
                                      Cakep
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="appereance" value="B Saja">
                                    <label class="form-check-label" for="appereance">
                                      B Saja
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="appereance" value="Low End">
                                    <label class="form-check-label" for="appereance">
                                      Low End
                                    </label>
                                </div>
                            </section>

                            <hr class="border-white">

                            <h2 class="heading-2 text-white font-weight-600">Talentamu (Boleh memilih dari satu)</h2>
                            <section class="form-group" id="seniDanHiburan">
                                <label class="body-1 color-text" for="name">Seni dan Hiburan </label>
                                @foreach ($artCategories as $artCategory)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="talent_art[]" value="{{ $artCategory->name }}" {{ $loop->first ? 'checked' : '' }}>
                                    <label class="form-check-label" for="exampleRadios1">
                                      {{ $artCategory->name }}
                                    </label>
                                </div>
                                @endforeach

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="seniDanHiburanOthers">
                                    <label class="form-check-label" for="exampleRadios2">
                                      Isian Text
                                    </label>
                                </div>
                                <div id="seniDanHiburanOthersInput" style="display: none">
                                    <select name="talent_art[]" class="form-control" id="seniDanHiburanOthersSelect" multiple="multiple"></select>

                                    <small class="body-2 text-white">Tambahkan kategori seni dan hiburan dengan cara menginput nama yang di inginkan lalu tekan enter</small>
                                </div>
                            </section>
                            <section class="form-group" id="kategoriKontenKreator">
                                <label class="body-1 color-text" for="name">Kategori Konten Kreator </label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="talent_content[]" value="Influencer" checked>
                                    <label class="form-check-label" for="talent_content1">
                                      Influencer
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="talent_content[]" value="Youtuber">
                                    <label class="form-check-label" for="talent_content">
                                      Youtuber
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="talent_content[]" value="Tiktok Content Creator">
                                    <label class="form-check-label" for="talent_content">
                                      Tiktok Content Creator
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="talent_content[]" value="Blogger/Vlogger">
                                    <label class="form-check-label" for="talent_content2">
                                      Blogger/Vlogger
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="talent_content[]" value="Podcaster">
                                    <label class="form-check-label" for="talent_content2">
                                      Podcaster
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="talent_content[]" value="Voice Over">
                                    <label class="form-check-label" for="talent_content2">
                                      Voice Over
                                    </label>
                                </div>
                            </section>
                            <section class="form-group" id="kategoriProfesional">
                                <label class="body-1 color-text" for="name">Kategori Profesional</label>
                                @foreach ($professionalCategories as $professionalCategory)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="talent_professional[]" value="{{ $professionalCategory->name }}" {{ $loop->first ? 'checked' : '' }}>
                                    <label class="form-check-label" for="talent_professional[]">
                                      {{ $professionalCategory->name }}
                                    </label>
                                </div>
                                @endforeach
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"  id="kategoriProfesionalOthers">
                                    <label class="form-check-label" for="talentProfessional">
                                      Lainnya
                                    </label>
                                </div>
                                <div id="kategoriProfesionalOthersInput" style="display: none">
                                    <select name="talent_professional[]" class="form-control" id="kategoriProfesionalOthersSelect" multiple="multiple"></select>

                                    <small class="body-2 text-white">Tambahkan kategori seni dan hiburan dengan cara menginput nama yang di inginkan lalu tekan enter</small>
                                </div>
                            </section>

                            <hr class="border-white">

                            <h2 class="heading-2 text-white font-weight-600">Data Pribadi</h2>
                            <section class="form-group">
                                <label class="body-1 color-text" for="name">Nama Lengkap </label>
                                <input type="text" name="name" class="form-control" required>
                            </section>
                            <section class="form-group">
                                <label class="body-1 color-text" for="name">Tempat Lahir </label>
                                <input type="text" class="form-control" name="birth_place" required>
                            </section>
                            <section class="form-group">
                                <label class="body-1 color-text" for="birth_date">Tanggal Lahir </label>
                                <input type="date" name="birth_date" class="form-control" required>
                            </section>
                            <section class="form-group">
                                <label class="body-1 color-text" for="name">Jenis Kelamin </label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" value="Pria" >
                                    <label class="form-check-label" for="exampleRadios1">
                                        Laki-laki
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" value="Wanita" checked>
                                    <label class="form-check-label" for="exampleRadios1">
                                        Perempuan
                                    </label>
                                </div>
                            </section>
                            <section class="form-group">
                                <label class="body-1 color-text" for="address">Alamat Lengkap </label>
                                <textarea class="form-control" name="address" required></textarea>
                            </section>
                            <section class="form-group">
                                <label class="body-1 color-text" for="phone">Nomor Telepon </label>
                                <input type="tel" name="phone" class="form-control" required>
                            </section>
                            <section class="form-group">
                                <label class="body-1 color-text" for="name">Email</label>
                                <input type="text" name="email" class="form-control" required>
                            </section>
                            <section class="form-group">
                                <label class="body-1 color-text" for="name">Instagram</label>
                                <input type="text" class="form-control" name="instagram" required>
                            </section>
                            <section class="form-group">
                                <label class="body-1 color-text" for="name">Tiktok </label>
                                <input type="text" name="tiktok" class="form-control" required>
                            </section>
                            <section class="form-group">
                                <label class="body-1 color-text" for="name">Facebook</label>
                                <input type="text" name="facebook" class="form-control">
                            </section>
                            <section class="form-group">
                                <label class="body-1 color-text" for="name">Status Pernikahan </label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="marriage_status" value="Belum Menikah" checked>
                                    <label class="form-check-label" for="exampleRadios1">
                                        Belum Menikah
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="marriage_status" value="Menikah">
                                    <label class="form-check-label" for="exampleRadios1">
                                        Menikah
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="marriage_status" value="Lainnya" >
                                    <label class="form-check-label" for="exampleRadios1">
                                        Lainnya: Janda/Duda
                                    </label>
                                </div>
                            </section>

                            <hr class="border-white">

                            <h2 class="heading-2 text-white font-weight-600">Pendidikan</h2>
                            <section class="form-group">
                                <label class="body-1 color-text" for="name">Pendidikan Terakhir </label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="education_level" value="SD">
                                    <label class="form-check-label" for="exampleRadios1">
                                        SD
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="education_level" value="SMP">
                                    <label class="form-check-label" for="exampleRadios1">
                                        SMP
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="education_level" value="SMA/SMK">
                                    <label class="form-check-label" for="exampleRadios1">
                                        SMA/SMK
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="education_level" value="S1" checked>
                                    <label class="form-check-label" for="exampleRadios1">
                                        S1
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="education_level" value="S2">
                                    <label class="form-check-label" for="exampleRadios1">
                                        S2
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="education_level" value="S3">
                                    <label class="form-check-label" for="exampleRadios1">
                                        S3
                                    </label>
                                </div>
                            </section>
                            <section class="form-group">
                                <label class="body-1 color-text" for="name">Nama Institusi </label>
                                <input type="text" name="education_institution" class="form-control" required>
                            </section>
                            <section class="form-group">
                                <label class="body-1 color-text" for="name">Jurusan </label>
                                <input type="text" name="education_major" class="form-control" required>
                            </section>
                            <section class="form-group">
                                <label class="body-1 color-text" for="name">Tahun Lulus </label>
                                <input type="number" name="education_year" class="form-control" required>
                            </section>

                            <hr class="border-white">

                            <h2 class="heading-2 text-white font-weight-600">Pengalaman Kerja</h2>
                            <div id="pengalamanKerjaAppendContainer">
                                <div>
                                    <section class="form-group">
                                        <label class="body-1 color-text" for="name">Perusahaan Terakhir 1</label>
                                        <input type="text" name="work_company[]" class="form-control" required>
                                    </section>
                                    <section class="form-group">
                                        <label class="body-1 color-text" for="name">Posisi/Jabatan </label>
                                        <input type="text" name="work_position[]" class="form-control" required>
                                    </section>
                                    <section class="form-group">
                                        <label class="body-1 color-text" for="name">Periode Kerja </label>
                                        <input type="text" name="work_period[]" class="form-control" required>
                                    </section>
                                    <section class="form-group">
                                        <label class="body-1 color-text" for="name">Deskripsi Tugas </label>
                                        <input type="text" name="work_description[]" class="form-control" required>
                                    </section>
                                    <section class="form-group">
                                        <label class="body-1 color-text" for="name">Alasan Berhenti </label>
                                        <input type="text" name="work_quit[]" class="form-control" required>
                                    </section>
                                </div>
                            </div>

                            <button class="btn btn-block btn-layout" type="button" id="btnAddPengalamanKerja">Tambah Pengalaman Kerja</button>

                            <hr class="border-white">

                            <h2 class="heading-2 text-white font-weight-600">Foto Profile</h2>
                            <p class="body-1 text-white ">Upload Foto Diri Kamu</p>
                            <section class="form-group">
                                <label for="">Tampak Depan</label>
                                <input type="file" name="talent_photo[]" class="form-control p-1" required>
                            </section>
                            <section class="form-group">
                                <label for="">Tampak Kanan</label>
                                <input type="file" name="talent_photo[]" class="form-control p-1" required>
                            </section>
                            <section class="form-group">
                                <label for="">Tampak Kiri</label>
                                <input type="file" name="talent_photo[]" class="form-control p-1" required>
                            </section>
                            <section class="form-group">
                                <label for="">Pose Terbaik</label>
                                <input type="file" name="talent_photo[]" class="form-control p-1" required>
                            </section>

                            <hr class="border-white">

                            <h2 class="heading-2 text-white font-weight-600">Pengalaman Berdasar Talent</h2>
                            <div id="pengalamanBerdasarTalentAppendContainer">

                            </div>
                            <button class="btn btn-block btn-layout"  type="button" id="btnAddPengalamanBerdasarTalent">Tambah Pengalaman Berdasar Talent (Maks 10)</button>

                            <hr class="border-white">

                            <h2 class="heading-2 text-white font-weight-600">Share Portofolio Mu</h2>
                            <div id="portofolioAppendContainer">
                            </div>
                            <button type="button" id="btnAddPortofolio" class="btn btn-block btn-layout">Tambah Portofolio (Maks 10)</button>

                            <hr class="border-white">

                            <h2 class="heading-2 text-white font-weight-600">Upload Video Perkenalan Mu</h2>
                            <section class="form-group">
                                <label for="">Link (Wajib Link Youtube)</label>
                                <input type="text" name="introduction_link" class="form-control p-1" required>
                            </section>

                            <hr class="border-white">

                            <h2 class="heading-2 text-white font-weight-600">Pilih Rate Hargamu</h2>
                            <section class="form-group">
                                <label for="">Jam/Hari</label>
                                <input type="text" name="rate_period" class="form-control p-1">
                            </section>

                            <section class="form-group">
                                <label for="">Rate</label>
                                <input type="rate" id="rateInput" name="rate_rate" class="form-control p-1">
                            </section>

                            <section class="form-group">
                                <label for="">Hari Terbaik Memanggil Mu</label>
                                <select class="form-control mb-3" name="rate_call_day" required>
                                    <option value="" disabled selected>Pilih Hari</option>
                                    <option value="0">Minggu</option>
                                    <option value="1">Senin</option>
                                    <option value="2">Selasa</option>
                                    <option value="3">Rabu</option>
                                    <option value="4">Kamis</option>
                                    <option value="5">Jum'at</option>
                                    <option value="6">Sabtu</option>
                                </select>
                                <input type="time" name="rate_call_time" class="form-control" required>
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
<link rel="stylesheet" href="{{ asset('/back_assets/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('/back_assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/pages/member/register.css') }}">
@endpush

@push('js')
<script src="{{ asset('back_assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('back_assets/plugins/jquery-validation/additional-methods.min.js') }}"></script>
<script src="{{ asset('/back_assets/plugins/select2/js/select2.full.min.js') }}"></script>

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

    // Validation Scripts
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

        $('#form-validation').submit(function (e) {
            if($(this).valid()) {
                Swal.fire({
                    title: 'Loading...',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    onBeforeOpen: () => {
                        Swal.showLoading();
                    }
                });
            } else {
                e.preventDefault()
            }
        })

        $('#seniDanHiburanOthersSelect').select2({
            tags: true,
        });

        $('#kategoriProfesionalOthersSelect').select2({
            tags: true,
        });
    })

    // Seni Dan hiburan
    $('#seniDanHiburanOthers').click(function () {
        if($(this).is(':checked')) {
            $('#seniDanHiburanOthersInput').show();
        } else {
            $('#seniDanHiburanOthersInput').hide();
        }
    })


    // Kategori Profesional
    $('#kategoriProfesionalOthers').click(function () {
        if($(this).is(':checked')) {
            $('#kategoriProfesionalOthersInput').show();
        } else {
            $('#kategoriProfesionalOthersInput').hide();
        }
    })


    // Pengalaman Kerja Scripts
    $('#btnAddPengalamanKerja').click(function () {
        let counting = $('#pengalamanKerjaAppendContainer').children().length + 1
        let randomString = generateRandomString()

        if(counting > 10) {
            return Swal.fire({
                icon: 'error',
                title: 'Melebihi Batas Maksimal',
                text: 'Portofolio maksimal 10',
            })
        }

        $('#pengalamanKerjaAppendContainer').append(pengalamanKerjaTags(counting, randomString));
    })

    function pengalamanKerjaTags(counting, randomString) {
        return `
        <div id="pengalamanKerjaContainer-${randomString}">
            <hr style="border-color: #555555" class="my-3">
            <section class="form-group">
                <div class="d-flex mb-2">
                    <label class="body-1 color-text" for="name">
                        Perusahaan Terakhir
                        <span class="countingNumber">${counting}</span>
                    </label>
                    <button type="button" class="btn btn-danger btn-sm ml-2 btnDeletePengalamanKerja" data-uniqid="${randomString}">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
                <input type="work_company[]" class="form-control" required>
            </section>
            <section class="form-group">
                <label class="body-1 color-text" for="name">Posisi/Jabatan </label>
                <input type="text" name="work_position[]" class="form-control" required>
            </section>
            <section class="form-group">
                <label class="body-1 color-text" for="name">Periode Kerja </label>
                <input type="text" name="work_period[]" class="form-control" required>
            </section>
            <section class="form-group">
                <label class="body-1 color-text" for="name">Deskripsi Tugas </label>
                <input type="text" name="work_description[]" class="form-control" required>
            </section>
            <section class="form-group">
                <label class="body-1 color-text" for="name">Alasan Berhenti </label>
                <input type="text" name="work_quit[]" class="form-control" required>
            </section>
        </div>
        `
    }

    $('body').on('click', '.btnDeletePengalamanKerja', function () {
        let uniqid = $(this).data('uniqid')

        $('body').find(`#pengalamanKerjaContainer-${uniqid}`).remove()

        $('#pengalamanKerjaAppendContainer').children().each(function(index) {
            $(this).find('label').each(function() {
                $(this).text($(this).text().replace(/([0-9]+)/, index + 1))
            })
        })
    })


    // Pengalaman Berdasar Talent Scripts
    $('#btnAddPengalamanBerdasarTalent').click(function () {
        let counting = $('#pengalamanBerdasarTalentAppendContainer').children().length + 1
        let randomString = generateRandomString()

        if(counting > 10) {
            return Swal.fire({
                icon: 'error',
                title: 'Melebihi Batas Maksimal',
                text: 'Portofolio maksimal 10',
            })
        }

        $('#pengalamanBerdasarTalentAppendContainer').append(pengalamanBerdasarTalentTags(counting, randomString));
    })

    function pengalamanBerdasarTalentTags(counting, randomString) {
        return `
        <div id="pengalamanBerdasarTalentContainer-${randomString}">
            <hr style="border-color: #555555" class="my-3">
            <section class="form-group">
                <div class="d-flex">
                    <label for="">
                        Talenta <span class="countingNumber">${counting}</span>
                    </label>
                    <button type="button" class="btn btn-danger btn-sm ml-2 btnDeletePengalamanBerdasarTalent" data-uniqid="${randomString}">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
                <input type="text" name="experience_skill[]" class="form-control p-1" required>
            </section>
            <section class="form-group">
                <label for="">Durasi (tahun/bulan)</label>
                <input type="text" name="experience_period[]" class="form-control p-1" required>
            </section>
            <section class="form-group">
                <label for="">Link</label>
                <input type="text" name="experience_link[]" class="form-control p-1" required>
            </section>
        </div>
        `
    }

    $('body').on('click', '.btnDeletePengalamanBerdasarTalent', function () {
        let uniqid = $(this).data('uniqid')

        $('body').find(`#pengalamanBerdasarTalentContainer-${uniqid}`).remove()

        $('#pengalamanBerdasarTalentAppendContainer').children().each(function(index) {
            $(this).find('label').each(function() {
                $(this).text($(this).text().replace(/([0-9]+)/, index + 1))
            })
        })
    })


    // Portofolio Scripts
    $('#btnAddPortofolio').click(function () {
        let counting = $('#portofolioAppendContainer').children().length + 1
        let randomString = generateRandomString()

        if(counting > 10) {
            return Swal.fire({
                icon: 'error',
                title: 'Melebihi Batas Maksimal',
                text: 'Portofolio maksimal 10',
            })
        }

        $('#portofolioAppendContainer').append(portofolioTags(counting, randomString));
    })

    function portofolioTags(counting, randomString) {
        return `
        <div id="portofolioContainer-${randomString}">
            <hr style="border-color: #555555" class="my-3">
            <section class="form-group">
                <div class="d-flex">
                    <label for="">
                        Nama Talenta <span class="countingNumber">${counting}</span>
                    </label>

                    <button type="button" class="btn btn-danger btn-sm ml-2 btnDeletePortofolio" data-uniqid="${randomString}">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
                <input type="text" name="portofolio_skill[]" class="form-control p-1" required>
            </section>
            <section class="form-group">
                <label for="">Link (Wajib Link Youtube)</label>
                <input type="text" name="portofolio_link[]" class="form-control p-1" required>
            </section>
        </div>
        `
    }

    $('body').on('click', '.btnDeletePortofolio', function () {
        let uniqid = $(this).data('uniqid')

        $('body').find(`#portofolioContainer-${uniqid}`).remove()

        $('#portofolioAppendContainer').children().each(function(index) {
            $(this).find('label').each(function() {
                $(this).text($(this).text().replace(/([0-9]+)/, index + 1))
            })
        })
    })

    // Rate
    $('#rateInput').on('input', function () {
        let rate = $(this).val()
        let rateInteger = parseInt(rate.replace(/\./g, ''));

        let experienceCounting = $('#pengalamanBerdasarTalentAppendContainer').children().length
        let portofolioCounting = $('#portofolioAppendContainer').children().length
        let totalCounting = experienceCounting + portofolioCounting

        if(totalCounting == 0 && rateInteger > 10000) {
            Swal.fire({
                icon: 'error',
                title: 'Rate Terlalu tinggi',
                text: 'Rate mu ketinggian, talent dengan tanpa pengalaman biasanya mulai dari rate Rp 10.000',
            })

            $(this).val(numberFormatToRupiah('10000'))
        } else {
            $(this).val(numberFormatToRupiah(rateInteger.toString()))
        }
    })

    // Utilities
    function generateRandomString() {
        let randomString = Math.random().toString(36).substr(2, 5)

        return randomString
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
</script>
@endpush
