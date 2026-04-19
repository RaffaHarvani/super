<?php
$conn = mysqli_connect("localhost","root","","db_perpus");

function query($query){
    global $conn;
    $result = mysqli_query($conn,$query);
    $rows=[];
    while($row=mysqli_fetch_assoc($result)){
        $rows[]=$row;
    }
    return $rows;
}

// Tambah buku
function tambahBuku($data){
    global $conn;

    $judul = htmlspecialchars($data["judul"]);
    $penulis = htmlspecialchars($data["penulis"]);
    $stok = (int)$data["stok"];

    $query = "INSERT INTO buku (judul, penulis, stok)
              VALUES ('$judul', '$penulis', '$stok')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// Tambah anggota
function tambahAnggota($data){
    global $conn;

    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $hp = htmlspecialchars($data["no_hp"]);

    $query = "INSERT INTO anggota (nama, email, no_hp)
              VALUES ('$nama', '$email', '$hp')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
?>

