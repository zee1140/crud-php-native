<?php
require_once 'config/koneksi.php';

// Query ambil semua data absensi
$query = "SELECT * FROM tb_absensi ORDER BY id DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Absensi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            background: #f4f4f4;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th {
            background: #007bff;
            color: white;
            padding: 12px;
        }

        td {
            padding: 10px;
            text-align: center;
        }

        tr:nth-child(even) {
            background: #f9f9f9;
        }

        .btn {
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 5px;
            color: white;
        }

        .edit {
            background: orange;
        }

        .hapus {
            background: red;
        }

        .tambah {
            background: green;
            display: inline-block;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

    <h2>Data Absensi Siswa</h2>

    <a href="tambah.php" class="btn tambah">+ Tambah Data</a>

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
                echo "<tr>
                        <td>".$no++."</td>
                        <td>".$row['id']."</td>
                        <td>".$row['nama_siswa']."</td>
                        <td>".$row['kelas']."</td>
                        <td>".$row['tanggal']."</td>
                        <td>".$row['status']."</td>
                        <td>
                            <a href='edit.php?id=".$row['id']."' class='btn edit'>Edit</a>
                            <a href='hapus.php?id=".$row['id']."' class='btn hapus' onclick='return confirm(\"Yakin hapus data?\")'>Hapus</a>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>Data tidak ada</td></tr>";
        }
        ?>
    </table>

</body>
</html>