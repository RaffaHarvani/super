<?php
session_start();
include 'koneksi.php';

$id_user = $_SESSION['id'];

$total = query("SELECT COUNT(*) as jml FROM peminjaman WHERE anggota_id=$id_user")[0]['jml'];

$dipinjam = query("SELECT COUNT(*) as jml FROM peminjaman 
WHERE anggota_id=$id_user AND status='dipinjam'")[0]['jml'];

$kembali = query("SELECT COUNT(*) as jml FROM peminjaman 
WHERE anggota_id=$id_user AND status='dikembalikan'")[0]['jml'];

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

$buku = query("SELECT * FROM buku");
?>

<h2>Halo, <?= $_SESSION['nama']; ?></h2>

<a href="riwayat.php">Lihat Riwayat</a> |
<a href="logout.php">Logout</a>

<h3>Daftar Buku</h3>

<table border="1" cellpadding="10">
<tr>
    <th>No</th>
    <th>Judul</th>
    <th>Penulis</th>
    <th>Stok</th>
    <th>Aksi</th>
</tr>

<?php $no=1; ?>
<?php foreach($buku as $b): ?>
<tr>
<td><?= $no++; ?></td>
<td><?= $b['judul']; ?></td>
<td><?= $b['penulis']; ?></td>
<td><?= $b['stok']; ?></td>
<td>
<?php if($b['stok'] > 0): ?>
<a href="pinjam.php?id=<?= $b['id']; ?>">Pinjam</a>
<?php else: ?>
Stok habis
<?php endif; ?>
</td>
</tr>
<?php endforeach; ?>
</table>

<h3>Statistik Saya</h3>

<div style="display:flex; gap:20px; margin-bottom:20px;">

<div style="background:#3498db; color:white; padding:15px; border-radius:10px;">
    Total Pinjam<br><b><?= $total; ?></b>
</div>

<div style="background:#e67e22; color:white; padding:15px; border-radius:10px;">
    Sedang Dipinjam<br><b><?= $dipinjam; ?></b>
</div>

<div style="background:#2ecc71; color:white; padding:15px; border-radius:10px;">
    Sudah Dikembalikan<br><b><?= $kembali; ?></b>
</div>

</div>