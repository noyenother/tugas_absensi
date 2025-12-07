<?php
include "koneksi.php";

$id = $_POST['id'];
$namamahasiswa = $_POST['namamahasiswa'];
$npm = $_POST['npm'];
$kelas = $_POST['kelas'];
$statuskehadiran = $_POST['statuskehadiran'];
$foto = $_FILES['buktifoto']['name'];

if ($foto != "") {
    // Hapus foto lama
    $query_lama = "SELECT buktifoto FROM absensiukri WHERE id = ?";
    $stmt_lama = mysqli_prepare($koneksi, $query_lama);
    mysqli_stmt_bind_param($stmt_lama, "i", $id);
    mysqli_stmt_execute($stmt_lama);
    $result_lama = mysqli_stmt_get_result($stmt_lama);
    $data_lama = mysqli_fetch_assoc($result_lama);
    
    if ($data_lama['buktifoto'] != "") {
        unlink('gambar/' . $data_lama['buktifoto']);
    }
    
    // Upload foto baru
    $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
    $x = explode('.', strtolower($foto));
    $ekstensi = end($x);
    $nama_foto_baru = rand(1,999) . '.' . $ekstensi;
    $tmp = $_FILES['buktifoto']['tmp_name'];
    
    if (in_array($ekstensi, $ekstensi_diperbolehkan) == true) {
        move_uploaded_file($tmp, 'gambar/' . $nama_foto_baru);
        
        $query = "UPDATE absensiukri SET namamahasiswa=?, npm=?, kelas=?, statuskehadiran=?, buktifoto=? WHERE id=?";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, "sssssi", $namamahasiswa, $npm, $kelas, $statuskehadiran, $nama_foto_baru, $id);
        
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Data berhasil diubah!'); window.location='index.php';</script>";
        } else {
            die("Gagal update: " . mysqli_error($koneksi));
        }
    } else {
        echo "<script>alert('Ekstensi gambar salah!'); window.location='edit.php?id=$id';</script>";
    }
} else {
    // Update tanpa ganti foto
    $query = "UPDATE absensiukri SET namamahasiswa=?, npm=?, kelas=?, statuskehadiran=? WHERE id=?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "ssssi", $namamahasiswa, $npm, $kelas, $statuskehadiran, $id);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Data berhasil diubah!'); window.location='index.php';</script>";
    } else {
        die("Gagal update: " . mysqli_error($koneksi));
    }
}
?>
