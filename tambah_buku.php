<?php
include 'koneksi.php';

if(isset($_POST["submit"])){

    if(tambahBuku($_POST) > 0){
        echo "<script>
            alert('Buku berhasil ditambahkan');
            document.location.href='data_buku.php';
        </script>";
    } else {
        echo "<script>alert('Buku gagal ditambahkan');</script>";
    }
}
?>

<h1>Tambah Buku</h1>

<form method="POST">
<ul>
    <li>
        <label>Judul:</label>
        <input type="text" name="judul" required>
    </li>

    <li>
        <label>Penulis:</label>
        <input type="text" name="penulis" required>
    </li>

    <li>
        <label>Stok:</label>
        <input type="number" name="stok" required>
    </li>

    <li>
        <button type="submit" name="submit">Tambah</button>
    </li>
</ul>
</form>