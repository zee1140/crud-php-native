<?php
require_once 'config/koneksi.php';

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama_siswa'];
    $kelas = $_POST['kelas'];
    $tanggal = $_POST['tanggal'];
    $status = $_POST['status'];

    $query = "INSERT INTO tb_absensi (nama_siswa, kelas, tanggal, status) 
              VALUES ('$nama', '$kelas', '$tanggal', '$status')";

    if ($conn->query($query) === TRUE) {
        echo "<script>
                alert('Data berhasil ditambahkan!');
                window.location='index.php';
              </script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Data Absensi</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea, #764ba2);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            width: 450px;
            background: white;
            padding: 35px;
            border-radius: 18px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
            font-weight: 600;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 500;
            color: #444;
        }

        input, select {
            width: 100%;
            padding: 13px;
            margin-bottom: 18px;
            border: 1px solid #ddd;
            border-radius: 10px;
            font-size: 14px;
            transition: 0.3s;
        }

        input:focus, select:focus {
            border-color: #667eea;
            outline: none;
            box-shadow: 0 0 8px rgba(102,126,234,0.3);
        }

        button {
            width: 100%;
            padding: 14px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #5563d8;
            transform: translateY(-2px);
        }

        .back {
            display: block;
            text-align: center;
            margin-top: 18px;
            text-decoration: none;
            color: #667eea;
            font-weight: 500;
        }

        .back:hover {
            text-decoration: underline;
        }

        .icon {
            text-align: center;
            font-size: 45px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="icon">📘</div>
    <h2>Tambah Data Absensi</h2>

    <form method="POST">
        <label>Nama Siswa</label>
        <input type="text" name="nama_siswa" placeholder="Masukkan nama siswa" required>

        <label>Kelas</label>
        <input type="text" name="kelas" placeholder="Contoh: XII RPL 1" required>

        <label>Tanggal</label>
        <input type="date" name="tanggal" required>

        <label>Status</label>
        <select name="status" required>
            <option value="">Pilih Status</option>
            <option value="Hadir">Hadir</option>
            <option value="Izin">Izin</option>
            <option value="Sakit">Sakit</option>
            <option value="Alpha">Alpha</option>
        </select>

        <button type="submit" name="simpan">Simpan Data</button>
    </form>

    <a href="index.php" class="back">← Kembali ke Data Absensi</a>
</div>

</body>
</html>