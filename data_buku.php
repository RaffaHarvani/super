<?php
include 'koneksi.php';
$buku = query("SELECT * FROM buku");
?>

<h1>Data Buku</h1>
<a href="tambah_buku.php">Tambah Buku</a>

<table border="1">
<tr>
<th>No</th>
<th>Judul</th>
<th>Penulis</th>
<th>Stok</th>
<th>Aksi</th>
</tr>

<?php $no=1; foreach($buku as $b): ?>
<tr>
<td><?= $no++; ?></td>
<td><?= $b['judul']; ?></td>
<td><?= $b['penulis']; ?></td>
<td><?= $b['stok']; ?></td>
<td>
    <a href="ubah_buku.php?id=<?= $b['id']; ?>">Edit</a> |
    <a href="hapus_buku.php?id=<?= $b['id']; ?>" 
       onclick="return confirm('Yakin hapus buku?');">
       Hapus
    </a>
</td>
</tr>
<?php endforeach; ?>
</table>
<a href="index.php">Kembali</a>