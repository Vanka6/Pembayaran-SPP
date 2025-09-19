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
    <!-- [Page Specific JS] start -->
    <script>
        var animateModal = document.getElementById('animateModal');
        animateModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var recipient = button.getAttribute('data-pc-animate');
            var modalTitle = animateModal.querySelector('.modal-title');
            modalTitle.textContent = 'Animate Modal : ' + recipient;
            animateModal.classList.add('anim-' + recipient);
            if (recipient == 'let-me-in' || recipient == 'make-way' || recipient == 'slip-from-top') {
                document.body.classList.add('anim-' + recipient);
            }
        });
        animateModal.addEventListener('hidden.bs.modal', function(event) {
            removeClassByPrefix(animateModal, 'anim-');
            removeClassByPrefix(document.body, 'anim-');
        });

        function removeClassByPrefix(node, prefix) {
            for (let i = 0; i < node.classList.length; i++) {
                let value = node.classList[i];
                if (value.startsWith(prefix)) {
                    node.classList.remove(value);
                }
            }
        }
    </script>
    <!-- [Page Specific JS] end -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tangkap semua form delete
            const deleteForms = document.querySelectorAll('.form-delete');

            deleteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault(); // Hentikan submit default

                    Swal.fire({
                        title: 'Yakin hapus siswa ini?',
                        text: "Data yang dihapus tidak bisa dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, hapus',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit(); // submit manual jika student klik Ya
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
                                <li class="breadcrumb-item" aria-current="page">Data Siswa</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Data Siswa</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <div class="row">
                <!-- Base style - Hover table start -->
                <x-datatable title="Data Siswa" subtitle="This table use to collect data student" :columns="['No', 'Fullname', 'Date Of Birth', 'Gender', 'Phone Number', 'Created At', 'Action']"
                    id="table-style-hover">

                    <x-slot name="headerActions">
                        <a href="{{ route('student-management.students.create') }}" class="btn btn-primary">
                            + Tambah Siswa
                        </a>
                    </x-slot>

                    @foreach ($students as $student)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $student->fullname }}</td>
                            <td>
                                {{ $student->formatted_date_of_birth }}
                            </td>
                            <td>{{ $student->gender->label() }}</td>
                            <td>{{ $student->phone_number }}</td>
                            <td>{{ $student->formatted_created_at }}</td>
                            <td>
                                <x-detail-modal :id="'studentDetail' . $student->id" title="Detail Siswa - {{ $student->fullname }}"
                                    button-text="Detail Siswa">
                                    @include('pages.students.partials.detail', ['student' => $student])
                                </x-detail-modal>

                                <a href="{{ route('student-management.students.edit', $student->id) }}"
                                    class="btn btn-sm btn-warning me-1">
                                    Edit
                                </a>
                                <form action="{{ route('student-management.students.destroy', $student->id) }}"
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
