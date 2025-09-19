@extends('layouts.app')

@section('title', 'Edit Siswa')

@push('scripts')
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
                                    <a href="{{ route('student-management.student-guardians.index') }}">Manajemen Siswa</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Wali Siswa</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Edit Wali Siswa</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('student-management.student-guardians.update', $studentGuardian->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <x-input id="email" type="email" name="email" label="Email Address"
                            placeholder="Email Address" required :value="old('email', $studentGuardian->user->email ?? '')" />

                        <x-input id="password" type="password" name="password" label="Password"
                            placeholder="Isi Jika Password Ingin Diubah" />

                        <x-input id="fullname" type="text" name="fullname" label="Nama Lengkap"
                            placeholder="Nama Lengkap" required :value="old('fullname', $studentGuardian->fullname ?? '')" />

                        <x-input id="phone_number" type="text" name="phone_number" label="Nomor Handphone"
                            placeholder="Nomor Handphone" required :value="old('phone_number', $studentGuardian->phone_number ?? '')" />

                        <x-select id="relation_type" name="relation_type" label="Hubungan dengan Siswa" :options="collect(\App\Enums\StudentGuardianRelationType::cases())->mapWithKeys(
                            fn($type) => [$type->value => $type->label()],
                        )"
                            :selected="old('relation_type', $studentGuardian->relation_type ?? '')" />

                        <x-textarea id="address" name="address" label="Alamat Rumah" placeholder="Alamat Rumah"
                            value="{{ old('address', $studentGuardian->address ?? '') }}" required>
                        </x-textarea>

                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('student-management.student-guardians.index') }}"
                            class="btn btn-secondary">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
