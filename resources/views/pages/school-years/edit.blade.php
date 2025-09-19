@extends('layouts.app')

@section('title', 'Edit Tahun Ajaran')

@section('content')
    <section class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('student-management.school-years.index') }}">Manajemen
                                        Siswa</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Tahun Ajaran</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Edit Tahun Ajaran</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('student-management.school-years.update', ['school_year' => $schoolYear->id]) }}"
                method="POST">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <x-input id="year_label" type="text" name="year_label" value="{{ $schoolYear->year_label }}"
                            label="Tahun Ajaran" placeholder="Tahun Ajaran" required />

                        <x-input id="start_date" type="date" name="start_date"
                            value="{{ old('start_date', $schoolYear->start_date_for_input) }}" label="Tanggal Mulai"
                            placeholder="Tanggal Mulai" required />

                        <x-input id="end_date" type="date" name="end_date"
                            value="{{ old('end_date', $schoolYear->end_date_for_input) }}" label="Tahun Ajaran Selesai"
                            placeholder="Tahun Ajaran Selesai" required />

                        <x-textarea id="description" name="description" label="Description" placeholder="Description..."
                            rows="5" value="{{ old('description', $schoolYear->description ?? '') }}">
                        </x-textarea>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('student-management.school-years.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
