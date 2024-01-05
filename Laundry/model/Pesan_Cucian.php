<?php
include "../controller/pelanggan.php";

session_start();

if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
  header('location: ../view/Masuk.php');
} 

$id_pelanggan    = $_SESSION['id_pelanggan'];
$berat           = $_POST['berat'];
$tanggal_mulai   = date("Y-m-d");
$tanggal_selesai = "";

$pelanggan = new pelanggan();

if ($pelanggan->pesan_laundry($id_pelanggan, $berat, $tanggal_mulai, $tanggal_selesai)) {
  header('location: ../view/Cucianku.php');
} else {
  echo "Gagal menambahkan pesanan Laundry.";
}
?>
