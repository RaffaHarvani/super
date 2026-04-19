<?php
include 'koneksi.php';
$anggota = query("SELECT * FROM anggota");
?>

<h1>Data Anggota</h1>
<a href="tambah_anggota.php">Tambah Anggota</a>

<table border="1">
<tr>
<th>No</th>
<th>Nama</th>
<th>Email</th>
<th>No HP</th>
<th>AKsi</th>
</tr>

<?php $no=1; foreach($anggota as $a): ?>
<tr>
<td><?= $no++; ?></td>
<td><?= $a['nama']; ?></td>
<td><?= $a['email']; ?></td>
<td><?= $a['no_hp']; ?></td>
<td>
    <a href="ubah_anggota.php?id=<?= $a['id']; ?>">Edit</a> |
    <a href="hapus_anggota.php?id=<?= $a['id']; ?>" 
       onclick="return confirm('Yakin hapus anggota?');">
       Hapus
    </a>
</td>
</tr>
<?php endforeach; ?>
</table>
<a href="index.php">kembali</a>