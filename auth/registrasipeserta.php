<?php
// auth/registrasipeserta.php
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card card-primary card-outline shadow">

                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-user-plus mr-2"></i>
                        Registrasi Peserta
                    </h4>
                </div>

                <div class="card-body">

                    <form method="POST"
                          action="proses/prosescvdigital.php?aksi=tambah_public"
                          enctype="multipart/form-data">

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label>Nama Lengkap *</label>
                                <input
                                    type="text"
                                    name="nama_lengkap"
                                    class="form-control"
                                    placeholder="Masukkan nama lengkap"
                                    required
                                >
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Tempat Lahir *</label>
                                <input
                                    type="text"
                                    name="tempat_lahir"
                                    class="form-control"
                                    placeholder="Masukkan tempat lahir"
                                    required
                                >
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label>Tanggal Lahir *</label>
                                <input
                                    type="date"
                                    name="tanggal_lahir"
                                    class="form-control"
                                    required
                                >
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>No. HP *</label>
                                <input
                                    type="text"
                                    name="no_hp"
                                    class="form-control"
                                    placeholder="08xxxxxxxxxx"
                                    required
                                >
                            </div>

                        </div>

                        <div class="form-group">
                            <label>Alamat *</label>
                            <textarea
                                name="alamat"
                                class="form-control"
                                rows="3"
                                placeholder="Masukkan alamat lengkap"
                                required
                            ></textarea>
                        </div>

                        <div class="form-group">
                            <label>Email *</label>
                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                placeholder="contoh@email.com"
                                required
                            >
                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label>Sekolah *</label>
                                <input
                                    type="text"
                                    name="sekolah"
                                    class="form-control"
                                    placeholder="Nama sekolah"
                                    required
                                >
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Jurusan *</label>
                                <input
                                    type="text"
                                    name="jurusan"
                                    class="form-control"
                                    placeholder="Contoh: Rekayasa Perangkat Lunak"
                                    required
                                >
                            </div>

                        </div>

                        <div class="form-group">
                            <label>Skills *</label>
                            <input
                                type="text"
                                name="skills"
                                class="form-control"
                                placeholder="Contoh: HTML, PHP, Python"
                                required
                            >
                            <small class="text-muted">
                                Pisahkan setiap skill menggunakan koma (,).
                            </small>
                        </div>

                        <div class="form-group">
                            <label>Cita-Cita *</label>
                            <input
                                type="text"
                                name="cita_cita"
                                class="form-control"
                                placeholder="Masukkan cita-cita"
                                required
                            >
                        </div>

                        <div class="form-group">
                            <label>Foto</label>

                            <div class="custom-file">
                                <input
                                    type="file"
                                    name="foto"
                                    id="fotoPeserta"
                                    class="custom-file-input"
                                    accept="image/*"
                                    onchange="previewFoto(this)"
                                >

                                <label
                                    class="custom-file-label"
                                    for="fotoPeserta"
                                >
                                    Pilih foto...
                                </label>
                            </div>

                            <div class="mt-3 text-center">
                                <img
                                    id="preview"
                                    src="#"
                                    class="img-thumbnail"
                                    style="
                                        width:150px;
                                        height:150px;
                                        object-fit:cover;
                                        display:none;
                                    "
                                >
                            </div>
                        </div>

                        <button
                            type="submit"
                            class="btn btn-primary btn-block"
                        >
                            <i class="fas fa-paper-plane mr-1"></i>
                            Daftar Sekarang
                        </button>

                        <a
                            href="index.php?halaman=home"
                            class="btn btn-secondary btn-block"
                        >
                            <i class="fas fa-arrow-left mr-1"></i>
                            Kembali
                        </a>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<script>
function previewFoto(input) {

    const preview = document.getElementById("preview");
    const file = input.files[0];

    if (file) {

        preview.style.display = "block";
        preview.src = URL.createObjectURL(file);

        input.nextElementSibling.innerText = file.name;
    }
}
</script>