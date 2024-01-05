<?php
include "../controller/admin.php";

session_start();

if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    header('location: ../view/masuk.php');
    exit;
} 

$aksi            = $_GET['aksi'];
$id_cucian       = $_GET['id'];
$tanggal_mulai   = date("Y-m-d");

$admin = new Admin();

if ($aksi == 'proses') {
    $status = "proses";
    $admin->update_status_cucian($id_cucian, $status);
    $admin->update_tanggal_selesai($id_cucian, "0000-00-00");

    header("location: ../view/Admin_Page.php");
} else if ($aksi == 'selesai') {
    $status = "siap diambil";
    $admin->update_status_cucian($id_cucian, $status);
    $admin->update_tanggal_selesai($id_cucian, date("Y-m-d H:i:s"));

    header("location: ../view/Admin_Page.php");
} else if ($aksi == 'hapus') {
    // Panggil fungsi hapus_cucian dari kelas Admin
    $admin->hapus_cucian($id_cucian);

    header("location: ../view/Admin_Page.php");
} 
?>
