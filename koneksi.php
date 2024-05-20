<?php
    // Informasi koneksi database
    $host = 'localhost'; // Nama host database
    $user = 'root';      // Nama pengguna database
    $pass = '';          // Kata sandi database
    $db   = 'absensi';   // Nama database yang ingin Anda hubungkan

    // Membuat koneksi
    $conn = new mysqli($host, $user, $pass, $db);

    // Memeriksa koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Query untuk mendapatkan data name, time, dan card_id dari tabel data_absensi
    $sql = "SELECT name, time, card_id FROM data_absensi";
    $result = $conn->query($sql);

    // Memeriksa apakah query berhasil dieksekusi
    if ($result === false) {
        die("Error: " . $conn->error);
    }

    // Inisialisasi variabel untuk menyimpan hasil
    $output = '';

    // Memeriksa apakah ada data yang ditemukan
    if ($result->num_rows > 0) {
        // Output data dari setiap baris
        while($row = $result->fetch_assoc()) {
            // Memeriksa apakah setiap kolom memiliki data sebelum mencetaknya
            $name = isset($row['name']) ? $row['name'] : 'Data tidak tersedia';
            $time = isset($row['time']) ? $row['time'] : 'Data tidak tersedia';
            $card_id = isset($row['card_id']) ? $row['card_id'] : 'Data tidak tersedia';

            // Menyimpan data ke variabel output
            $output .= "<tr><td>" . $name . "</td><td>" . $time . "</td><td>" . $card_id . "</td></tr>";
        }
    } else {
        $output = "<tr><td colspan='3'>Tidak ada data yang ditemukan</td></tr>";
    }

    // Menutup koneksi
    $conn->close();
?>

