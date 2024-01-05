// Memantau perubahan pada input status
document.getElementById("status").addEventListener("change", function() {
    var statusValue = this.value;
    var statusBadge = document.getElementById("statusBadge");

    if (statusValue === "siap_diambil") {
        // Mengisi input tanggal selesai dengan waktu saat ini ketika status menjadi "Siap Diambil"
        var tanggalSelesaiInput = document.getElementById("tanggalSelesai");
        tanggalSelesaiInput.value = currentTime;

        // Menonaktifkan input tanggal selesai
        tanggalSelesaiInput.setAttribute("disabled", "disabled");

        // Mengubah tampilan status badge menjadi "Siap Diambil"
        statusBadge.textContent = "Siap Diambil";
        statusBadge.className = "badge badge-success";
    } else if (statusValue === "proses") {
        // Menghapus nilai dan mengaktifkan input tanggal selesai untuk status "Proses"
        document.getElementById("tanggalSelesai").value = "";
        document.getElementById("tanggalSelesai").removeAttribute("disabled");

        // Mengubah tampilan status badge menjadi "Proses"
        statusBadge.textContent = "Proses";
        statusBadge.className = "badge badge-primary";
    } else {
        // Menghapus nilai dan mengaktifkan input tanggal selesai untuk status "Antrian"
        document.getElementById("tanggalSelesai").value = "";
        document.getElementById("tanggalSelesai").removeAttribute("disabled");

        // Mengubah tampilan status badge menjadi "Antrian"
        statusBadge.textContent = "Antrian";
        statusBadge.className = "badge badge-danger";
    }
});

document.getElementById("prosesButton").addEventListener("click", function() {
    var statusBadge = document.getElementById("statusBadge");

    // Mengubah tampilan status badge menjadi "Proses"
    statusBadge.textContent = "Proses";
    statusBadge.className = "badge badge-primary";

    // Menghapus nilai tanggal selesai
    document.getElementById("tanggalSelesai").value = "";
});

document.getElementById("selesaiButton").addEventListener("click", function() {
    var statusBadge = document.getElementById("statusBadge");
    var tanggalSelesaiInput = document.getElementById("tanggalSelesai");

    // Mengisi input tanggal selesai dengan waktu saat ini
    var currentTime = new Date().toISOString().slice(0, 16);
    tanggalSelesaiInput.value = currentTime;

    // Mengubah tampilan status badge menjadi "Selesai"
    statusBadge.textContent = "Selesai";
    statusBadge.className = "badge badge-success";
});

