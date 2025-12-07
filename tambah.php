<!DOCTYPE html>
<html>
<head>
    <title>Tambah Absensi</title>
    <style>
        body { font-family: Arial, sans-serif; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: auto; background: white; padding: 40px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.3); }
        h1 { text-align: center; color: #333; margin-bottom: 30px; }
        label { display: block; margin: 20px 0 8px; font-weight: bold; color: #555; }
        input[type="text"], input[type="file"], select { width: 100%; padding: 12px; border: 2px solid #ddd; border-radius: 8px; box-sizing: border-box; font-size: 16px; }
        input[type="text"]:focus, select:focus { border-color: #667eea; outline: none; }
        .radio-group { display: flex; gap: 20px; margin: 20px 0; }
        .radio-item { display: flex; align-items: center; }
        .radio-item input[type="radio"] { width: auto; margin-right: 8px; }
        button { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 15px 30px; border: none; border-radius: 8px; font-size: 18px; cursor: pointer; width: 100%; margin-top: 20px; }
        button:hover { opacity: 0.9; }
        .btn-kembali { background: #6c757d; text-decoration: none; display: inline-block; padding: 12px 25px; margin-top: 20px; border-radius: 8px; color: white; }
    </style>
</head>
<body>
    <div class="container">
        <h1>➕ Tambah Data Absensi</h1>
        <form method="POST" action="prosestambah.php" enctype="multipart/form-data">
            <label>Nama Mahasiswa:</label>
            <input type="text" name="namamahasiswa" required>
            
            <label>NPM:</label>
            <input type="text" name="npm" required>
            
            <label>Kelas:</label>
            <input type="text" name="kelas" placeholder="Contoh: 4A" required>
            
            <label>Status Kehadiran:</label>
            <div class="radio-group">
                <div class="radio-item">
                    <input type="radio" name="statuskehadiran" value="Hadir" required> <strong>Hadir</strong>
                </div>
                <div class="radio-item">
                    <input type="radio" name="statuskehadiran" value="Sakit" required> <strong>Sakit</strong>
                </div>
                <div class="radio-item">
                    <input type="radio" name="statuskehadiran" value="Izin" required> <strong>Izin</strong>
                </div>
            </div>
            
            <label>Bukti Foto Selfie / Surat:</label>
            <input type="file" name="buktifoto" accept="image/*" required>
            
            <button type="submit">Simpan Absensi</button>
        </form>
        <a href="index.php" class="btn-kembali">← Kembali</a>
    </div>
</body>
</html>
