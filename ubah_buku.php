<?php
include 'koneksi.php';

$id = (int)$_GET['id'];
$buku = query("SELECT * FROM buku WHERE id=$id")[0];

if(isset($_POST['submit'])){
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $stok = $_POST['stok'];

    mysqli_query($conn,"UPDATE buku SET
        judul='$judul',
        penulis='$penulis',
        stok='$stok'
        WHERE id=$id
    ");

    echo "<script>
        alert('Buku berhasil diubah');
        document.location.href='data_buku.php';
    </script>";
}
?>

<h1>Ubah Buku</h1>

<form method="POST">
<input type="text" name="judul" value="<?= $buku['judul']; ?>">
<input type="text" name="penulis" value="<?= $buku['penulis']; ?>">
<input type="number" name="stok" value="<?= $buku['stok']; ?>">

<button name="submit">Ubah</button>
</form>