<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION['id'];

$data = query("SELECT peminjaman.*, buku.judul 
FROM peminjaman
JOIN buku ON peminjaman.buku_id = buku.id
WHERE anggota_id = $id_user");
?>

<h2>Riwayat Peminjaman</h2>

<a href="user.php">Kembali</a>

<table border="1" cellpadding="10">
<tr>
    <th>No</th>
    <th>Buku</th>
    <th>Tanggal Pinjam</th>
    <th>Kembali</th>
    <th>Status</th>
</tr>

<?php $no=1; ?>
<?php foreach($data as $d): ?>
<tr>
<td><?= $no++; ?></td>
<td><?= $d['judul']; ?></td>
<td><?= $d['tanggal_pinjam']; ?></td>
<td><?= $d['tanggal_kembali']; ?></td>
<td><?= $d['status']; ?></td>
</tr>
<?php endforeach; ?>
</table>