@extends('layouts.app')

@section('title', 'Edit Siswa')

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const departementSelect = document.getElementById('departement');
            const classroomSelect = document.getElementById('classroom');

            // data departement + classrooms (sudah di-pass dari controller)
            const departements = @json($departements);

            // ambil classroom_id yang sedang dipilih (edit / old value)
            const selectedClassroomId = @json(old('classroom', $student->activeClassroomStudent?->departementClassroom->classroom_id ?? ''));

            function populateClassrooms(departementId) {
                const selectedDepartement = departements.find(dep => dep.id == departementId);

                classroomSelect.innerHTML = `<option value="">~~ Pilih Classroom ~~</option>`;

                if (selectedDepartement && selectedDepartement.classrooms.length > 0) {
                    selectedDepartement.classrooms.forEach(c => {
                        const option = document.createElement('option');
                        option.value = c.id;
                        option.text = c.classroom_name;

                        if (c.id == selectedClassroomId) {
                            option.selected = true;
                        }

                        classroomSelect.appendChild(option);
                    });
                }
            }

            // initial load
            if (departementSelect.value) {
                populateClassrooms(departementSelect.value);
            }

            departementSelect.addEventListener('change', function() {
                populateClassrooms(this.value);
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.toggle-password').forEach(function(button) {
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
                                <li class="breadcrumb-item">
                                    <a href="{{ route('student-management.students.index') }}">Manajemen Siswa</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Siswa</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Edit Siswa</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('student-management.students.update', $student->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <x-input id="email" type="email" name="email" label="Email Address"
                            placeholder="Email Address" required :value="old('email', $student->user->email ?? '')" />

                        <x-input id="password" type="password" name="password" label="Password"
                            placeholder="Isi Jika Password Ingin Diubah" />

                        <x-input id="nis" type="text" name="nis" label="Nomor Induk Siswa"
                            placeholder="Nomor Induk Siswa" required :value="old('nis', $student->nis ?? '')" />

                        <x-input id="fullname" type="text" name="fullname" label="Nama Lengkap"
                            placeholder="Nama Lengkap" required :value="old('fullname', $student->fullname ?? '')" />

                        <x-input id="date_of_birth" type="date" name="date_of_birth" label="Tanggal Lahir" required
                            :value="old('date_of_birth', $student->date_of_birth_for_input ?? '')" />

                        <x-select id="gender" type="select" name="gender" label="Jenis Kelamin" :options="collect($genders)->mapWithKeys(fn($gender) => [$gender->value => $gender->label()])"
                            :selected="old('gender', $student->gender ?? '')" />

                        {{-- Departement --}}
                        <x-select id="departement" name="departement" label="Pilih Jurusan" :options="collect($departements)->mapWithKeys(
                            fn($departement) => [$departement->id => $departement->departement_name],
                        )"
                            :selected="old(
                                'departement',
                                $student->activeClassroomStudent?->departementClassroom->departement_id ?? '',
                            )" />

                        {{-- Classroom --}}
                        <x-select id="classroom" name="classroom" label="Pilih Kelas" :options="[]" :selected="old(
                            'classroom',
                            $student->activeClassroomStudent?->departementClassroom->classroom_id ?? '',
                        )" />

                        <x-textarea id="address" name="address" label="Alamat Rumah" placeholder="Alamat Rumah"
                            value="{{ old('address', $student->address ?? '') }}" required>
                        </x-textarea>

                        <x-input id="phone_number" type="text" name="phone_number" label="Nomor Handphone"
                            placeholder="Nomor Handphone" required :value="old('phone_number', $student->phone_number ?? '')" />

                        <x-input id="mother_name" type="text" name="mother_name" label="Nama Ibu Kandung"
                            placeholder="Nama Ibu Kandung" required :value="old('mother_name', $student->mother_name ?? '')" />

                        <x-select id="graduation_status" type="select" name="graduation_status" label="Status Kelulusan"
                            :options="collect($graduationStatuses)->mapWithKeys(
                                fn($graduationStatus) => [$graduationStatus->value => $graduationStatus->label()],
                            )" :selected="old('graduation_status', $student->graduation_status?->value ?? '')" />

                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('student-management.students.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
