<?php 
include 'koneksi.php';

// CEK ID
if(!isset($_GET['id'])){
    die("ID tidak ditemukan");
}

$id = (int)$_GET['id'];

// ambil data lama
$p = query("SELECT * FROM peminjaman WHERE id = $id")[0];

// ambil data dropdown
$anggota = query("SELECT * FROM anggota");
$buku = query("SELECT * FROM buku");

// PROSES UPDATE
if(isset($_POST['submit'])){

    $anggota_id = $_POST['anggota'];
    $buku_id = $_POST['buku'];
    $tgl = $_POST['tanggal'];
    $lama = $_POST['lama'];

    $kembali = date('Y-m-d', strtotime("+$lama days", strtotime($tgl)));

    mysqli_query($conn,"UPDATE peminjaman SET
        anggota_id = '$anggota_id',
        buku_id = '$buku_id',
        tanggal_pinjam = '$tgl',
        lama_pinjam = '$lama',
        tanggal_kembali = '$kembali'
        WHERE id = $id
    ");

    echo "<script>
        alert('Data berhasil diubah');
        document.location.href='index.php';
    </script>";
}
?>

<h1>Ubah Peminjaman</h1>

<form method="POST">

<select name="anggota">
<?php foreach($anggota as $a): ?>
<option value="<?= $a['id']; ?>" 
<?= ($p['anggota_id']==$a['id'])?'selected':''; ?>>
<?= $a['nama']; ?>
</option>
<?php endforeach; ?>
</select>

<br><br>

<select name="buku">
<?php foreach($buku as $b): ?>
<option value="<?= $b['id']; ?>" 
<?= ($p['buku_id']==$b['id'])?'selected':''; ?>>
<?= $b['judul']; ?>
</option>
<?php endforeach; ?>
</select>

<br><br>

<input type="date" name="tanggal" value="<?= $p['tanggal_pinjam']; ?>">

<br><br>

<input type="number" name="lama" value="<?= $p['lama_pinjam']; ?>">

<br><br>

<button name="submit">Ubah</button>

</form> 