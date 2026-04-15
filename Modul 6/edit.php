<?php
include "koneksi.php";
$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE id=$id");
$mhs = mysqli_fetch_assoc($data);
?>

<form action="update.php" method="POST">
<input type="hidden" name="id" value="<?= $mhs['id'] ?>">

Nama:
<input type="text" name="nama" value="<?= $mhs['nama'] ?>"><br>

NIM:
<input type="text" name="nim" value="<?= $mhs['nim'] ?>"><br>

Jurusan:
<input type="text" name="jurusan" value="<?= $mhs['jurusan'] ?>"><br>

<button type="submit">Update</button>
</form>
