<?php
require_once 'config/koneksi.php';

$id = $_GET['id'];

$query = "DELETE FROM tb_absensi WHERE id=$id";

if ($conn->query($query) === TRUE) {
    echo "<script>
            alert('Data berhasil dihapus!');
            window.location='index.php';
          </script>";
} else {
    echo "Error: " . $conn->error;
}
?>