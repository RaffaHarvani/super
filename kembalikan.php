<?php
include 'koneksi.php';

$id = (int)$_GET['id'];

// ambil data dulu
$data = query("SELECT * FROM peminjaman WHERE id = $id")[0];
$buku_id = $data['buku_id'];

// ubah status jadi dikembalikan
mysqli_query($conn,"UPDATE peminjaman 
SET status='dikembalikan' 
WHERE id=$id");

// kembalikan stok
mysqli_query($conn,"UPDATE buku 
SET stok = stok + 1 
WHERE id = $buku_id");

header("Location: index.php");
exit;
?>