<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "koneksi.php";

// CEK FOLDER GAMBAR
if (!file_exists('gambar')) {
    mkdir('gambar', 0777, true);
}

// AMBIL DATA
$namamahasiswa = $_POST['namamahasiswa'];
$npm = $_POST['npm'];
$kelas = $_POST['kelas'];
$status = $_POST['statuskehadiran'];
$foto_name = $_FILES['buktifoto']['name'];

// UPLOAD FOTO
if ($foto_name) {
    $ekstensi = pathinfo($foto_name, PATHINFO_EXTENSION);
    $ekstensi_diperbolehkan = ['jpg', 'jpeg', 'png'];
    
    if (in_array(strtolower($ekstensi), $ekstensi_diperbolehkan)) {
        $foto_baru = time() . '_' . $npm . '.' . $ekstensi;
        $tmp_name = $_FILES['buktifoto']['tmp_name'];
        
        if (move_uploaded_file($tmp_name, 'gambar/' . $foto_baru)) {
            // SIMPAN DATABASE
            $query = "INSERT INTO absensiukri (namamahasiswa, npm, kelas, statuskehadiran, buktifoto) VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($koneksi, $query);
            mysqli_stmt_bind_param($stmt, "sssss", $namamahasiswa, $npm, $kelas, $status, $foto_baru);
            
            if (mysqli_stmt_execute($stmt)) {
                echo "<script>alert('SUKSES! Data tersimpan');window.location='index.php';</script>";
            } else {
                echo "DB ERROR: " . mysqli_error($koneksi);
                unlink('gambar/' . $foto_baru); // rollback
            }
        } else {
            echo "GAGAL UPLOAD FOTO!";
        }
    } else {
        echo "FORMAT SALAH! Hanya JPG/PNG";
    }
}
?>
