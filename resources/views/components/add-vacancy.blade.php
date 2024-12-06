<div id="add-vacancy"
    class="d-none position-absolute top-0 end-0 bottom-0 start-0 d-flex justify-content-center position-relative"
    style="background-color: rgba(0, 0, 0, .4)">

    <form method="POST" id="add-vacancy-form" enctype="multipart/form-data"
        class="dashboard__add-vacancy-company bg-white p-4 d-flex align-items-center justify-content-center gap-4 mt-3 position-relative">
        <div id="add-vacancy-input" class="w-50 d-block">
            <div class="dashboard__add-vacancy-form">
                <label for="gaji" class="fw-600">Gaji</label>
                <div>
                    <input type="text" style="width: 120px" class="focus-ring" name="jumlah">
                    <span class="mx-2">/</span>
                    <input type="text" style="width: 120px;" class="focus-ring" name="bulan">
                </div>

                <label for="judul" class="fw-600">Judul</label>
                <input type="text" name="judul" class="focus-ring">

                <label for="jurusan" class="fw-600">Jurusan</label>
                <input type="text" name="jurusan" class="focus-ring">

                <label for="lokasi" class="fw-600">Lokasi</label>
                <input type="text" name="lokasi" class="focus-ring">

                <label for="dibuka" class="fw-600">Dibuka</label>
                <div>
                    <input type="date" style="width: 120px" class="focus-ring" name="dibuka">
                    <span class="mx-2">-</span>
                    <input type="date" style="width: 120px;" class="focus-ring" name="ditutup">
                </div>

                <label for="tipe-waktu" class="fw-600">Tipe waktu</label>
                <div>
                    <div>
                        <input type="radio" name="tipe-waktu" id="full-time" value="full-time">
                        <label for="full-time">Full time</label>
                    </div>
                    <div>
                        <input type="radio" name="tipe-waktu" value="part-time" id="part-time">
                        <label for="part-time">Part time</label>
                    </div>
                </div>

                <label for="jenis" class="fw-600">Jenis</label>
                <select name="jenis" id="" class="focus-ring bg-white border border-0">
                    <option value="online">Online</option>
                    <option value="offline">Offline</option>
                </select>

                <label for="durasi" class="fw-600">Durasi</label>
                <input type="text" name="durasi" class="focus-ring">

                <label for="status" class="fw-600">Status</label>
                <div class="dashboard__add-vacancy-status bg-white">Verified</div>

                <label for="pendaftar" class="fw-600">Pendaftar</label>
                <input type="text" name="pendaftar" id="" class="focus-ring">
            </div>
        </div>
        <div id="add-vacancy-detail" class="w-50 d-block">
            <label for="detail-lowongan" class="fw-600 d-block">Detail lowongan</label>
            <textarea name="description" id="" class="dashboard__add-vacancy-textarea border border-0 focus-ring p-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim, natus numquam. Deserunt debitis sequi fugiat unde, natus non corporis dicta! Repudiandae temporibus sapiente hic iste, eaque eveniet a laboriosam iusto impedit totam. Excepturi, quae nesciunt!</textarea>
        </div>
        <div id="add-vacancy-logo" class="d-none">
            <h6 class="fw-700 text-center">Logo Perusahaan</h6>
            <label for="company-logo" class="dashboard__add-vacancy-logo cursor-pointer d-flex align-items-center justify-content-center flex-column">
                <div>Format gambar JPG, PNG, JPEG.</div>
                <i class="bi bi-plus-square"></i>
            </label>
            <input type="file" name="company-logo" id="company-logo" hidden>
        </div>

        <div class="position-absolute bottom-0 start-0 end-0 py-3 px-4 d-flex justify-content-between">
            <button class="border border-0 bni-blue text-white fw-700" onclick="backAddVacancyForm()"
                type="button">Kembali</button>
            <button id="add-vacancy-next-form" class="d-block border border-0 bni-blue text-white fw-700"
                onclick="nextVacancyForm()" type="button">Berikutnya</button>
            <button id="add-vacancy-submit" class="d-none border border-0 bni-blue text-white fw-700" onclick="processAddVacancy()"
                type="button">Ekspos</button>
        </div>
    </form>

    <div id="add-vacancy-notification"
        class="dashboard__add-vacancy-notification d-none position-absolute bg-white p-4 mt-3 d-flex flex-column align-items-center justify-content-center">
        <h5 id="add-vacancy-notification-title" class="fw-700"></h5>
        <img id="add-vacancy-notification-icon" src="" alt="">
        <button class="border border-0 bni-blue text-white fw-700 position-relative" onclick="closeAddVacancyForm()">Kembali</button>
    </div>
</div>
