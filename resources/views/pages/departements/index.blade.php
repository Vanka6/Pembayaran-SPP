@extends('layouts.app')

@section('title', 'Manajemen Siswa')

@push('styles')
    <!-- [Page specific CSS] start -->
    <!-- data tables css -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/dataTables.bootstrap5.min.css') }}" />
    <link href="{{ asset('assets/css/plugins/animate.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- [Page specific CSS] end -->
@endpush

@push('scripts')
    <!-- [Page Specific JS] start -->
    <!-- datatable Js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('assets/js/plugins/dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/js/elements/ac-alert.js') }}"></script>
    <script>
        // [ hover style ]
        $('#table-style-hover').DataTable();
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tangkap semua form delete
            const deleteForms = document.querySelectorAll('.form-delete');

            deleteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault(); // Hentikan submit default

                    Swal.fire({
                        title: 'Yakin hapus jurusan ini?',
                        text: "Data yang dihapus tidak bisa dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, hapus',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit(); // submit manual jika departement klik Ya
                        }
                    });
                });
            });
        });
    </script>
    <!-- [Page Specific JS] end -->
@endpush


@section('content')
    <section class="pc-container">
        <div class="pc-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Manajemen Siswa</a></li>
                                <li class="breadcrumb-item" aria-current="page">Data Jurusan</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Data Jurusan</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <div class="row">
                <!-- Base style - Hover table start -->
                <x-datatable title="Data Jurusan" subtitle="This table use to collect data departement" :columns="['No', 'Jurusan', 'Kelas', 'Created At', 'Action']"
                    id="table-style-hover">

                    <x-slot name="plotActions">
                        <a href="{{ route('student-management.departement-classroom.create') }}" class="btn btn-warning">
                            + Plotting Jurusan dan Kelas
                        </a>
                    </x-slot>
                    <x-slot name="headerActions">
                        <a href="{{ route('student-management.departements.create') }}" class="btn btn-primary">
                            + Tambah Jurusan
                        </a>
                    </x-slot>

                    @foreach ($departements as $departement)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $departement->departement_name }}</td>
                            <td>
                                <div class="d-flex flex-wrap gap-1">
                                    @forelse ($departement->classrooms as $classroom)
                                        <span class="badge bg-success">{{ $classroom->classroom_name }}</span>
                                    @empty
                                        <span>Tidak ada kelas</span>
                                    @endforelse
                                </div>
                            </td>
                            <td>{{ $departement->formatted_created_at }}</td>
                            <td>
                                {{-- <a href="{{ route('student-management.departements.show', $departement->id) }}"
                                    class="btn btn-sm btn-success me-1">
                                    Detail Jurusan
                                </a> --}}
                                <a href="{{ route('student-management.departements.edit', $departement->id) }}"
                                    class="btn btn-sm btn-warning me-1">
                                    Edit
                                </a>
                                <form action="{{ route('student-management.departements.destroy', $departement->id) }}"
                                    method="POST" class="d-inline form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </x-datatable>

                <!-- Base style - Hover table end -->
            </div>
        </div>
        <!-- [ Main Content ] end -->
        </div>
    </section>
@endsection
