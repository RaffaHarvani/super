<?php
include 'koneksi.php';

$anggota = query("SELECT * FROM anggota");
$buku = query("SELECT * FROM buku");

if(isset($_POST['submit'])){
    $anggota_id = $_POST['anggota'];
    $buku_id = $_POST['buku'];
    $tgl = $_POST['tanggal'];
    $lama = $_POST['lama'];

    // hitung tanggal kembali
    $kembali = date('Y-m-d', strtotime("+$lama days", strtotime($tgl)));

    // cek stok dulu
    $b = query("SELECT * FROM buku WHERE id = $buku_id")[0];

    if($b['stok'] > 0){

       mysqli_query($conn,"INSERT INTO peminjaman 
VALUES('', '$anggota_id','$buku_id','$tgl','$lama','$kembali','dipinjam')");

        // kurangi stok
        mysqli_query($conn,"UPDATE buku SET stok = stok - 1 WHERE id = $buku_id");

        echo "<script>
            alert('Peminjaman berhasil');
            document.location.href='index.php';
        </script>";
        exit;

    } else {
        echo "<script>alert('Stok buku habis!');</script>";
    }
}
?>

<h1>Form Peminjaman Buku</h1>

<form method="POST">
<ul>

    <li>
        <label>👤 Pilih Anggota:</label><br>
        <select name="anggota" required>
            <?php foreach($anggota as $a): ?>
            <option value="<?= $a['id']; ?>">
                <?= $a['nama']; ?>
            </option>
            <?php endforeach; ?>
        </select>
    </li>

    <li>
        <label>📚 Pilih Buku:</label><br>
        <select name="buku" required>
            <?php foreach($buku as $b): ?>
            <option value="<?= $b['id']; ?>">
                <?= $b['judul']; ?> (Stok: <?= $b['stok']; ?>)
            </option>
            <?php endforeach; ?>
        </select>
    </li>

    <li>
        <label>📅 Tanggal Pinjam:</label><br>
        <input type="date" name="tanggal" required>
    </li>

    <li>
        <label>⏳ Lama Pinjam (hari):</label><br>
        <input type="number" name="lama" min="1" required>
    </li>

    <li>
        <button type="submit" name="submit">Simpan</button>
    </li>

</ul>
</form>