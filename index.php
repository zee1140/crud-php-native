<?php
require_once 'config/koneksi.php';

$query = "SELECT * FROM tb_absensi ORDER BY id DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Absensi Siswa</title>

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
            padding: 40px;
        }

        .container {
            background: white;
            border-radius: 18px;
            padding: 30px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
            font-weight: 600;
        }

        .top-bar {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            margin-bottom: 20px;
        }

        .btn {
            padding: 10px 16px;
            text-decoration: none;
            border-radius: 10px;
            color: white;
            font-size: 14px;
            font-weight: 500;
            transition: 0.3s;
            display: inline-block;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .tambah {
            background: #10b981;
        }

        .edit {
            background: #f59e0b;
        }

        .hapus {
            background: #ef4444;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 12px;
            overflow: hidden;
        }

        th {
            background: #667eea;
            color: white;
            padding: 14px;
            font-weight: 500;
        }

        td {
            padding: 14px;
            text-align: center;
            border-bottom: 1px solid #eee;
        }

        tr:hover {
            background: #f8f9ff;
        }

        .status {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
            color: white;
        }

        .hadir {
            background: #10b981;
        }

        .izin {
            background: #3b82f6;
        }

        .sakit {
            background: #f59e0b;
        }

        .alpha {
            background: #ef4444;
        }

        .empty {
            padding: 20px;
            color: #888;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>📘 Data Absensi Siswa</h2>

    <div class="top-bar">
        <a href="tambah.php" class="btn tambah">+ Tambah Data</a>
    </div>

    <table>
        <tr>
            <th>No</th>
            <th>ID</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            $no = 1;
            while($row = $result->fetch_assoc()) {

                $statusClass = strtolower($row['status']);

                echo "<tr>
                        <td>".$no++."</td>
                        <td>".$row['id']."</td>
                        <td>".$row['nama_siswa']."</td>
                        <td>".$row['kelas']."</td>
                        <td>".$row['tanggal']."</td>
                        <td><span class='status $statusClass'>".$row['status']."</span></td>
                        <td>
                            <a href='edit.php?id=".$row['id']."' class='btn edit'>Edit</a>
                            <a href='hapus.php?id=".$row['id']."' class='btn hapus' onclick='return confirm(\"Yakin hapus data?\")'>Hapus</a>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='7' class='empty'>Belum ada data absensi</td></tr>";
        }
        ?>
    </table>
</div>

</body>
</html>