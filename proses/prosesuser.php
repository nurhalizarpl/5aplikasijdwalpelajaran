<?php

$file = "../data/datauser.json";
$folderFoto = "../assets/image/user/";


/* =========================
   FUNGSI BACA DATA
========================= */

function bacaData($file)
{
    if (!file_exists($file)) {
        return [];
    }

    $data = json_decode(
        file_get_contents($file),
        true
    );

    return is_array($data) ? $data : [];
}


/* =========================
   FUNGSI SIMPAN DATA
========================= */

function simpanData($file, $data)
{
    file_put_contents(
        $file,
        json_encode(
            $data,
            JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
        )
    );
}


/* =========================
   BUAT FOLDER FOTO
========================= */

if (!is_dir($folderFoto)) {
    mkdir($folderFoto, 0777, true);
}


/* =========================
   AMBIL AKSI
========================= */

$aksi = $_GET['aksi'] ?? '';

$data = bacaData($file);


/* =========================
   TAMBAH USER
========================= */

if ($aksi == 'tambah') {

    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $nama     = trim($_POST['nama'] ?? '');
    $role     = trim($_POST['role'] ?? 'user');
    $email    = trim($_POST['email'] ?? '');


    if ($username == '' || $password == '' || $nama == '') {

        header(
            "Location: ../index.php?halaman=tambahuser&error=1"
        );

        exit;
    }


    /* CEK USERNAME */

    foreach ($data as $user) {

        if (
            strtolower($user['username'] ?? '') ===
            strtolower($username)
        ) {

            header(
                "Location: ../index.php?halaman=tambahuser&error=username"
            );

            exit;
        }
    }


    /* ID BARU */

    $id = 1;

    if (!empty($data)) {

        $ids = array_column($data, 'id');

        $id = max($ids) + 1;
    }


    /* FOTO */

    $foto = "default.png";


    if (
        isset($_FILES['foto']) &&
        $_FILES['foto']['error'] === UPLOAD_ERR_OK
    ) {

        $namaFile = $_FILES['foto']['name'];

        $tmpFile = $_FILES['foto']['tmp_name'];

        $extension = strtolower(
            pathinfo(
                $namaFile,
                PATHINFO_EXTENSION
            )
        );


        $allowed = [
            'jpg',
            'jpeg',
            'png',
            'gif',
            'webp'
        ];


        if (in_array($extension, $allowed)) {

            $foto =
                time() .
                "_" .
                preg_replace(
                    '/[^a-zA-Z0-9._-]/',
                    '_',
                    $namaFile
                );


            move_uploaded_file(
                $tmpFile,
                $folderFoto . $foto
            );
        }
    }


    /* DATA USER */

    $newUser = [

        "id" => $id,

        "username" =>
            $username,

        "password" =>
            $password,

        "nama" =>
            $nama,

        "role" =>
            $role,

        "email" =>
            $email,

        "foto" =>
            $foto

    ];


    $data[] = $newUser;


    simpanData(
        $file,
        $data
    );


    header(
        "Location: ../index.php?halaman=user"
    );

    exit;
}


/* =========================
   EDIT USER
========================= */

if ($aksi == 'edit') {

    $id = $_POST['id'] ?? 0;

    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $nama     = trim($_POST['nama'] ?? '');
    $role     = trim($_POST['role'] ?? 'user');
    $email    = trim($_POST['email'] ?? '');


    if ($username == '' || $nama == '') {

        header(
            "Location: ../index.php?halaman=edituser&id=" .
            $id .
            "&error=1"
        );

        exit;
    }


    foreach ($data as &$user) {

        if (($user['id'] ?? 0) == $id) {

            /* USERNAME */

            $user['username'] =
                $username;


            /* PASSWORD */

            if ($password != '') {

                $user['password'] =
                    $password;
            }


            /* DATA LAIN */

            $user['nama'] =
                $nama;

            $user['role'] =
                $role;

            $user['email'] =
                $email;


            /* FOTO LAMA */

            $foto =
                $user['foto'] ??
                'default.png';


            /* FOTO BARU */

            if (
                isset($_FILES['foto']) &&
                $_FILES['foto']['error'] === UPLOAD_ERR_OK
            ) {

                $namaFile =
                    $_FILES['foto']['name'];

                $tmpFile =
                    $_FILES['foto']['tmp_name'];

                $extension =
                    strtolower(
                        pathinfo(
                            $namaFile,
                            PATHINFO_EXTENSION
                        )
                    );


                $allowed = [
                    'jpg',
                    'jpeg',
                    'png',
                    'gif',
                    'webp'
                ];


                if (
                    in_array(
                        $extension,
                        $allowed
                    )
                ) {

                    $fotoBaru =
                        time() .
                        "_" .
                        preg_replace(
                            '/[^a-zA-Z0-9._-]/',
                            '_',
                            $namaFile
                        );


                    move_uploaded_file(
                        $tmpFile,
                        $folderFoto . $fotoBaru
                    );


                    /* HAPUS FOTO LAMA */

                    if (
                        $foto != 'default.png' &&
                        file_exists(
                            $folderFoto . $foto
                        )
                    ) {

                        unlink(
                            $folderFoto . $foto
                        );
                    }


                    $foto =
                        $fotoBaru;
                }
            }


            $user['foto'] =
                $foto;

            break;
        }
    }

    unset($user);


    simpanData(
        $file,
        $data
    );


    header(
        "Location: ../index.php?halaman=user"
    );

    exit;
}


/* =========================
   HAPUS USER
========================= */

if ($aksi == 'hapus') {

    $id = $_GET['id'] ?? 0;


    foreach ($data as $key => $user) {

        if (($user['id'] ?? 0) == $id) {

            $foto =
                $user['foto'] ??
                'default.png';


            /* HAPUS FOTO */

            if (
                $foto != 'default.png' &&
                file_exists(
                    $folderFoto . $foto
                )
            ) {

                unlink(
                    $folderFoto . $foto
                );
            }


            unset($data[$key]);

            break;
        }
    }


    $data =
        array_values($data);


    simpanData(
        $file,
        $data
    );


    header(
        "Location: ../index.php?halaman=user"
    );

    exit;
}


/* =========================
   AKSI TIDAK DITEMUKAN
========================= */

header(
    "Location: ../index.php?halaman=user"
);

exit;

?>