<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Absensi Mahasiswa UKRI</title>
    <style>
        body { font-family: Arial, sans-serif; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); margin: 0; padding: 20px; }
        .container { max-width: 1200px; margin: auto; background: white; padding: 30px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.3); }
        h1 { text-align: center; color: #333; margin-bottom: 30px; }
        .btn-tambah { background: #28a745; color: white; padding: 12px 25px; text-decoration: none; border-radius: 8px; display: inline-block; margin-bottom: 20px; }
        .btn-tambah:hover { background: #218838; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 15px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; font-weight: bold; }
        tr:hover { background: #f8f9fa; }
        .foto { width: 60px; height: 60px; object-fit: cover; border-radius: 8px; }
        .btn { padding: 8px 15px; border-radius: 5px; text-decoration: none; margin: 0 5px; }
        .btn-detail { background: #007bff; color: white; }
        .btn-edit { background: #ffc107; color: #333; }
        .btn-hapus { background: #dc3545; color: white; }
        .status-hadir { background: #d4edda; color: #155724; padding: 5px 10px; border-radius: 20px; font-size: 12px; }
        .status-sakit { background: #f8d7da; color: #721c24; padding: 5px 10px; border-radius: 20px; font-size: 12px; }
        .status-izin { background: #fff3cd; color: #856404; padding: 5px 10px; border-radius: 20px; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>📋 Sistem Absensi Mahasiswa UKRI</h1>
        <a href="tambah.php" class="btn-tambah">+ Tambah Absensi Baru</a>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>NPM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Kelas</th>
                    <th>Status</th>
                    <th>Bukti Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM absensiukri ORDER BY id DESC";
                $result = mysqli_query($koneksi, $query);
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><strong><?php echo htmlspecialchars($row['npm']); ?></strong></td>
                    <td><?php echo htmlspecialchars($row['namamahasiswa']); ?></td>
                    <td><?php echo $row['kelas']; ?></td>
                    <td>
                        <?php if($row['statuskehadiran'] == 'Hadir'): ?>
                            <span class="status-hadir">Hadir</span>
                        <?php elseif($row['statuskehadiran'] == 'Sakit'): ?>
                            <span class="status-sakit">Sakit</span>
                        <?php else: ?>
                            <span class="status-izin">Izin</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($row['buktifoto']): ?>
                            <img src="gambar/<?php echo $row['buktifoto']; ?>" class="foto" alt="Bukti">
                        <?php else: ?>
                            <span>-</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="detail.php?id=<?php echo $row['id']; ?>" class="btn btn-detail">Detail</a>
                        <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-edit">Edit</a>
                        <a href="hapus.php?id=<?php echo $row['id']; ?>" class="btn btn-hapus" onclick="return confirm('Yakin hapus data?')">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
