<?php
include 'koneksi.php';

$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

$query = "SELECT peminjaman.*, anggota.nama, buku.judul 
FROM peminjaman
JOIN anggota ON peminjaman.anggota_id = anggota.id
JOIN buku ON peminjaman.buku_id = buku.id
";

if($keyword != ''){
    $query .= " WHERE anggota.nama LIKE '%$keyword%' 
                OR buku.judul LIKE '%$keyword%'";
}

$data = query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Data Peminjaman Buku</title>

<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f6f9;
    margin: 20px;
}

h1 {
    color: #333;
}

.menu a {
    text-decoration: none;
    color: #007bff;
    margin-right: 10px;
    font-weight: bold;
}

.menu a:hover {
    text-decoration: underline;
}

table {
    border-collapse: collapse;
    width: 100%;
    background-color: white;
    margin-top: 15px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

th, td {
    padding: 10px;
    text-align: center;
}

th {
    background-color: #007bff;
    color: white;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

.aksi a {
    text-decoration: none;
    padding: 5px 8px;
    border-radius: 5px;
    font-size: 13px;
}

.kembali {
    background-color: #28a745;
    color: white;
}

.edit {
    background-color: #ffc107;
    color: black;
}

.hapus {
    background-color: #dc3545;
    color: white;
}

.status-dipinjam {
    color: red;
    font-weight: bold;
}

.status-kembali {
    color: green;
    font-weight: bold;
}
</style>
</head>

<body>

<h1>📚 Data Peminjaman Buku</h1>

<div class="menu">
    <a href="tambah.php">Tambah Peminjaman</a> |
    <a href="tambah_buku.php">Tambah Buku</a> |
    <a href="tambah_anggota.php">Tambah Anggota</a> |
    <a href="data_buku.php">Data Buku</a> |
    <a href="data_anggota.php">Data Anggota</a>
</div>
<form method="GET">
    <input type="text" name="keyword" placeholder="Cari data..." 
    value="<?= isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>">
    <button type="submit">Cari</button>
</form>
<br>
<table>
<tr>
    <th>No</th>
    <th>Nama</th>
    <th>Buku</th>
    <th>Tanggal</th>
    <th>Lama</th>
    <th>Kembali</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

<?php $no=1; ?>
<?php foreach($data as $d): ?>

<tr>
<td><?= $no++; ?></td>
<td><?= $d['nama']; ?></td>
<td><?= $d['judul']; ?></td>
<td><?= $d['tanggal_pinjam']; ?></td>
<td><?= $d['lama_pinjam']; ?> hari</td>
<td><?= $d['tanggal_kembali']; ?></td>

<td>
<?php if($d['status']=='dipinjam'): ?>
    <span class="status-dipinjam">Dipinjam</span>
<?php else: ?>
    <span class="status-kembali">Dikembalikan</span>
<?php endif; ?>
</td>

<td class="aksi">

<?php if($d['status']=='dipinjam'): ?>
<a href="kembalikan.php?id=<?= $d['id']; ?>" class="kembali">Kembalikan</a>
<?php endif; ?>

<a href="ubah.php?id=<?= $d['id']; ?>" class="edit">Edit</a>

<a href="hapus.php?id=<?= $d['id']; ?>" 
class="hapus"
onclick="return confirm('Yakin hapus?');">
Hapus
</a>

</td>
</tr>

<?php endforeach; ?>

</table>

</body>
</html>