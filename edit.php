<?php
include "koneksi.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM absensiukri WHERE id = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_assoc($result);
    
    if (!$data) {
        echo "<script>alert('Data tidak ditemukan!'); window.location='index.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('Silakan pilih data terlebih dahulu!'); window.location='index.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Absensi</title>
    <style>
        body { font-family: Arial, sans-serif; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: auto; background: white; padding: 40px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.3); }
        h1 { text-align: center; color: #333; margin-bottom: 30px; }
        label { display: block; margin: 20px 0 8px; font-weight: bold; color: #555; }
        input[type="text"], input[type="file"], select { width: 100%; padding: 12px; border: 2px solid #ddd; border-radius: 8px; box-sizing: border-box; font-size: 16px; }
        input[type="text"]:focus { border-color: #667eea; outline: none; }
        .radio-group { display: flex; gap: 20px; margin: 20px 0; }
        .radio-item { display: flex; align-items: center; }
        .radio-item input[type="radio"] { width: auto; margin-right: 8px; }
        button { background: linear-gradient(135deg, #28a745 0%, #20c997 100%); color: white; padding: 15px 30px; border: none; border-radius: 8px; font-size: 18px; cursor: pointer; width: 100%; margin-top: 20px; }
        button:hover { opacity: 0.9; }
        .foto-lama { max-width: 200px; border-radius: 10px; margin: 10px 0; }
        .btn-kembali { background: #6c757d; color: white; text-decoration: none; display: inline-block; padding: 12px 25px; margin-top: 20px; border-radius: 8px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>✏️ Edit Data Absensi</h1>
        <form method="POST" action="prosesedit.php" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
            
            <label>Nama Mahasiswa:</label>
            <input type="text" name="namamahasiswa" value="<?php echo $data['namamahasiswa']; ?>" required>
            
            <label>NPM:</label>
            <input type="text" name="npm" value="<?php echo $data['npm']; ?>" required>
            
            <label>Kelas:</label>
            <input type="text" name="kelas" value="<?php echo $data['kelas']; ?>" required>
            
            <label>Status Kehadiran:</label>
            <div class="radio-group">
                <div class="radio-item">
                    <input type="radio" name="statuskehadiran" value="Hadir" <?php echo $data['statuskehadiran']=='Hadir'?'checked':''; ?>> <strong>Hadir</strong>
                </div>
                <div class="radio-item">
                    <input type="radio" name="statuskehadiran" value="Sakit" <?php echo $data['statuskehadiran']=='Sakit'?'checked':''; ?>> <strong>Sakit</strong>
                </div>
                <div class="radio-item">
                    <input type="radio" name="statuskehadiran" value="Izin" <?php echo $data['statuskehadiran']=='Izin'?'checked':''; ?>> <strong>Izin</strong>
                </div>
            </div>
            
            <label>Foto Saat Ini:</label>
            <?php if($data['buktifoto']): ?>
                <img src="gambar/<?php echo $data['buktifoto']; ?>" class="foto-lama" alt="Foto Saat Ini">
            <?php endif; ?><br>
            
            <label>Ganti Foto (Opsional):</label>
            <input type="file" name="buktifoto" accept="image/*">
            
            <button type="submit">Update Absensi</button>
        </form>
        <a href="index.php" class="btn-kembali">← Kembali</a>
    </div>
</body>
</html>
