<?php
include 'koneksi.php';

if(isset($_POST["submit"])){

    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $no_hp = htmlspecialchars($_POST['no_hp']);
    $username = htmlspecialchars($_POST['username']);

    // 🔐 HASH PASSWORD
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // CEK USERNAME
    $cek = mysqli_query($conn, "SELECT * FROM anggota WHERE username='$username'");

    if(mysqli_num_rows($cek) > 0){
        echo "<script>alert('Username sudah digunakan!');</script>";
    } else {

        // INSERT DATA
        mysqli_query($conn,"INSERT INTO anggota 
        (nama,email,no_hp,username,password)
        VALUES 
        ('$nama','$email','$no_hp','$username','$password')");

        if(mysqli_affected_rows($conn) > 0){
            echo "<script>
                alert('Anggota berhasil ditambahkan');
                document.location.href='data_anggota.php';
            </script>";
        } else {
            echo "<script>alert('Anggota gagal ditambahkan');</script>";
        }
    }
}
?>

<h1>Tambah Anggota</h1>

<form method="POST">
<ul>
    <li>
        <label>Nama:</label><br>
        <input type="text" name="nama" required>
    </li>

    <li>
        <label>Email:</label><br>
        <input type="email" name="email" required>
    </li>

    <li>
        <label>No HP:</label><br>
        <input type="text" name="no_hp" required>
    </li>

    <li>
        <label>Username:</label><br>
        <input type="text" name="username" required>
    </li>

    <li>
        <label>Password:</label><br>
        <input type="password" name="password" required>
    </li>

    <li>
        <button type="submit" name="submit">Tambah</button>
    </li>
</ul>
</form>