
<?php
session_start();

// Tentukan halaman yang akan dibuka
$halaman = $_GET['halaman'] ?? 'home';

// Daftar halaman yang diperbolehkan
$pages = [
    'home'       => 'pages/home.php',
    'dashboard'  => 'pages/dashboard.php',
    'contact'    => 'pages/contact.php',
    'daftarisi'  => 'pages/daftarisi.php',
    'tentang'    => 'pages/tentang.php',

    // CV Digital
    'cvdigital'  => 'pages/cvdigital/index.php',
    'tambahcv'   => 'pages/cvdigital/tambah.php',
    'editcv'     => 'pages/cvdigital/edit.php',
    'lihatcv'    => 'pages/cvdigital/lihat.php',

    // User
    'user'       => 'pages/user/index.php',
    'tambahuser' => 'pages/user/tambah.php',
    'edituser'   => 'pages/user/edit.php',
    'lihatuser'  => 'pages/user/lihat.php',

    // Login & Registrasi
    'loginuser'        => 'auth/loginuser.php',
    'registrasipeserta'=> 'auth/registrasipeserta.php'
];

// Jika halaman tidak ditemukan, kembali ke home
if (!isset($pages[$halaman])) {
    $halaman = 'home';
}

// File halaman yang akan dipanggil
$fileHalaman = $pages[$halaman];

// Cek apakah file benar-benar ada
if (!file_exists($fileHalaman)) {
    die("Halaman <b>$halaman</b> belum dibuat.");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CV Digital</title>

    <!-- Bootstrap -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body {
            background-color: #f4f6f9;
        }

        .content-wrapper {
            min-height: 80vh;
            padding: 20px;
        }

        .main-footer {
            text-align: center;
            padding: 15px;
            background: #ffffff;
            border-top: 1px solid #ddd;
        }
    </style>
</head>

<body>

<?php

//NAVBAR
if (file_exists('pages/component/navbar.php')) {
    include 'pages/component/navbar.php';
}
?>

<div class="content-wrapper">

    <?php
    
    //HEADER
    if (file_exists('pages/component/header.php')) {
        include 'pages/component/header.php';
    }
    ?>

    <main>
        <?php include $fileHalaman; ?>
    </main>

</div>

<?php

//FOOTER
if (file_exists('pages/component/footer.php')) {
    include 'pages/component/footer.php';
}
?>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
```
