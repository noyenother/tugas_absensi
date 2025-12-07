<?php
include "koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Ambil nama file foto
    $query_pilih = "SELECT buktifoto FROM absensiukri WHERE id = ?";
    $stmt_pilih = mysqli_prepare($koneksi, $query_pilih);
    mysqli_stmt_bind_param($stmt_pilih, "i", $id);
    mysqli_stmt_execute($stmt_pilih);
    $result_pilih = mysqli_stmt_get_result($stmt_pilih);
    $data = mysqli_fetch_assoc($result_pilih);
    
    if (!$data) {
        die("Data tidak ditemukan.");
    }
    
    // Hapus foto fisik
    if ($data['buktifoto'] != "") {
        if (file_exists('gambar/' . $data['buktifoto'])) {
            unlink('gambar/' . $data['buktifoto']);
        }
    }
    
    mysqli_stmt_close($stmt_pilih);
    
    // Hapus data dari database
    $query_hapus = "DELETE FROM absensiukri WHERE id = ?";
    $stmt_hapus = mysqli_prepare($koneksi, $query_hapus);
    mysqli_stmt_bind_param($stmt_hapus, "i", $id);
    
    if (mysqli_stmt_execute($stmt_hapus)) {
        echo "<script>alert('Data berhasil dihapus!'); window.location='index.php';</script>";
    } else {
        die("Gagal menghapus data: " . mysqli_error($koneksi));
    }
    mysqli_stmt_close($stmt_hapus);
} else {
    echo "<script>alert('ID tidak valid!'); window.location='index.php';</script>";
}
?>
