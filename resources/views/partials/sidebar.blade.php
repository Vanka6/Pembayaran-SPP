<!-- [ Sidebar Menu ] start -->
<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            {{-- <a href="../dashboard/index.html" class="b-brand text-primary">
                <!-- ========   Change your logo from here   ============ -->
                <img src="../assets/images/logo-dark.svg" class="img-fluid logo-lg" alt="logo" />
            </a> --}}
            <x-logo link="{{ route('dashboard') }}"></x-logo>
        </div>
        <div class="navbar-content">
            <ul class="pc-navbar">
                <li class="pc-item {{ request()->routeIs('dashboard.*') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="pc-link">
                        <span class="pc-micon">
                            <svg class="pc-icon">
                                <use xlink:href="#dashboard"></use>
                            </svg>
                        </span>
                        <span class="pc-mtext" data-i18n="Dashboard">Dashboard</span>
                    </a>
                </li>
                @can('manage-users')
                    <li class="pc-item pc-hasmenu {{ request()->routeIs('user-management.*') ? 'pc-trigger active' : '' }}">
                        <a class="pc-link">
                            <span class="pc-micon">
                                <svg class="pc-icon">
                                    <use xlink:href="#user"></use>
                                </svg>
                            </span>
                            <span class="pc-mtext" data-i18n="Manajemen User">Manajemen User</span>
                            <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                        </a>
                        <ul class="pc-submenu">
                            <li class="pc-item {{ request()->routeIs('user-management.users*') ? 'active' : '' }}">
                                <a class="pc-link {{ request()->routeIs('user-management.users*') ? 'active' : '' }}"
                                    href="{{ route('user-management.users.index') }}" data-i18n="Users">Users</a>
                            </li>
                            <li class="pc-item {{ request()->routeIs('user-management.roles*') ? 'active' : '' }}">
                                <a class="pc-link {{ request()->routeIs('user-management.roles*') ? 'active' : '' }}"
                                    href="{{ route('user-management.roles.index') }}" data-i18n="Roles">Roles</a>
                            </li>
                            <li class="pc-item {{ request()->routeIs('user-management.permissions*') ? 'active' : '' }}">
                                <a class="pc-link {{ request()->routeIs('user-management.permissions*') ? 'active' : '' }}"
                                    href="{{ route('user-management.permissions.index') }}"
                                    data-i18n="Permissions">Permissions</a>
                            </li>
                        </ul>
                    </li>
                @endcan


                {{-- @can('manage-employees')
                    <li class="pc-item pc-hasmenu">
                        <a href="#!" class="pc-link">
                            <span class="pc-micon">
                                <svg class="pc-icon">
                                    <use xlink:href="#team"></use>
                                </svg>
                            </span>
                            <span class="pc-mtext" data-i18n="Manajemen Pegawai">Manajemen Pegawai</span>
                            <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                        </a>
                        <ul class="pc-submenu">
                            <li class="pc-item"><a class="pc-link" href="../dashboard/index.html"
                                    data-i18n="Data Pegawai">Data Pegawai</a></li>
                            <li class="pc-item"><a class="pc-link" href="../dashboard/analytics.html"
                                    data-i18n="Jabatan Pegawai">Jabatan Pegawai</a></li>
                            <li class="pc-item"><a class="pc-link" href="../dashboard/finance.html"
                                    data-i18n="Histori Pegawai">Histori Pegawai</a></li>
                        </ul>
                    </li>
                @endcan --}}


                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon">
                            <svg class="pc-icon">
                                <use xlink:href="#team"></use>
                            </svg>
                        </span>
                        <span class="pc-mtext" data-i18n="Manajemen Siswa">Manajemen Siswa</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href="{{ route('student-management.students.index') }}"
                                data-i18n="Data Siswa">Data Siswa</a></li>
                        <li class="pc-item"><a class="pc-link"
                                href="{{ route('student-management.classrooms.index') }}" data-i18n="Kelas">Kelas</a>
                        </li>
                        <li class="pc-item"><a class="pc-link"
                                href="{{ route('student-management.school-years.index') }}"
                                data-i18n="Tahun Ajaran">Tahun Ajaran</a></li>
                        <li class="pc-item"><a class="pc-link"
                                href="{{ route('student-management.departements.index') }}"
                                data-i18n="Jurusan">Jurusan</a></li>
                        <li class="pc-item"><a class="pc-link"
                                href="{{ route('student-management.student-guardians.index') }}"
                                data-i18n="Wali Siswa">Wali Siswa</a></li>
                    </ul>
                </li>

                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon">
                            <svg class="pc-icon">
                                <use xlink:href="#team"></use>
                            </svg>
                        </span>
                        <span class="pc-mtext" data-i18n="Pembayaran">Pembayaran</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href="../dashboard/index.html"
                                data-i18n="Pembayaran">Pembayaran</a></li>
                        <li class="pc-item"><a class="pc-link" href="../dashboard/analytics.html"
                                data-i18n="Pembayaran">Pembayaran</a></li>
                        <li class="pc-item"><a class="pc-link" href="../dashboard/finance.html"
                                data-i18n="Histori Pembayaran">Histori Pembayaran</a></li>
                    </ul>
                </li>
                <li class="pc-item pc-caption">
                    <label data-i18n="Laporan Keuangan">Laporan Keuangan</label>
                    <i class="pc-micon">
                        <svg class="pc-icon">
                            <use xlink:href="#line-chart"></use>
                        </svg>
                    </i>
                </li>

                <li class="pc-item">
                    <a href="../other/sample-page.html" class="pc-link">
                        <span class="pc-micon">
                            <svg class="pc-icon">
                                <use xlink:href="#chrome"></use>
                            </svg>
                        </span>
                        <span class="pc-mtext" data-i18n="Laporan">Laporan</span>
                    </a>
                </li>

            </ul>
            @include('partials.footer_rar')
        </div>
    </div>
</nav>
<!-- [ Sidebar Menu ] end -->
