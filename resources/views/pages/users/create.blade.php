@extends('layouts.app')

@section('title', 'Tambah User')

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
                                <li class="breadcrumb-item"><a href="{{ route('user-management.users.index') }}">Manajemen
                                        Users</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Tambah User</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Tambah User</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('user-management.users.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <x-input id="email" type="email" name="email" label="Email Address"
                            placeholder="Email Address" required />
                        <x-input id="password" type="password" name="password" label="Password" placeholder="Password"
                            required />
                        <x-select id="role" type="select" name="role" label="Role" :options="$roles->pluck('name', 'name')" />
                        <x-select id="status" type="select" name="status" label="Status" :options="collect($statuses)->mapWithKeys(fn($status) => [$status->value => $status->label()])"
                            :selected="old('status', $user->status ?? '')" />
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('user-management.users.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
