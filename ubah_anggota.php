<?php
include 'koneksi.php';

// cek id
if(!isset($_GET['id'])){
    die("ID tidak ditemukan");
}

$id = (int)$_GET['id'];

// ambil data lama
$anggota = query("SELECT * FROM anggota WHERE id=$id")[0];

if(isset($_POST['submit'])){

    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $no_hp = htmlspecialchars($_POST['no_hp']);
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];

    // cek username (kalau diubah)
    $cek = mysqli_query($conn,"SELECT * FROM anggota WHERE username='$username' AND id!=$id");

    if(mysqli_num_rows($cek) > 0){
        echo "<script>alert('Username sudah digunakan!');</script>";
    } else {

        // kalau password diisi → update password
        if(!empty($password)){
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            mysqli_query($conn,"UPDATE anggota SET
                nama='$nama',
                email='$email',
                no_hp='$no_hp',
                username='$username',
                password='$password_hash'
                WHERE id=$id
            ");

        } else {
            // kalau password kosong → jangan ubah password
            mysqli_query($conn,"UPDATE anggota SET
                nama='$nama',
                email='$email',
                no_hp='$no_hp',
                username='$username'
                WHERE id=$id
            ");
        }

        echo "<script>
            alert('Data berhasil diubah');
            document.location.href='data_anggota.php';
        </script>";
    }
}
?>

<h1>Ubah Anggota</h1>

<form method="POST">
<ul>

    <li>
        <label>Nama:</label><br>
        <input type="text" name="nama" value="<?= $anggota['nama']; ?>" required>
    </li>

    <li>
        <label>Email:</label><br>
        <input type="email" name="email" value="<?= $anggota['email']; ?>" required>
    </li>

    <li>
        <label>No HP:</label><br>
        <input type="text" name="no_hp" value="<?= $anggota['no_hp']; ?>" required>
    </li>

    <li>
        <label>Username:</label><br>
        <input type="text" name="username" value="<?= $anggota['username']; ?>" required>
    </li>

    <li>
        <label>Password Baru:</label><br>
        <input type="password" name="password">
        <small>Kosongkan jika tidak ingin mengubah password</small>
    </li>

    <li>
        <button type="submit" name="submit">Ubah</button>
    </li>

</ul>
</form>