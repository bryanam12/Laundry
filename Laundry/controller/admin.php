<?php
require_once "user.php";

class admin extends user {

    public function is_admin($id_admin) {
        $query = "SELECT * FROM admin WHERE id = '$id_admin'";
        $result = $this->koneksi->query($query);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function get_total_harga() {
        $query = "SELECT SUM(harga) AS total FROM cucian";
        $result = $this->koneksi->query($query);

        $row = $result->fetch_assoc();
        $totalHarga = $row['total'];
        return $totalHarga;
    }

    public function get_status_cucian_selesai() {
        $query = "SELECT COUNT(*) AS total FROM cucian WHERE status = 'siap diambil'";
        $result = $this->koneksi->query($query);
        
        $row = $result->fetch_assoc();
        $totalCucianSelesai = $row['total'];
        return $totalCucianSelesai;
    }

    public function get_status_cucian_proses() {
        $query = "SELECT COUNT(*) AS total FROM cucian WHERE status = 'proses'";
        $result = $this->koneksi->query($query);
        
        $row = $result->fetch_assoc();
        $totalCucianProses = $row['total'];
        return $totalCucianProses;
    }
    
    public function get_laundry_data() {
        $query = "SELECT c.id_cucian, p.nama, c.berat, c.harga, c.tanggal_mulai, c.status, c.tanggal_selesai
                  FROM cucian c
                  JOIN pelanggan p ON c.id_pelanggan = p.id_pelanggan
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
    
    public function update_status_cucian($id_cucian, $status) {
        $query = "UPDATE cucian SET status='$status' WHERE id_cucian = '$id_cucian'";
        $result = $this->koneksi->query($query);
    
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function update_tanggal_selesai($id_cucian, $tanggal_selesai) {
        $query = "UPDATE cucian SET tanggal_selesai='$tanggal_selesai' WHERE id_cucian = '$id_cucian'";
        $result = $this->koneksi->query($query);
    
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function hapus_cucian($id_cucian) {
        $query = "DELETE FROM cucian WHERE id_cucian = '$id_cucian'";
        $result = $this->koneksi->query($query);
    
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    
    
    
}

?>