<?php
// pages/user/edit.php - FINAL dengan Foto

$id = $_GET['id'] ?? 0;

$file = "data/datauser.json";

$data = file_exists($file)
    ? (json_decode(file_get_contents($file), true) ?? [])
    : [];

$edit = null;

foreach ($data as $r) {
    if (($r['id'] ?? 0) == $id) {
        $edit = $r;
        break;
    }
}

if (!$edit) {
    echo '<div class="alert alert-danger m-3">
            User ID ' . htmlspecialchars($id) . ' tidak ditemukan
          </div>';
    return;
}

$fotoLama = $edit['foto'] ?? 'default.png';

$pathLama = "assets/image/user/" . $fotoLama;

if (!file_exists($pathLama)) {
    $pathLama = "assets/image/peserta/" . $fotoLama;
}

if (!file_exists($pathLama)) {
    $pathLama = "assets/dist/img/avatar.png";
}
?>

<div class="card card-warning card-outline shadow">

    <div class="card-header bg-warning text-white">

        <h5>
            <i class="fas fa-user-edit mr-2"></i>

            Edit User #<?= $edit['id'] ?? '' ?>

            -
            <?= htmlspecialchars($edit['username'] ?? '') ?>

        </h5>

    </div>


    <div class="card-body">

        <form method="POST"
              action="proses/prosesuser.php?aksi=edit"
              enctype="multipart/form-data">

            <input type="hidden"
                   name="id"
                   value="<?= $edit['id'] ?>">


            <div class="row">

                <div class="col-md-8">

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>Username *</label>

                            <input type="text"
                                   name="username"
                                   value="<?= htmlspecialchars($edit['username'] ?? '') ?>"
                                   class="form-control"
                                   required>

                        </div>


                        <div class="col-md-6 mb-3">

                            <label>Password</label>

                            <div class="input-group">

                                <input type="password"
                                       name="password"
                                       id="passEdit"
                                       class="form-control"
                                       placeholder="Kosongkan jika tidak diubah">

                                <div class="input-group-append">

                                    <div class="input-group-text"
                                         style="cursor:pointer"
                                         onclick="togglePass('passEdit','eyeEdit')">

                                        <i class="fas fa-eye"
                                           id="eyeEdit"></i>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>Nama Lengkap *</label>

                            <input type="text"
                                   name="nama"
                                   value="<?= htmlspecialchars($edit['nama'] ?? '') ?>"
                                   class="form-control"
                                   required>

                        </div>


                        <div class="col-md-3 mb-3">

                            <label>Role *</label>

                            <select name="role"
                                    class="form-control">

                                <option value="user"
                                    <?= (($edit['role'] ?? '') == 'user') ? 'selected' : '' ?>>
                                    User
                                </option>

                                <option value="admin"
                                    <?= (($edit['role'] ?? '') == 'admin') ? 'selected' : '' ?>>
                                    Admin
                                </option>

                                <option value="operator"
                                    <?= (($edit['role'] ?? '') == 'operator') ? 'selected' : '' ?>>
                                    Operator
                                </option>

                            </select>

                        </div>


                        <div class="col-md-3 mb-3">

                            <label>Email</label>

                            <input type="email"
                                   name="email"
                                   value="<?= htmlspecialchars($edit['email'] ?? '') ?>"
                                   class="form-control">

                        </div>

                    </div>


                    <div class="alert alert-info">

                        <i class="fas fa-info-circle mr-1"></i>

                        Kosongkan password jika tidak ingin mengubah password.

                    </div>

                </div>


                <div class="col-md-4 text-center">

                    <label>Foto Saat Ini</label>

                    <br>

                    <img src="<?= $pathLama ?>"
                         class="img-thumbnail"
                         style="
                            width:150px;
                            height:180px;
                            object-fit:cover;
                         ">

                    <br>

                    <small class="badge badge-info mt-2">

                        <?= htmlspecialchars($fotoLama) ?>

                    </small>


                    <div class="mt-3 text-left">

                        <label>Ganti Foto (opsional)</label>

                        <div class="custom-file">

                            <input type="file"
                                   name="foto"
                                   class="custom-file-input"
                                   id="fotoEdit"
                                   accept="image/*"
                                   onchange="previewFoto(this,'previewEdit')">

                            <label class="custom-file-label"
                                   for="fotoEdit">

                                Pilih foto baru...

                            </label>

                        </div>


                        <img id="previewEdit"
                             src="#"
                             class="img-thumbnail mt-2"
                             style="
                                width:150px;
                                height:180px;
                                object-fit:cover;
                                display:none;
                             ">

                    </div>

                </div>

            </div>


            <button type="submit"
                    class="btn btn-warning btn-block">

                <i class="fas fa-save mr-1"></i>
                Update User

            </button>


            <a href="index.php?halaman=user"
               class="btn btn-secondary btn-block">

                Kembali

            </a>

        </form>

    </div>

</div>


<script>

function togglePass(id, eyeId) {

    const p = document.getElementById(id);
    const e = document.getElementById(eyeId);

    if (p.type === 'password') {

        p.type = 'text';

        e.classList.remove('fa-eye');
        e.classList.add('fa-eye-slash');

    } else {

        p.type = 'password';

        e.classList.add('fa-eye');
        e.classList.remove('fa-eye-slash');

    }

}


function previewFoto(input, previewId) {

    const preview = document.getElementById(previewId);

    const file = input.files[0];

    if (file) {

        preview.style.display = 'block';

        preview.src = URL.createObjectURL(file);

        input.nextElementSibling.innerText = file.name;

    }

}

</script>