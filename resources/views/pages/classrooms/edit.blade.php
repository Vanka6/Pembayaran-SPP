@extends('layouts.app')

@section('title', 'Edit Kelas')

@section('content')
    <section class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('student-management.classrooms.index') }}">Manajemen
                                        Siswa</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Kelas</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Edit Kelas</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('student-management.classrooms.update', ['classroom' => $classroom->id]) }}"
                method="POST">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <x-input id="classroom_name" type="text" name="classroom_name"
                            value="{{ old('classroom_name', $classroom->classroom_name) }}" label="Nama Kelas"
                            placeholder="Nama Kelas" required />
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('student-management.classrooms.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
