<aside class="aside-nav border-end border-black px-2">
    <div class="d-flex align-items-center border-bottom border-black">
        <img class="logo-img" src="{{ asset('storage/2d-logo.png') }}" alt="RAIN Team">
        <h2 class="logo-title position-relative" style="right: 10px;">RAIN</h2>
    </div>
    <div class="aside-list py-4">
        <div class="border-bottom border-black" style="height: 300px;">
            <p class="aside-subheading">MENU UTAMA</p>
            <a href="{{ route('dashboard') }}" class="underline-none">
                <div class="aside-list-item py-2 px-2 text-white mb-2"><i class="bi bi-house-door me-1"></i> Beranda
                </div>
            </a>
            @if ($role === 'student')
                <a href="{{ route('student-daftar-lamaran') }}" class="underline-none">
                    <div class="aside-list-item py-2 px-2 text-white mb-2">
                        <i class="bi bi-card-list me-1"></i> Daftar Lamaran
                    </div>
                </a>
            @endif

            @if ($role === 'company')
                <div class="aside-list-item py-2 px-2 text-white mb-2 cursor-pointer" onclick="showAddVacancyCard()"><i
                        class="bi bi-plus-circle me-1"></i> Tambah Lowongan</div>
                <a href="{{ route('company-manage-vacancy') }}" class="underline-none">
                    <div class="aside-list-item py-2 px-2 text-white mb-2 cursor-pointer"><i
                            class="bi bi-window me-1"></i>
                        Kelola Lowongan</div>
                </a>
                <div class="aside-list-item py-2 px-2 text-white mb-2 cursor-pointer" onclick=""><i
                        class="bi bi-person-vcard me-1"></i> Daftar Pelamar</div>
            @endif
        </div>
        <div class="">
            <p class="aside-subheading">Lainnya</p>
            <a href="{{ route($role === 'student' ? 'student-profile' : 'company-profile') }}" class="underline-none">
                <div class="aside-list-item py-2 px-2 text-white mb-2 cursor-pointer">
                    <i class="bi bi-gear me-1"></i>Pengaturan
                </div>
            </a>
            <div class="aside-list-item py-2 px-2 text-white mb-2 cursor-pointer" onclick="showLogoutCard()"><i
                    class="bi bi-box-arrow-left me-1"></i> Keluar</div>
        </div>
    </div>
</aside>
