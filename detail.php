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
    echo "<script>alert('Silakan pilih data!'); window.location='index.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Detail Absensi - <?php echo $data['namamahasiswa']; ?></title>
    <style>
        body { font-family: Arial, sans-serif; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); margin: 0; padding: 20px; }
        .container { max-width: 800px; margin: auto; background: white; padding: 40px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.3); }
        h1 { text-align: center; color: #333; margin-bottom: 30px; }
        .info-card { background: #f8f9fa; padding: 25px; border-radius: 10px; margin: 20px 0; }
        .foto-detail { max-width: 300px; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.2); display: block; margin: 20px auto; }
        .status-badge { display: inline-block; padding: 10px 20px; border-radius: 25px; font-weight: bold; font-size: 16px; margin: 10px 0; }
        .status-hadir { background: #d4edda; color: #155724; }
        .status-sakit { background: #f8d7da; color: #721c24; }
        .status-izin { background: #fff3cd; color: #856404; }
        .btn-kembali { background: #6c757d; color: white; padding: 12px 25px; text-decoration: none; border-radius: 8px; display: inline-block; }
    </style>
</head>
<body>
    <div class="container">
        <h1>👤 Detail Absensi Mahasiswa</h1>
        <div class="info-card">
            <h2><?php echo htmlspecialchars($data['namamahasiswa']); ?></h2>
            <p><strong>NPM:</strong> <?php echo $data['npm']; ?></p>
            <p><strong>Kelas:</strong> <?php echo $data['kelas']; ?></p>
            <p><strong>Status:</strong> 
                <span class="status-badge status-<?php echo strtolower($data['statuskehadiran']); ?>">
                    <?php echo $data['statuskehadiran']; ?>
                </span>
            </p>
            <?php if($data['buktifoto']): ?>
                <p><strong>Bukti Kehadiran:</strong></p>
                <img src="gambar/<?php echo $data['buktifoto']; ?>" class="foto-detail" alt="Bukti">
            <?php else: ?>
                <p><strong>Bukti:</strong> Tidak ada</p>
            <?php endif; ?>
        </div>
        <a href="index.php" class="btn-kembali">← Kembali ke Daftar</a>
    </div>
</body>
</html>
