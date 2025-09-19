@extends('layouts.app')

@section('title', 'Edit Jurusan')

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
                                <li class="breadcrumb-item active" aria-current="page">Edit Jurusan</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Edit Jurusan</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('student-management.departements.update', ['departement' => $departement->id]) }}"
                method="POST">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <x-input id="departement_name" type="text" name="departement_name"
                            value="{{ old('departement_name', $departement->departement_name) }}" label="Nama Jurusan"
                            placeholder="Nama Jurusan" required />
                        @if ($classrooms->isNotEmpty())
                            <div class="mb-3">
                                <label class="form-label">Kelas</label>

                                <div class="row">
                                    @foreach ($classrooms as $classroom)
                                        <div class="col-md-4">
                                            <x-checkbox name="classrooms" :value="$classroom->id" :label="ucwords(str_replace('_', ' ', $classroom->classroom_name))"
                                                :checked="in_array(
                                                    $classroom->id,
                                                    old('classrooms', $selectedClassrooms ?? []),
                                                )" />
                                        </div>
                                    @endforeach
                                </div>
                                @error('classrooms')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('student-management.departements.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
