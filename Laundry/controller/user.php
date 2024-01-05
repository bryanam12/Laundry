<?php

include "koneksi.php";

class user {

    protected $koneksi;

    public function __construct() {
        $this->koneksi = new mysqli("localhost", "root", "", "laundry");
        $db = new Koneksi();
        // Encapitulation
        $db->set_connection($this->koneksi);
        $db->get_connection();
    }

    public function get_user_data() {
        $sql = "SELECT * FROM pelanggan";
        $result = $this->koneksi->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        } else {
            return false;
        }
    }

    public function get_user_data_by_id($id_pelanggan) {
        $sql = "SELECT * FROM pelanggan WHERE id_pelanggan = '$id_pelanggan'";
        $result = $this->koneksi->query($sql);
    
        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            return $data;
        } else {
            return false;
        }
    }
    

    public function validasi_login($username, $password) {
        // Validasi pada tabel pelanggan
        $sqlPelanggan = "SELECT * FROM pelanggan WHERE username='$username' AND password='".md5($password)."'";
        $resultPelanggan = $this->koneksi->query($sqlPelanggan);
    
        // Validasi pada tabel admin
        $sqlAdmin = "SELECT * FROM admin WHERE username='$username' AND password='".md5($password)."'";
        $resultAdmin = $this->koneksi->query($sqlAdmin);
    
        if ($resultPelanggan->num_rows > 0) {
            // Data ditemukan pada tabel pelanggan
            $data = mysqli_fetch_assoc($resultPelanggan);
            $_SESSION['username']     = $data['username'];
            $_SESSION['password']     = $data['password'];
            $_SESSION['nama']         = $data['nama'];
            $_SESSION['id_pelanggan'] = $data['id_pelanggan'];
            // Tambahkan sesuaikan dengan data yang ingin Anda simpan
    
            header("Location: ../view/index.php");
        } elseif ($resultAdmin->num_rows > 0) {
            // Data ditemukan pada tabel admin
            $data = mysqli_fetch_assoc($resultAdmin);
            $_SESSION['id']     = $data['id'];
            $_SESSION['username']     = $data['username'];
            $_SESSION['password']     = $data['password'];

            header("Location: ../view/Admin_Page.php");
        } else {
            echo "<script>
                    alert('Username atau password salah');
                    window.location.href = '../view/masuk.php';
                  </script>";
        }
    }
    

    public function daftar_akun($nama, $alamat, $hp, $username, $password) {
        $sql = "INSERT INTO pelanggan (nama, alamat, hp, username, password) VALUES ('$nama', '$alamat', '$hp', '$username', MD5('$password'))";
        $result = $this->koneksi->query($sql);

        if($result) {
            echo "<div class='alert alert-danger' role='alert'>Berhasil membuat akun</div>";
            header("location: ../view/index.php");
        } else {
            echo "<div class='alert alert-danger' role='alert'>Terjadi kesalahan saat membuat akun</div>";
            header("location: ../view/Daftar.php");
        }
    }
    
}
?>