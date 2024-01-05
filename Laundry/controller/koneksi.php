<?php
class Koneksi {
    private $koneksi;

    public function __construct() {
        $this->koneksi = null;
    }

    public function set_connection(mysqli $koneksi) {
        $this->koneksi = $koneksi;
    }

    public function get_connection() {
        return $this->koneksi;
    }
}
?>