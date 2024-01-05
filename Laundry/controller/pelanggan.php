<?php
require_once "user.php";

class Pelanggan extends User {
    
    public function pesan_laundry($id_pelanggan, $berat, $tanggal_mulai) {
        // Inisialisasi $tanggal_selesai sesuai kebutuhan
        $tanggal_selesai = "";
        
        $query = "INSERT INTO cucian (id_pelanggan, berat, harga, tanggal_mulai, tanggal_selesai, status) 
                  VALUES ('$id_pelanggan', '$berat', '$berat' * 5000, '$tanggal_mulai', '$tanggal_selesai', 'Antrian')";
    
        $result = $this->koneksi->query($query);
    
        if ($result) {
            return true;
        } else {
           return false;
        }
    }

    public function get_laundry_data($id_pelanggan) {
        $query = "SELECT c.id_cucian, p.nama, c.berat, c.harga, c.tanggal_mulai, c.status, c.tanggal_selesai
                  FROM cucian c
                  JOIN pelanggan p ON c.id_pelanggan = p.id_pelanggan
                  WHERE p.id_pelanggan = '$id_pelanggan'
                  ORDER BY c.id_cucian";

        $result = $this->koneksi->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        } else {
            return false;
        }
    } 
       
}

?>
