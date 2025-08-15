@extends('layouts.admin.app')

@section('header')
    <header class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Talent</h1>
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.master_data.talents.index') }}">Talent</a>
                    </li>
                    <li class="breadcrumb-item active">Tambah Talent</li>
                </ol>
            </div>
        </div>
    </header>
@endsection

@section('content')
    <div class="content-body">
        <form method="POST" action="{{ route('admin.master_data.talents.store') }}" enctype="multipart/form-data">
            <div class="card">
                <div class="card-body">
                    @csrf
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" class="form-control">
                            <option value="Pending" >Pending</option>
                            <option value="Review" >Review</option>
                            <option value="Approved" >Approved</option>
                            <option value="Rejected" >Rejected</option>
                        </select>
                    </div>

                    <hr>

                    <h4>Nilai Paras & Talenta</h4>
                    <div class="form-row">
                        <div class="col-lg-6 form-group">
                            <label for="appereance">Nilai Paras</label>
                            <select name="appereance" class="form-control">
                                <option value="Cakep Banget">Cakep Banget</option>
                                <option value="Cakep">Cakep</option>
                                <option value="B Saja">B Saja</option>
                                <option value="Low End">Low End</option>
                            </select>
                        </div>

                        <div class="col-lg-6 form-group">
                            <label for="appereance">Seni & Hiburan</label>
                            <select name="talent_art[]" class="form-control select2-multiple-input" multiple="multiple">
                                @foreach ($artCategories as $artCategory)
                                    <option
                                        value="{{ $artCategory->name }}">
                                    {{ $artCategory->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-6 form-group">
                            <label for="appereance">Kategori Konten Kreator</label>
                            <select name="talent_content[]" class="form-control select2-multiple-input" multiple="multiple">
                                <option value="Influencer">
                                    Influencer
                                </option>

                                <option value="Youtuber">
                                    Youtuber
                                </option>

                                <option value="Tiktok Content Creator">
                                    Tiktok Content Creator
                                </option>

                                <option value="Blogger/Vlogger">
                                    Blogger/Vlogger
                                </option>

                                <option value="Podcaster">
                                    Podcaster
                                </option>

                                <option value="Voice Over">
                                    Voice Over
                                </option>
                            </select>
                        </div>

                        <div class="col-lg-6 form-group">
                            <label for="appereance">Kategori Profesional</label>
                            <select name="talent_professional[]" class="form-control select2-multiple-input" multiple="multiple">
                                @foreach ($professionalCategories as $professionalCategory)
                                    <option
                                        value="{{ $professionalCategory->name }}">
                                    {{ $professionalCategory->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <hr>

                    <h4>Data Diri</h4>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name">Nama</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name">Tempat Lahir </label>
                            <input type="text" class="form-control" name="birth_place" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="birth_date">Tanggal Lahir </label>
                            <input type="date" name="birth_date" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label class="d-block" for="name">Jenis Kelamin </label>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" value="Pria">
                                <label class="form-check-label" for="exampleRadios1">
                                    Laki-laki
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" value="Wanita">
                                <label class="form-check-label" for="exampleRadios1">
                                    Perempuan
                                </label>
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <label class="body-1 color-text" for="address">Alamat Lengkap</label>
                            <textarea class="form-control" name="address" required></textarea>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="body-1 color-text" for="phone">Nomor Telepon </label>
                            <input type="tel" name="phone" class="form-control" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="body-1 color-text" for="name">Email</label>
                            <input type="text" name="email" class="form-control" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="d-block" for="name">Status Pernikahan </label>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="marriage_status" value="Belum Menikah">
                                <label class="form-check-label" for="exampleRadios1">
                                    Belum Menikah
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="marriage_status" value="Menikah" >
                                <label class="form-check-label" for="exampleRadios1">
                                    Menikah
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="marriage_status" value="Lainnya" >
                                <label class="form-check-label" for="exampleRadios1">
                                    Lainnya: Janda/Duda
                                </label>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="cv">Cv</label>
                            <input type="file" name="cv" class="form-control">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="description">Deskripsi</label>
                            <textarea name="description" class="form-control" id="descriptionInput" rows="4"></textarea>
                        </div>
                    </div>

                    <hr>

                    <h4>Sosial Media</h4>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="instagram">Instagram</label>
                            <input type="text" name="instagram" class="form-control" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="tiktok">Tiktok</label>
                            <input type="text" name="tiktok" class="form-control" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="facebook">Facebook</label>
                            <input type="text" name="facebook" class="form-control" required>
                        </div>
                    </div>

                    <hr>
                    <h4>Pendidikan</h4>
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <label class="d-block" for="name">Pendidikan Terakhir </label>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="education_level" value="SD">
                                <label class="form-check-label" for="exampleRadios1">
                                    SD
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="education_level" value="SMP" >
                                <label class="form-check-label" for="exampleRadios1">
                                    SMP
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="education_level" value="SMA/SMK">
                                <label class="form-check-label" for="exampleRadios1">
                                    SMA/SMK
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="education_level" value="S1">
                                <label class="form-check-label" for="exampleRadios1">
                                    S1
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="education_level" value="S2">
                                <label class="form-check-label" for="exampleRadios1">
                                    S2
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="education_level" value="S3">
                                <label class="form-check-label" for="exampleRadios1">
                                    S3
                                </label>
                            </div>
                        </div>
                        <div class="form-group col-lg-6">
                            <label class="body-1 color-text" for="name">Nama Institusi </label>
                            <input type="text" name="education_institution" class="form-control" required>
                        </div>
                        <div class="form-group col-lg-6">
                            <label class="body-1 color-text" for="name">Jurusan </label>
                            <input type="text" name="education_major" class="form-control" required>
                        </div>
                        <div class="form-group col-lg-6">
                            <label class="body-1 color-text" for="name">Tahun Lulus </label>
                            <input type="number" name="education_year" class="form-control" required>
                        </div>
                    </div>

                    <hr>
                    <h4>Pengalaman Kerja</h4>
                    <div id="pengalamanKerjaAppendContainer">
                    </div>
                    <button class="btn btn-block btn-primary" type="button" id="btnAddPengalamanKerja">Tambah Pengalaman Kerja</button>

                    <hr>
                    <h4>Foto Profile</h4>
                    <div class="form-row" style="row-gap: 24px">
                        <section class="form-group col-lg-6">
                            <label for="">Tampak Depan</label>
                            <input type="file" name="talent_photo[]" class="form-control p-1" required>
                        </section>
                        <section class="form-group col-lg-6">
                            <label for="">Tampak Kanan</label>
                            <input type="file" name="talent_photo[]" class="form-control p-1" required>
                        </section>
                        <section class="form-group col-lg-6">
                            <label for="">Tampak Kiri</label>
                            <input type="file" name="talent_photo[]" class="form-control p-1" required>
                        </section>
                        <section class="form-group col-lg-6">
                            <label for="">Pose Terbaik</label>
                            <input type="file" name="talent_photo[]" class="form-control p-1" required>
                        </section>
                    </div>

                    <hr>
                    <h4>Pengalaman Berdasar Talent</h4>
                    <div id="pengalamanBerdasarTalentAppendContainer">
                    </div>
                    <button class="btn btn-block btn-primary"  type="button" id="btnAddPengalamanBerdasarTalent">Tambah Pengalaman Berdasar Talent (Maks 10)</button>

                    <hr>
                    <h4>Portofolio</h4>
                    <div id="portofolioAppendContainer">
                    </div>
                    <button type="button" id="btnAddPortofolio" class="btn btn-block btn-primary">Tambah Portofolio (Maks 10)</button>

                    <hr>
                    <h4>Video Perkenalan</h4>
                    <input type="text" name="introduction_link" class="form-control">

                    <hr>
                    <h4>Rate Harga</h4>
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <label for="">Jam/Hari</label>
                            <input type="text" name="rate_period" class="form-control p-1">
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="">Rate</label>
                            <input type="rate" id="rateInput" name="rate_rate" class="form-control p-1">
                        </div>

                        <div class="form-group col-lg-12">
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

        $('#descriptionInput').summernote({
            height: 200, // Change the height here
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
