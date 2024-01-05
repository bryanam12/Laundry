<?php

require_once "../controller/user.php";

session_start();
$user = new User();

// username dan password
$aksi     = $_GET['aksi'];
$username = $_POST['Username'];
$nama     = $_POST['Nama'];
$alamat   = $_POST['Alamat'];
$nomor_Hp = $_POST['hp'];
$password = $_POST['Password'];

if ($aksi == "masuk") {
    $user->validasi_login($username, $password);
} else if ($aksi == "daftar") {
    $user->daftar_akun($nama, $alamat, $nomor_Hp, $username, $password);
} else if ($aksi == "logout") {
    session_unset();
    session_destroy();
    header("Location: ../view/index.php");
    exit;
}
?>