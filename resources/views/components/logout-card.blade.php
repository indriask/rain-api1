<div id="logout-card"
    class="d-none position-absolute top-0 end-0 start-0 bottom-0 d-flex align-items-center justify-content-center"
    style="background-color: rgba(0, 0, 0, .4)">
    <div class="dashboard__logout bg-white">
        <div id="logout-card-close-btn" class="d-flex">
            <button onclick="showLogoutCard()"
                class="dashboard__close-btn ms-auto bni-blue text-white border border-0">
                <i class="bi bi-x-circle"></i>
            </button>
        </div>
        <div class="py-3 px-5">
            <span id="logout-card-message" class="fw-600 text-center d-block">Apakah anda yakin ingin keluar dari akun ini?</span>
            <button id="logout-card-btn" onclick="processLogoutRequest()"
                class="border border-0 bni-blue text-white d-block mx-auto fw-700 mt-4"
                style="width: 120px; padding: 6px 10px; border-radius: 10px; font-size: .9rem">Keluar</button>
        </div>
    </div>
</div>