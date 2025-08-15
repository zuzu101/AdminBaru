@extends('back.master-data.talent.show')

@section('profile')
<div class="content-body">
    <form method="POST" action="{{ route('admin.master_data.talents.update', $talent->id) }}" enctype="multipart/form-data">
        <div class="card">
            <div class="card-body">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" class="form-control">
                        <option value="Pending" {{ $talent->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Review" {{ $talent->status == 'Review' ? 'selected' : '' }}>Review</option>
                        <option value="Approved" {{ $talent->status == 'Approved' ? 'selected' : '' }}>Approved</option>
                        <option value="Rejected" {{ $talent->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>

                <hr>

                <h4>Nilai Paras & Talenta</h4>
                <div class="form-row">
                    <div class="col-lg-6 form-group">
                        <label for="appereance">Nilai Paras</label>
                        <select name="appereance" class="form-control">
                            <option {{ $talent->appereance === 'Cakep Banget' ? 'selected' : '' }} value="Cakep Banget">Cakep Banget</option>
                            <option {{ $talent->appereance === 'Cakep' ? 'selected' : '' }} value="Cakep">Cakep</option>
                            <option {{ $talent->appereance === 'B Saja' ? 'selected' : '' }} value="B Saja">B Saja</option>
                            <option {{ $talent->appereance === 'Low End' ? 'selected' : '' }} value="Low End">Low End</option>
                        </select>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label for="appereance">Seni & Hiburan</label>
                        <select name="talent_art[]" class="form-control select2-multiple-input" multiple="multiple">
                            @foreach ($artCategories as $artCategory)
                                <option
                                    {{ in_array($artCategory->name, $talent->talentArts->pluck('name')->toArray()) ? 'selected' : '' }}
                                    value="{{ $artCategory->id }}">
                                {{ $artCategory->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label for="appereance">Kategori Konten Kreator</label>
                        <select name="talent_content[]" class="form-control select2-multiple-input" multiple="multiple">
                            <option value="Influencer" {{ in_array('Influencer', $talent->talentContents->pluck('name')->toArray()) ? 'selected' : '' }}>
                                Influencer
                            </option>

                            <option value="Youtuber" {{ in_array('Youtuber', $talent->talentContents->pluck('name')->toArray()) ? 'selected' : '' }}>
                                Youtuber
                            </option>

                            <option value="Tiktok Content Creator" {{ in_array('Tiktok Content Creator', $talent->talentContents->pluck('name')->toArray()) ? 'selected' : '' }}>
                                Tiktok Content Creator
                            </option>

                            <option value="Blogger/Vlogger" {{ in_array('Blogger/Vlogger', $talent->talentContents->pluck('name')->toArray()) ? 'selected' : '' }}>
                                Blogger/Vlogger
                            </option>

                            <option value="Podcaster" {{ in_array('Podcaster', $talent->talentContents->pluck('name')->toArray()) ? 'selected' : '' }}>
                                Podcaster
                            </option>

                            <option value="Voice Over" {{ in_array('Voice Over', $talent->talentContents->pluck('name')->toArray()) ? 'selected' : '' }}>
                                Voice Over
                            </option>
                        </select>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label for="appereance">Kategori Profesional</label>
                        <select name="talent_professional[]" class="form-control select2-multiple-input" multiple="multiple">
                            @foreach ($professionalCategories as $professionalCategory)
                                <option
                                    {{ in_array($professionalCategory->name, $talent->talentProfessionals->pluck('name')->toArray()) ? 'selected' : '' }}
                                    value="{{ $professionalCategory->id }}">
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
                        <input type="text" name="name" value="{{ $talent->name }}" class="form-control" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="name">Tempat Lahir </label>
                        <input type="text" class="form-control" value="{{ $talent->birth_place }}" name="birth_place" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="birth_date">Tanggal Lahir </label>
                        <input type="date" name="birth_date" value="{{ $talent->birth_date }}" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label class="d-block" for="name">Jenis Kelamin </label>
                        <div class="form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" value="Pria" {{ $talent->gender == 'Pria' ? 'checked' : '' }}>
                            <label class="form-check-label" for="exampleRadios1">
                                Laki-laki
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" value="Wanita" {{ $talent->gender == 'Wanita' ? 'checked' : '' }}>
                            <label class="form-check-label" for="exampleRadios1">
                                Perempuan
                            </label>
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <label class="body-1 color-text" for="address">Alamat Lengkap</label>
                        <textarea class="form-control" name="address" required>{{ $talent->address }}</textarea>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="body-1 color-text" for="phone">Nomor Telepon </label>
                        <input type="tel" name="phone" class="form-control" value="{{ $talent->phone }}" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="body-1 color-text" for="name">Email</label>
                        <input type="text" name="email" class="form-control" value="{{ $talent->email }}" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="d-block" for="name">Status Pernikahan </label>
                        <div class="form-check-inline">
                            <input class="form-check-input" type="radio" name="marriage_status" value="Belum Menikah" {{ $talent->marriage_status == 'Belum Menikah' ? 'checked' : '' }}>
                            <label class="form-check-label" for="exampleRadios1">
                                Belum Menikah
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <input class="form-check-input" type="radio" name="marriage_status" value="Menikah" {{ $talent->marriage_status == 'Menikah' ? 'checked' : '' }}>
                            <label class="form-check-label" for="exampleRadios1">
                                Menikah
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <input class="form-check-input" type="radio" name="marriage_status" value="Lainnya" {{ $talent->marriage_status == 'Lainnya' ? 'checked' : '' }}>
                            <label class="form-check-label" for="exampleRadios1">
                                Lainnya: Janda/Duda
                            </label>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="cv">Cv</label>
                        <input type="file" name="cv" class="form-control">
                        @if ($talent->cv)
                            <a href="{{ asset($talent->cv) }}" target="_blank" class="btn btn-sm btn-primary mt-2">Lihat Gambar</a>
                        @endif
                    </div>

                    <div class="form-group col-md-12">
                        <label for="description">Deskripsi</label>
                        <textarea name="description" class="form-control" id="descriptionInput" rows="4">{{ $talent->description }}</textarea>
                    </div>
                </div>

                <hr>

                <h4>Sosial Media</h4>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="instagram">Instagram</label>
                        <input type="text" name="instagram" value="{{ $talent->instagram }}" class="form-control" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="tiktok">Tiktok</label>
                        <input type="text" name="tiktok" value="{{ $talent->tiktok }}" class="form-control" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="facebook">Facebook</label>
                        <input type="text" name="facebook" value="{{ $talent->facebook }}" class="form-control" required>
                    </div>
                </div>

                <hr>
                <h4>Pendidikan</h4>
                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <label class="d-block" for="name">Pendidikan Terakhir </label>
                        <div class="form-check-inline">
                            <input class="form-check-input" type="radio" name="education_level" value="SD" {{ $talent->talentEducation->education_level ?? '' == 'SD' ? 'checked' : '' }}>
                            <label class="form-check-label" for="exampleRadios1">
                                SD
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <input class="form-check-input" type="radio" name="education_level" value="SMP" {{ $talent->talentEducation->education_level ?? '' == 'SMP' ? 'checked' : '' }}>
                            <label class="form-check-label" for="exampleRadios1">
                                SMP
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <input class="form-check-input" type="radio" name="education_level" value="SMA/SMK" {{ $talent->talentEducation->education_level ?? '' == 'SMA/SMK' ? 'checked' : '' }}>
                            <label class="form-check-label" for="exampleRadios1">
                                SMA/SMK
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <input class="form-check-input" type="radio" name="education_level" value="S1" {{ $talent->talentEducation->education_level ?? '' == 'S1' ? 'checked' : '' }}>
                            <label class="form-check-label" for="exampleRadios1">
                                S1
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <input class="form-check-input" type="radio" name="education_level" value="S2" {{ $talent->talentEducation->education_level ?? '' == 'S2' ? 'checked' : '' }}>
                            <label class="form-check-label" for="exampleRadios1">
                                S2
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <input class="form-check-input" type="radio" name="education_level" value="S3" {{ $talent->talentEducation->education_level ?? '' == 'S3' ? 'checked' : '' }}>
                            <label class="form-check-label" for="exampleRadios1">
                                S3
                            </label>
                        </div>
                    </div>
                    <div class="form-group col-lg-6">
                        <label class="body-1 color-text" for="name">Nama Institusi </label>
                        <input type="text" name="education_institution" value="{{ $talent->talentEducation->institution_name ?? '' }}" class="form-control" required>
                    </div>
                    <div class="form-group col-lg-6">
                        <label class="body-1 color-text" for="name">Jurusan </label>
                        <input type="text" name="education_major" value="{{ $talent->talentEducation->major ?? '' }}" class="form-control" required>
                    </div>
                    <div class="form-group col-lg-6">
                        <label class="body-1 color-text" for="name">Tahun Lulus </label>
                        <input type="number" name="education_year" value="{{ $talent->talentEducation->graduation_year ?? '' }}" class="form-control" required>
                    </div>
                </div>

                <hr>
                <h4>Pengalaman Kerja</h4>
                <div id="pengalamanKerjaAppendContainer">
                    @foreach ($talent->talentWorkExperiences as $workExperience)
                    @if (!$loop->first)
                        <hr class="col-lg-12" style="border-color: #555555" class="my-3">
                    @endif
                    <div class="form-row">
                        <input type="hidden" name="edit_work_id[]" value="{{ $workExperience->id }}">
                        <section class="form-group col-lg-6">
                            <label class="body-1 color-text" for="name">Perusahaan Terakhir {{ $loop->iteration }}</label>
                            <input type="text" name="edit_work_company[]" class="form-control" value="{{ $workExperience->company }}" required>
                        </section>
                        <section class="form-group col-lg-6">
                            <label class="body-1 color-text" for="name">Posisi/Jabatan </label>
                            <input type="text" name="edit_work_position[]" class="form-control" value="{{ $workExperience->position }}" required>
                        </section>
                        <section class="form-group col-lg-6">
                            <label class="body-1 color-text" for="name">Periode Kerja </label>
                            <input type="text" name="edit_work_period[]" class="form-control" value="{{ $workExperience->employment_period }}" required>
                        </section>
                        <section class="form-group col-lg-6">
                            <label class="body-1 color-text" for="name">Deskripsi Tugas </label>
                            <input type="text" name="edit_work_description[]" class="form-control" value="{{ $workExperience->description }}" required>
                        </section>
                        <section class="form-group col-lg-12">
                            <label class="body-1 color-text" for="name">Alasan Berhenti </label>
                            <input type="text" name="edit_work_quit[]" class="form-control" value="{{ $workExperience->quit_reason }}" required>
                        </section>
                    </div>
                    @endforeach
                </div>
                <button class="btn btn-block btn-primary" type="button" id="btnAddPengalamanKerja">Tambah Pengalaman Kerja</button>

                <hr>
                <h4>Foto Profile</h4>
                <div class="form-row" style="row-gap: 24px">
                    @foreach ($talent->talentPhotos as $photo)
                    <div class="col-md-3">
                        <img src="{{ asset($photo->image) }}" class="img-thumbnail img-fluid" alt="">
                    </div>
                    @endforeach
                </div>

                <hr>
                <h4>Pengalaman Berdasar Talent</h4>
                <div id="pengalamanBerdasarTalentAppendContainer">
                    @foreach ($talent->talentExperiences as $item)
                    <div class="form-row">
                        @if (!$loop->first)
                        <hr class="col-lg-12" style="border-color: #555555" class="my-3">
                        @endif
                        <input type="hidden" name="edit_experience_id[]" value="{{ $item->id }}">
                        <section class="form-group col-lg-6">
                            <div class="d-flex">
                                <label for="">
                                    Talenta <span class="countingNumber">{{ $loop->iteration }}</span>
                                </label>
                            </div>
                            <input type="text" value="{{ $item->skill }}" name="edit_experience_skill[]" class="form-control p-1" required>
                        </section>
                        <section class="form-group col-lg-6">
                            <label for="">Durasi (tahun/bulan)</label>
                            <input type="text" name="edit_experience_period[]" value="{{ $item->period }}" class="form-control p-1" required>
                        </section>
                        <section class="form-group col-lg-12">
                            <label for="">Link</label>
                            <input type="text" name="edit_experience_link[]" value="{{ $item->link }}" class="form-control p-1" required>
                        </section>
                    </div>
                    @endforeach
                </div>
                <button class="btn btn-block btn-primary"  type="button" id="btnAddPengalamanBerdasarTalent">Tambah Pengalaman Berdasar Talent (Maks 10)</button>

                <hr>
                <h4>Portofolio</h4>
                <div id="portofolioAppendContainer">
                    @foreach ($talent->talentPortfolios as $item)
                    <div class="form-row">
                        @if (!$loop->first)
                        <div class="col-lg-12">
                            <hr style="border-color: #555555" class="my-3">
                        </div>
                        @endif

                        <input type="hidden" name="edit_portofolio_id[]" value="{{ $item->id }}">
                        <section class="form-group col-lg-6">
                            <div class="d-flex">
                                <label for="">
                                    Nama Talenta <span class="countingNumber">{{ $loop->iteration }}</span>
                                </label>
                            </div>
                            <input type="text" name="edit_portofolio_skill[]" class="form-control p-1" value="{{ $item->skill }}" required>
                        </section>
                        <section class="form-group col-lg-12">
                            <label for="">Link (Wajib Link Youtube)</label>
                            <input type="text" name="edit_portofolio_link[]" class="form-control p-1" value="{{ $item->link }}" required>
                        </section>
                    </div>
                    @endforeach
                </div>
                <button type="button" id="btnAddPortofolio" class="btn btn-block btn-primary">Tambah Portofolio (Maks 10)</button>

                <hr>
                <h4>Video Perkenalan</h4>
                <a href="{{ $talent->introduction_link }}" class="btn btn-primary btn-block" target="_blank">Lihat video</a>

                <hr>
                <h4>Rate Harga</h4>
                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <label for="">Jam/Hari</label>
                        <input type="text" name="rate_period" value="{{ $talent->talentRate->period ?? '' }}" class="form-control p-1">
                    </div>

                    <div class="form-group col-lg-6">
                        <label for="">Rate</label>
                        @if ($talent->talentRate && $talent->talentRate->rate != '')
                        <input type="rate" id="rateInput" name="rate_rate" value="{{ number_format($talent->talentRate->rate ?? 0, 0, ',', '.') }}" class="form-control p-1">
                        @else
                        <input type="rate" id="rateInput" name="rate_rate" value="" class="form-control p-1">
                        @endif
                    </div>

                    <div class="form-group col-lg-12">
                        <label for="">Hari Terbaik Memanggil Mu</label>
                        <select class="form-control mb-3" name="rate_call_day" required>
                            <option value="" disabled selected>Pilih Hari</option>
                            <option value="0" {{ ($talent->talentRate->call_day ?? null) == 0 ? 'selected' : '' }}>Minggu</option>
                            <option value="1" {{ ($talent->talentRate->call_day ?? null) == 1 ? 'selected' : '' }}>Senin</option>
                            <option value="2" {{ ($talent->talentRate->call_day ?? null) == 2 ? 'selected' : '' }}>Selasa</option>
                            <option value="3" {{ ($talent->talentRate->call_day ?? null) == 3 ? 'selected' : '' }}>Rabu</option>
                            <option value="4" {{ ($talent->talentRate->call_day ?? null) == 4 ? 'selected' : '' }}>Kamis</option>
                            <option value="5" {{ ($talent->talentRate->call_day ?? null) == 5 ? 'selected' : '' }}>Jum'at</option>
                            <option value="6" {{ ($talent->talentRate->call_day ?? null) == 6 ? 'selected' : '' }}>Sabtu</option>
                        </select>
                        <input type="time" name="rate_call_time" value="{{ $talent->talentRate->call_time ?? '' }}" class="form-control" required>
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
            height: 200, // Change the height here
        })
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
        <div class="form-row" id="pengalamanKerjaContainer-${randomString}">
            <hr class="col-lg-12" style="border-color: #555555" class="my-3">
            <div class="form-group col-lg-6">
                <div class="d-flex mb-2">
                    <label class="body-1 color-text" for="name">
                        Perusahaan Terakhir
                        <span class="countingNumber">${counting}</span>
                    </label>
                    <button type="button" class="btn btn-danger btn-sm ml-2 btnDeletePengalamanKerja" data-uniqid="${randomString}">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
                <input type="text" name="work_company[]" class="form-control" required>
            </div>
            <div class="form-group col-lg-6">
                <label class="body-1 color-text" for="name">Posisi/Jabatan </label>
                <input type="text" name="work_position[]" class="form-control" required>
            </div>
            <div class="form-group col-lg-6">
                <label class="body-1 color-text" for="name">Periode Kerja </label>
                <input type="text" name="work_period[]" class="form-control" required>
            </div>
            <div class="form-group col-lg-6">
                <label class="body-1 color-text" for="name">Deskripsi Tugas </label>
                <input type="text" name="work_description[]" class="form-control" required>
            </div>
            <div class="form-group col-lg-12">
                <label class="body-1 color-text" for="name">Alasan Berhenti </label>
                <input type="text" name="work_quit[]" class="form-control" required>
            </div>
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
        <div id="pengalamanBerdasarTalentContainer-${randomString}" class="form-row">
            <hr style="border-color: #555555" class="my-3 col-lg-12">
            <section class="form-group col-lg-6">
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
            <section class="form-group col-lg-6">
                <label for="">Durasi (tahun/bulan)</label>
                <input type="text" name="experience_period[]" class="form-control p-1" required>
            </section>
            <section class="form-group col-lg-12">
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
        <div id="portofolioContainer-${randomString}" class="form-row">
            <div class="col-lg-12">
                <hr style="border-color: #555555" class="my-3">
            </div>

            <section class="form-group col-lg-6">
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

            <section class="form-group col-lg-12">
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

        $(this).val(numberFormatToRupiah(rateInteger.toString()))
    })
  </script>

  <script>
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
