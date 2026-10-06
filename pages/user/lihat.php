<?php
// pages/user/lihat.php

$id = $_GET['id'] ?? 0;

$file = "data/datauser.json";

$data = file_exists($file)
    ? (json_decode(file_get_contents($file), true) ?? [])
    : [];

$user = null;

foreach ($data as $r) {
    if (($r['id'] ?? 0) == $id) {
        $user = $r;
        break;
    }
}

if (!$user) {
    echo '<div class="alert alert-danger m-3">
            User ID ' . htmlspecialchars($id) . ' tidak ditemukan.
          </div>';
    return;
}

$foto = $user['foto'] ?? 'default.png';

$pathFoto = "assets/image/user/" . $foto;

if (!file_exists($pathFoto)) {
    $pathFoto = "assets/image/peserta/" . $foto;
}

if (!file_exists($pathFoto)) {
    $pathFoto = "assets/dist/img/avatar.png";
}
?>

<div class="card card-primary card-outline shadow">

    <div class="card-header bg-primary text-white">

        <h5>
            <i class="fas fa-user mr-2"></i>
            Detail User
        </h5>

    </div>


    <div class="card-body">

        <div class="row">

            <!-- FOTO -->
            <div class="col-md-4 text-center">

                <img src="<?= $pathFoto ?>"
                     class="img-thumbnail"
                     style="
                        width:200px;
                        height:220px;
                        object-fit:cover;
                     ">

                <h4 class="mt-3">
                    <?= htmlspecialchars($user['nama'] ?? '-') ?>
                </h4>

                <span class="badge badge-primary">
                    <?= htmlspecialchars($user['role'] ?? '-') ?>
                </span>

            </div>


            <!-- DATA USER -->
            <div class="col-md-8">

                <table class="table table-bordered">

                    <tr>
                        <th width="35%">ID</th>
                        <td>
                            <?= htmlspecialchars($user['id'] ?? '-') ?>
                        </td>
                    </tr>


                    <tr>
                        <th>Username</th>
                        <td>
                            <?= htmlspecialchars($user['username'] ?? '-') ?>
                        </td>
                    </tr>


                    <tr>
                        <th>Nama Lengkap</th>
                        <td>
                            <?= htmlspecialchars($user['nama'] ?? '-') ?>
                        </td>
                    </tr>


                    <tr>
                        <th>Role</th>
                        <td>
                            <?= htmlspecialchars($user['role'] ?? '-') ?>
                        </td>
                    </tr>


                    <tr>
                        <th>Email</th>
                        <td>
                            <?= htmlspecialchars($user['email'] ?? '-') ?>
                        </td>
                    </tr>


                    <tr>
                        <th>Foto</th>
                        <td>
                            <?= htmlspecialchars($foto) ?>
                        </td>
                    </tr>

                </table>

            </div>

        </div>

    </div>


    <div class="card-footer">

        <a href="index.php?halaman=user"
           class="btn btn-secondary">

            <i class="fas fa-arrow-left mr-1"></i>
            Kembali

        </a>


        <a href="index.php?halaman=edituser&id=<?= $user['id'] ?>"
           class="btn btn-warning">

            <i class="fas fa-edit mr-1"></i>
            Edit User

        </a>

    </div>

</div>