@extends('layouts.app')

@section('title', 'Edit User')

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
                                <li class="breadcrumb-item active" aria-current="page">Edit User</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Edit User</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('user-management.users.update', ['user' => $user->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <x-input id="email" type="email" name="email" value="{{ $user->email }}"
                            label="Email Address" placeholder="Email Address" required />
                        <x-input id="password" type="password" name="password" label="Password"
                            placeholder="Isi jika ingin memperbaharui password" />
                        <x-select id="role" type="select" name="role" label="Role" :options="$roles->pluck('name', 'name')"
                            :selected="$user->roles->first()?->name" />
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('user-management.users.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
