{{-- @extends('layouts.app')

@section('title', 'Tambah Siswa')

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const departementSelect = document.getElementById('departement');
            const classroomSelect = document.getElementById('classroom');

            const departements = @json($departements);

            departementSelect.addEventListener('change', function() {
                const selectedId = this.value;
                const selectedDepartement = departements.find(dep => dep.id == selectedId);

                classroomSelect.innerHTML = `<option value="">~~ Pilih Classroom ~~</option>`;

                if (selectedDepartement && selectedDepartement.classrooms.length > 0) {
                    selectedDepartement.classrooms.forEach(c => {
                        const option = document.createElement('option');
                        option.value = c.id;
                        option.text = c.classroom_name;
                        classroomSelect.appendChild(option);
                    });
                }
            });
        });
    </script>
@endpush


@section('content')
    <section class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('student-management.students.index') }}">Manajemen
                                        Siswa</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Tambah Siswa</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Tambah Siswa</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('student-management.students.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <x-select id="user" type="select" name="user" label="Akun User" :options="collect($users)->mapWithKeys(fn($user) => [$user->email => $user->email])"
                            :selected="old('user', $user->email ?? '')" />
                        <x-input id="nis" type="text" name="nis" label="Nomor Induk Siswa"
                            placeholder="Nomor Induk Siswa" required />
                        <x-input id="fullname" type="text" name="fullname" label="Nama Lengkap"
                            placeholder="Nama Lengkap" required />
                        <x-input id="date_of_birth" type="date" name="date_of_birth" label="Tanggal Lahir" required
                            :value="old('date_of_birth', $student->date_of_birth ?? '')" />
                        <x-select id="gender" type="select" name="gender" label="Jenis Kelamin" :options="collect($genders)->mapWithKeys(fn($gender) => [$gender->value => $gender->label()])"
                            :selected="old('gender', $student->gender ?? '')" />
                        <x-select id="departement" name="departement" label="Pilih Jurusan" :options="collect($departements)->mapWithKeys(
                            fn($departement) => [$departement->id => $departement->departement_name],
                        )"
                            :selected="old('departement')" />
                        <x-select id="classroom" name="classroom" label="Pilih Kelas" :options="[]" />
                        <x-textarea id="address" name="address" label="address" placeholder="Alamat Rumah" required />
                        <x-input id="phone_number" type="text" name="phone_number" label="Nomor Handphone"
                            placeholder="Nomor Handphone" required />
                        <x-input id="mother_name" type="text" name="mother_name" label="Nama Ibu Kandung"
                            placeholder="Nama Ibu Kandung" required />
                        <x-select id="graduation_status" type="select" name="graduation_status" label="Status Kelulusan"
                            :options="collect($graduationStatuses)->mapWithKeys(
                                fn($graduationStatus) => [$graduationStatus->value => $graduationStatus->label()],
                            )" :selected="old('graduation_status', $student->graduationStatus ?? '')" />
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('student-management.students.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection --}}

@extends('layouts.app')

@section('title', 'Tambah Siswa')

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const departementSelect = document.getElementById('departement');
            const classroomSelect = document.getElementById('classroom');

            const departements = @json($departements);

            departementSelect.addEventListener('change', function() {
                const selectedId = this.value;
                const selectedDepartement = departements.find(dep => dep.id == selectedId);

                classroomSelect.innerHTML = `<option value="">~~ Pilih Classroom ~~</option>`;

                if (selectedDepartement && selectedDepartement.classrooms.length > 0) {
                    selectedDepartement.classrooms.forEach(c => {
                        const option = document.createElement('option');
                        option.value = c.id;
                        option.text = c.classroom_name;
                        classroomSelect.appendChild(option);
                    });
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('#student_password').forEach(function(button) {
                button.addEventListener('click', function() {
                    const target = document.getElementById(this.dataset.target);
                    const icon = this.querySelector('i'); // ambil icon di dalam tombol

                    if (target.type === 'password') {
                        target.type = 'text';
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                    } else {
                        target.type = 'password';
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                    }
                });
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('#student_guardian_password').forEach(function(button) {
                button.addEventListener('click', function() {
                    const target = document.getElementById(this.dataset.target);
                    const icon = this.querySelector('i'); // ambil icon di dalam tombol

                    if (target.type === 'password') {
                        target.type = 'text';
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                    } else {
                        target.type = 'password';
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                    }
                });
            });
        });
    </script>
@endpush

@section('content')
    <section class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('student-management.students.index') }}">Manajemen
                                        Siswa</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Tambah Siswa</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Tambah Siswa</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5>Form Pengisian Informasi Siswa</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('student-management.students.store') }}" method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-body">

                                {{-- ======================= A. Informasi Siswa ======================= --}}
                                <h5 class="mb-3">A. Informasi Siswa</h5>
                                <x-input id="email" type="email" name="student_email" label="Email Address"
                                    placeholder="Email Address" required />

                                <x-input id="student_password" type="password" name="student_password" label="Password"
                                    placeholder="Password" required />

                                <x-input id="nis" type="text" name="nis" label="Nomor Induk Siswa"
                                    placeholder="Nomor Induk Siswa" :value="old('nis', $student->nis ?? '')" required />

                                <x-input id="fullname" type="text" name="fullname" label="Nama Lengkap"
                                    placeholder="Nama Lengkap" :value="old('fullname', $student->fullname ?? '')" required />

                                <x-input id="date_of_birth" type="date" name="date_of_birth" label="Tanggal Lahir"
                                    :value="old('date_of_birth', $student->date_of_birth ?? '')" required />

                                <x-select id="gender" type="select" name="gender" label="Jenis Kelamin"
                                    :options="collect($genders)->mapWithKeys(
                                        fn($gender) => [$gender->value => $gender->label()],
                                    )" :selected="old('gender', $student->gender ?? '')" />

                                <x-textarea id="address" name="address" label="Alamat" placeholder="Alamat Rumah"
                                    :value="old('address', $student->address ?? '')" />


                                <x-input id="phone_number" type="text" name="phone_number" label="Nomor Handphone"
                                    placeholder="Nomor Handphone" required />

                                <x-input id="mother_name" type="text" name="mother_name" label="Nama Ibu Kandung"
                                    placeholder="Nama Ibu Kandung" required />

                                <x-select id="graduation_status" type="select" name="graduation_status"
                                    label="Status Kelulusan" :options="collect($graduationStatuses)->mapWithKeys(
                                        fn($graduationStatus) => [
                                            $graduationStatus->value => $graduationStatus->label(),
                                        ],
                                    )" :selected="old('graduation_status', $student->graduationStatus ?? '')" />

                                <x-select id="departement" name="departement" label="Pilih Jurusan" :options="collect($departements)->mapWithKeys(
                                    fn($departement) => [$departement->id => $departement->departement_name],
                                )"
                                    :selected="old('departement')" />

                                <x-select id="classroom" name="classroom" label="Pilih Kelas" :options="[]" />


                                <hr class="my-4" />

                                {{-- ======================= B. Informasi Wali Siswa ======================= --}}
                                <h5 class="mb-3">B. Informasi Wali Siswa</h5>

                                <x-input id="email" type="email" name="student_guardian_email" label="Email Address"
                                    placeholder="Email Address" required />

                                <x-input id="student_guardian_password" type="password" name="student_guardian_password"
                                    label="Password" placeholder="Password" required />

                                <x-input id="guardian_fullname" type="text" name="guardian_fullname" label="Nama Wali"
                                    placeholder="Nama Lengkap Wali" :value="old('guardian_fullname', $guardian->fullname ?? '')" required />

                                <x-input id="guardian_phone" type="text" name="guardian_phone"
                                    label="Nomor Handphone Wali" placeholder="Nomor Handphone" :value="old('guardian_phone', $guardian->phone_number ?? '')"
                                    required />

                                <x-select id="relation_type" name="relation_type" label="Hubungan" :options="collect($guardianRelations)->mapWithKeys(
                                    fn($guardianRelation) => [$guardianRelation->value => $guardianRelation->label()],
                                )"
                                    :selected="old('relation_type', $guardian->relation_type ?? '')" />

                                <x-textarea id="guardian_address" name="guardian_address" label="Alamat Wali"
                                    placeholder="Alamat Wali" :value="old('guardian_address', $guardian->address ?? '')" />

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a href="{{ route('student-management.students.index') }}"
                                        class="btn btn-secondary">Batal</a>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
@endsection
