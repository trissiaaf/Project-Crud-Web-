<?php
session_start();
include 'koneksi.php';

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $koneksi->query("INSERT INTO kategori (nama_kategori) VALUES ('$nama')");
    $_SESSION['msg'] = "Kategori berhasil ditambahkan!";
    header("Location: kategori.php");
    exit;
}
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $koneksi->query("DELETE FROM kategori WHERE id_kategori = $id");
    $_SESSION['msg'] = "Kategori berhasil dihapus!";
    header("Location: kategori.php");
    exit;
}
$kategori = $koneksi->query("SELECT * FROM kategori");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kategori</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
<?php include 'navbar.php'; ?>
<h2>Data Kategori</h2>
<?php if (isset($_SESSION['msg'])): ?>
<div class="alert alert-info"><?= $_SESSION['msg']; unset($_SESSION['msg']); ?></div>
<?php endif; ?>
<form method="post" class="mb-3">
    <input name="nama" class="form-control mb-2" placeholder="Nama Kategori" required>
    <button class="btn btn-primary">Tambah Kategori</button>
</form>

<table class="table table-bordered">
    <tr><th>Nama Kategori</th><th>Aksi</th></tr>
    <?php while($k = $kategori->fetch_assoc()): ?>
    <tr>
        <td><?= $k['nama_kategori'] ?></td>
        <td><a href="?hapus=<?= $k['id_kategori'] ?>" class="btn btn-danger btn-sm">Hapus</a></td>
    </tr>
    <?php endwhile; ?>
</table>
</body>
</html>