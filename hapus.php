<?php
include 'koneksi.php';

if(!isset($_GET['id'])){
    die("ID tidak ditemukan");
}

$id = (int)$_GET['id'];

// ambil data transaksi dulu
$data = query("SELECT * FROM peminjaman WHERE id = $id")[0];
$buku_id = $data['buku_id'];

// hapus transaksi
mysqli_query($conn, "DELETE FROM peminjaman WHERE id = $id");

// balikin stok buku
mysqli_query($conn, "UPDATE buku SET stok = stok + 1 WHERE id = $buku_id");

header("Location: index.php");
exit;
?>