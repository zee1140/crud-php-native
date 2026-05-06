<?php
// ... (Kode PHP tetap sama dengan sebelumnya agar tetap aman) ...
require_once 'config/koneksi.php';
session_start();

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    header("Location: index.php");
    exit;
}

$stmt = $conn->prepare("SELECT * FROM tb_absensi WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (isset($_POST['update'])) {
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die("Token keamanan tidak valid.");
    }

    $nama    = htmlspecialchars($_POST['nama_siswa']);
    $kelas   = htmlspecialchars($_POST['kelas']);
    $tanggal = $_POST['tanggal'];
    $status  = $_POST['status'];

    $update = $conn->prepare("UPDATE tb_absensi SET nama_siswa=?, kelas=?, tanggal=?, status=? WHERE id=?");
    $update->bind_param("ssssi", $nama, $kelas, $tanggal, $status, $id);

    if ($update->execute()) {
        echo "<script>alert('Data Berhasil Diperbarui!'); window.location='index.php';</script>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Absensi - <?= htmlspecialchars($data['nama_siswa']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        <style>
    body { 
        background: linear-gradient(135deg, #667eea, #764ba2);
        min-height: 100vh;
        display: flex;
        align-items: center;
        font-family: 'Poppins', sans-serif;
    }

    .card { 
        border: none; 
        border-radius: 20px; 
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(0,0,0,0.15); 
    }

    .card-header { 
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white; 
        padding: 25px;
        border: none;
        text-align: center;
    }

    .btn-theme { 
        background: #667eea; 
        border: none; 
        color: white; 
        font-weight: 600;
        padding: 12px;
        transition: all 0.3s;
        border-radius: 10px;
    }

    .btn-theme:hover { 
        transform: translateY(-2px);
        background: #5563d8;
        box-shadow: 0 5px 15px rgba(102,126,234,0.35);
        color: white;
    }

    .form-control,
    .form-select {
        border-radius: 10px;
        padding: 12px;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.20rem rgba(102,126,234,0.25);
    }

    label {
        color: #444;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .icon-box {
        background: rgba(255,255,255,0.2);
        width: 55px;
        height: 55px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        font-size: 24px;
    }

    .btn-link {
        color: #667eea !important;
        font-weight: 500;
    }
</style>
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <div class="icon-box">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <h4 class="mb-0">Edit Data Absensi</h4>
                    <p class="small mb-0 opacity-75">Perbarui informasi kehadiran siswa</p>
                </div>
                <div class="card-body p-4">
                    <form method="POST">
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

                        <div class="mb-3">
                            <label><i class="fas fa-id-card me-2"></i>Nama Siswa</label>
                            <input type="text" name="nama_siswa" class="form-control form-control-lg" 
                                   value="<?= htmlspecialchars($data['nama_siswa']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label><i class="fas fa-door-open me-2"></i>Kelas</label>
                            <input type="text" name="kelas" class="form-control form-control-lg" 
                                   value="<?= htmlspecialchars($data['kelas']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label><i class="fas fa-calendar-alt me-2"></i>Tanggal</label>
                            <input type="date" name="tanggal" class="form-control form-control-lg" 
                                   value="<?= $data['tanggal'] ?>" required>
                        </div>

                        <div class="mb-4">
                            <label><i class="fas fa-info-circle me-2"></i>Status Kehadiran</label>
                            <select name="status" class="form-select form-select-lg">
                                <?php 
                                $status_options = ['Hadir', 'Izin', 'Sakit', 'Alpha'];
                                foreach($status_options as $opt) {
                                    $selected = ($data['status'] == $opt) ? 'selected' : '';
                                    echo "<option value='$opt' $selected>$opt</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" name="update" class="btn btn-purple btn-lg shadow-sm">
                                <i class="fas fa-sync-alt me-2"></i> Update Sekarang
                            </button>
                            <a href="index.php" class="btn btn-link text-muted text-decoration-none">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>