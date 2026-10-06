<?php

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
   VALIDASI DATA
========================= */

function validasiData($post)
{
    $required = [
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'email',
        'no_hp',
        'sekolah',
        'jurusan',
        'skills',
        'cita_cita'
    ];

    foreach ($required as $field) {

        if (
            !isset($post[$field]) ||
            trim($post[$field]) === ''
        ) {
            return false;
        }
    }

    return true;
}


/* =========================
   FILE DATA
========================= */

$file = "../data/datapeserta.json";

$folderFoto = "../assets/image/peserta/";


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


/* =========================
   DATA
========================= */

$data = bacaData($file);


/* =========================
   TAMBAH CV
========================= */

if ($aksi == 'tambah' || $aksi == 'tambah_public') {

    if (!validasiData($_POST)) {

        header(
            "Location: ../index.php?halaman=tambahcv&error=1"
        );

        exit;
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
            pathinfo($namaFile, PATHINFO_EXTENSION)
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


    /* SKILL */

    $skills = array_filter(
        array_map(
            'trim',
            explode(',', $_POST['skills'])
        )
    );


    /* DATA CV */

    $newData = [

        "id" => $id,

        "nama_lengkap" =>
            trim($_POST['nama_lengkap']),

        "tempat_lahir" =>
            trim($_POST['tempat_lahir']),

        "tanggal_lahir" =>
            $_POST['tanggal_lahir'],

        "alamat" =>
            trim($_POST['alamat']),

        "email" =>
            trim($_POST['email']),

        "no_hp" =>
            trim($_POST['no_hp']),

        "sekolah" =>
            trim($_POST['sekolah']),

        "jurusan" =>
            trim($_POST['jurusan']),

        "foto" =>
            $foto,

        "skills" =>
            $skills,

        "cita_cita" =>
            trim($_POST['cita_cita']),

        "tanggal_buat" =>
            date('Y-m-d H:i:s')
    ];


    $data[] = $newData;


    simpanData(
        $file,
        $data
    );


    header(
        "Location: ../index.php?halaman=cvdigital"
    );

    exit;
}


/* =========================
   EDIT CV
========================= */

if ($aksi == 'edit') {

    $id = $_POST['id'] ?? 0;

    if (!validasiData($_POST)) {

        header(
            "Location: ../index.php?halaman=editcv&id=" .
            $id .
            "&error=1"
        );

        exit;
    }


    foreach ($data as &$item) {

        if (($item['id'] ?? 0) == $id) {

            /* DATA LAMA */

            $foto = $item['foto'] ?? 'default.png';


            /* FOTO BARU */

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
                        file_exists($folderFoto . $foto)
                    ) {

                        unlink(
                            $folderFoto . $foto
                        );
                    }


                    $foto = $fotoBaru;
                }
            }


            /* UPDATE DATA */

            $item['nama_lengkap'] =
                trim($_POST['nama_lengkap']);

            $item['tempat_lahir'] =
                trim($_POST['tempat_lahir']);

            $item['tanggal_lahir'] =
                $_POST['tanggal_lahir'];

            $item['alamat'] =
                trim($_POST['alamat']);

            $item['email'] =
                trim($_POST['email']);

            $item['no_hp'] =
                trim($_POST['no_hp']);

            $item['sekolah'] =
                trim($_POST['sekolah']);

            $item['jurusan'] =
                trim($_POST['jurusan']);

            $item['skills'] =
                array_filter(
                    array_map(
                        'trim',
                        explode(',', $_POST['skills'])
                    )
                );

            $item['cita_cita'] =
                trim($_POST['cita_cita']);

            $item['foto'] =
                $foto;

            $item['tanggal_update'] =
                date('Y-m-d H:i:s');

            break;
        }
    }

    unset($item);


    simpanData(
        $file,
        $data
    );


    header(
        "Location: ../index.php?halaman=cvdigital"
    );

    exit;
}


/* =========================
   HAPUS CV
========================= */

if ($aksi == 'hapus') {

    $id = $_GET['id'] ?? 0;


    foreach ($data as $key => $item) {

        if (($item['id'] ?? 0) == $id) {

            $foto = $item['foto'] ?? 'default.png';


            if (
                $foto != 'default.png' &&
                file_exists($folderFoto . $foto)
            ) {

                unlink(
                    $folderFoto . $foto
                );
            }


            unset($data[$key]);

            break;
        }
    }


    $data = array_values($data);


    simpanData(
        $file,
        $data
    );


    header(
        "Location: ../index.php?halaman=cvdigital"
    );

    exit;
}


/* =========================
   JIKA AKSI TIDAK DITEMUKAN
========================= */

header(
    "Location: ../index.php?halaman=cvdigital"
);

exit;

?>