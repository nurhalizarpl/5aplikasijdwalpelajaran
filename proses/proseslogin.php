<?php

session_start();

$fileuser = "../data/datauser.json";


/* =========================
   FUNGSI BACA DATA USER
========================= */

function bacaUser($file)
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
   LOGOUT
========================= */

if (isset($_GET['aksi']) && $_GET['aksi'] == 'logout') {

    session_unset();
    session_destroy();

    header("Location: ../index.php?halaman=home");
    exit;
}



   // PROSES LOGIN ==========================================

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    header("Location: ../index.php?halaman=loginuser");
    exit;
}


$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');



  // VALIDASI INPUT====================


if ($username == '' || $password == '') {

    header(
        "Location: ../index.php?halaman=loginuser&error=1"
    );

    exit;
}



  // BACA DATA USER============================


$users = bacaUser($fileuser);



   //USER DEFAULT JIKA DATA BELUM ADA


if (empty($users)) {

    $users = [
        [
            "id" => 1,
            "username" => "user",
            "password" => "user123",
            "nama" => "User Administrator",
            "role" => "admin",
            "email" => "",
            "foto" => "default.png"
        ]
    ];
    file_put_contents(
        $fileuser,
        json_encode(
            $users,
            JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
        )
    );
}



   //CEK USERNAME & PASSWORD========================
$loginBerhasil = false;
foreach ($users as $user) {
    $userUsername = $user['username'] ?? '';
    $userPassword = $user['password'] ?? '';

    if (
        $username === $userUsername &&
        $password === $userPassword
    ) {

        // SIMPAN DATA KE SESSION 
        $_SESSION['login'] = true;
        $_SESSION['id'] =
            $user['id'] ?? '';
        $_SESSION['username'] =
            $user['username'] ?? '';
        $_SESSION['nama'] =
            $user['nama'] ?? '';
        $_SESSION['role'] =
            $user['role'] ?? 'user';
        $_SESSION['email'] =
            $user['email'] ?? '';
        $_SESSION['foto'] =
            $user['foto'] ?? 'default.png';

        $loginBerhasil = true;

        break;
    }
}


   //REDIRECT=================================
if ($loginBerhasil) {
    header(
        "Location: ../index.php?halaman=dashboard"
    );
    exit;
} else {
    header(
        "Location: ../index.php?halaman=loginuser&error=1"
    );
    exit;
}
?>