@extends('layouts.auth')
@section('title', 'Login')

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
    <div class="card my-5">
        <div class="row g-0">
            <div class="col-md-4 d-flex justify-content-center align-items-center">
                <img src="{{ asset('assets/images/logo-rar.png') }}" class="img-fluid" alt="Logo"
                    style="max-height: 150px; object-fit: contain;">
            </div>

            <div class="col-md-8">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-end mb-4">
                        <h3 class="mb-0"><b>Login</b></h3>
                        {{-- <a href="{{ route('register') }}" class="link-primary">Don't have an account?</a> --}}
                    </div>

                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <x-input id="email" type="email" name="email" label="Email Address"
                            placeholder="Email Address" required />
                        <x-input id="password" type="password" name="password" label="Password" placeholder="Password"
                            required />

                        <div class="d-flex mt-2 justify-content-between">
                            <div class="form-check">
                                <input class="form-check-input input-primary" type="checkbox" id="remember"
                                    name="remember" />
                                <label class="form-check-label text-muted" for="remember">Keep me signed in</label>
                            </div>
                            <a href="#" class="text-secondary f-w-400">Forgot Password?</a>
                        </div>
                        <x-button>Login</x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
