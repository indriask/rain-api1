<aside class="aside-nav border-end border-black px-2">
    <div class="d-flex align-items-center border-bottom border-black">
        <img class="logo-img" src="{{ asset('storage/2d-logo.png') }}" alt="RAIN Team">
        <h2 class="logo-title position-relative" style="right: 10px;">RAIN</h2>
    </div>
    <div class="aside-list py-4">
        <div class="border-bottom border-black" style="height: 300px;">
            <p class="aside-subheading">MENU UTAMA</p>
            <a href="{{ route('dashboard') }}" class="underline-none">
                <div class="aside-list-item py-2 px-2 text-white mb-2 click-animation"><i
                        class="bi bi-house-door me-1"></i> Beranda
                </div>
            </a>
            @if ($role === 'student')
                <a href="{{ route('student-proposal-list') }}" class="underline-none click-animation">
                    <div class="aside-list-item py-2 px-2 text-white mb-2 click-animation">
                        <i class="bi bi-card-list me-1"></i> Daftar Lamaran
                    </div>
                </a>
            @endif

            @if ($role === 'company')
                <div class="aside-list-item py-2 px-2 text-white mb-2 cursor-pointer click-animation"
                    onclick="showAddVacancyCard()"><i class="bi bi-plus-circle me-1"></i> Tambah Lowongan</div>
                <a href="{{ route('company-manage-vacancy') }}" class="underline-none">
                    <div class="aside-list-item py-2 px-2 text-white mb-2 cursor-pointer click-animation"><i
                            class="bi bi-window me-1"></i>
                        Kelola Lowongan</div>
                </a>
                <a href="{{ route('company-applicant-list') }}" class="underline-none">
                    <div class="aside-list-item py-2 px-2 text-white mb-2 cursor-pointer click-animation"><i
                            class="bi bi-person-vcard me-1"></i> Daftar Pelamar</div>
                </a>
            @endif

            @if ($role === 'admin')
                <div class="dropdown">
                    <button
                        class="aside-list-item py-2 px-2 text-white mb-2 cursor-pointer click-animation border border-0 w-100 d-flex align-items-center justify-content-between"
                        style="text-align: initial" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div><i class="bi bi-person me-1"></i> Kelola Pengguna</div>
                        <i class="bi bi-caret-down-square position-relative" style="right: 4px;"></i>
                    </button>
                    <ul class="dropdown-menu mt-1 w-100">
                        <li><a class="dropdown-item px-2 click-animation"
                                href="{{ route('admin-manage-user-student') }}" style="font-size: .9rem;">
                                <i class="bi bi-backpack me-1"></i>
                                Kelola Akun Mahasiswa</a>
                        </li>
                        <li><a class="dropdown-item px-2 click-animation"
                                href="{{ route('admin-manage-user-company') }}" style="font-size: .9rem;">
                                <i class="bi bi-building me-1"></i>
                                Kelola Akun Perusahaan</a>
                        </li>
                    </ul>
                </div>
            @endif

        </div>
        <div class="">
            <p class="aside-subheading">Lainnya</p>
            @if ($role === 'student')
                <a href="{{ route('student-profile') }}" class="underline-none">
                    <div class="aside-list-item py-2 click-animation px-2 text-white mb-2 cursor-pointer">
                        <i class="bi bi-gear me-1"></i>Pengaturan
                    </div>
                </a>
            @elseif ($role === 'company')
                <a href="{{ route('company-profile') }}" class="underline-none">
                    <div class="aside-list-item py-2 click-animation px-2 text-white mb-2 cursor-pointer">
                        <i class="bi bi-gear me-1"></i>Pengaturan
                    </div>
                </a>
            @elseif ($role === 'admin')
                <a href="{{ route('admin-profile') }}" class="underline-none">
                    <div class="aside-list-item py-2 click-animation px-2 text-white mb-2 cursor-pointer">
                        <i class="bi bi-gear me-1"></i>Pengaturan
                    </div>
                </a>
            @endif

            <div class="aside-list-item py-2 px-2 text-white mb-2 click-animation cursor-pointer"
                onclick="showLogoutCard()"><i class="bi bi-box-arrow-left me-1"></i> Keluar</div>
        </div>
    </div>
</aside>
