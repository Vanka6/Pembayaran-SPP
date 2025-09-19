@extends('layouts.app')

@section('title', 'Tambah Jurusan')

@section('content')
    <section class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('student-management.departements.index') }}">Manajemen
                                        Siswa</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Tambah Jurusan</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Tambah Jurusan</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('student-management.departements.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <x-input id="departement_name" type="text" name="departement_name"
                            value="{{ old('departement_name') }}" label="Nama Jurusan" placeholder="Nama Jurusan"
                            required />
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('student-management.departements.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
