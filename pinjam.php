<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION['id'];
$id_buku = (int)$_GET['id'];

// ambil data buku
$buku = query("SELECT * FROM buku WHERE id=$id_buku")[0];

if(isset($_POST['submit'])){

    $lama = $_POST['lama'];
    $tgl = date('Y-m-d');
    $kembali = date('Y-m-d', strtotime("+$lama days"));

    // cek stok lagi
    if($buku['stok'] > 0){

        mysqli_query($conn,"INSERT INTO peminjaman
        VALUES('', '$id_user','$id_buku','$tgl','$lama','$kembali','dipinjam')");

        mysqli_query($conn,"UPDATE buku SET stok = stok - 1 WHERE id=$id_buku");

        echo "<script>
            alert('Berhasil pinjam buku');
            document.location.href='user.php';
        </script>";

    } else {
        echo "<script>alert('Stok habis');</script>";
    }
}
?>

<h2>Pinjam Buku</h2>

<p><b>Judul:</b> <?= $buku['judul']; ?></p>
<p><b>Penulis:</b> <?= $buku['penulis']; ?></p>
<p><b>Stok:</b> <?= $buku['stok']; ?></p>

<form method="POST">
    <label>Lama Pinjam (hari):</label><br>
    <input type="number" name="lama" min="1" max="7" required>
    <br><br>

    <button type="submit" name="submit">Pinjam</button>
</form>