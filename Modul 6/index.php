<?php include "koneksi.php"; ?> 

<!DOCTYPE html>
<html>
<head>
<title>Data Mahasiswa</title>
</head>

<body>

<h2>Form Data Mahasiswa</h2>

<form action="proses.php" method="POST" enctype="multipart/form-data">

Nama :
<input type="text" name="nama" required>
<br><br>

NIM :
<input type="text" name="nim" required>
<br><br>

Jurusan :
<input type="text" name="jurusan" required>
<br><br>

Foto :
<input type="file" name="foto" required>
<br><br>

<button type="submit">Simpan Data</button>

</form>

<hr>

<h2>Daftar Mahasiswa</h2>

<h3>Cari Mahasiswa</h3> 
<form method="GET">
<input type="text" name="cari" placeholder="Cari nama..." value="<?= $_GET['cari'] ?? '' ?>">

<select name="sort">
    <option value="">-- Urutkan --</option>
    <option value="asc" <?= ($_GET['sort'] ?? '') == 'asc' ? 'selected' : '' ?>>A-Z</option>
    <option value="desc" <?= ($_GET['sort'] ?? '') == 'desc' ? 'selected' : '' ?>>Z-A</option>
</select>

<button type="submit">Terapkan</button>
<a href="index.php">Reset</a>
</form>
<br>

<table border="1" cellpadding="10">
<tr>
<th>No</th>
<th>Foto</th>
<th>Nama</th>
<th>NIM</th>
<th>Jurusan</th>
<th>Aksi</th>
</tr>

<?php

# Ambil parameter cari dan sort
$cari = $_GET['cari'] ?? '';
$sort = $_GET['sort'] ?? '';

// Amankan input
$cari = mysqli_real_escape_string($conn, $cari);

$query = "SELECT * FROM mahasiswa";

// SEARCH
if($cari){
    $query .= " WHERE nama LIKE '%$cari%'";
}

// SORT
if($sort == "asc"){
    $query .= " ORDER BY nama ASC";
}elseif($sort == "desc"){
    $query .= " ORDER BY nama DESC";
}

// EKSEKUSI
$data = mysqli_query($conn, $query);

// DEBUG
if(!$data){
    die("Query Error: " . mysqli_error($conn));
}

$no = 1;

// LOOP DATA
while($mhs = mysqli_fetch_assoc($data)){
?>

<tr>
<td><?= $no++ ?></td>
<td><img src="uploads/<?= $mhs['foto'] ?>" width="80"></td>
<td><?= $mhs['nama'] ?></td>
<td><?= $mhs['nim'] ?></td>
<td><?= $mhs['jurusan'] ?></td>
<td>
<a href="hapus.php?id=<?= $mhs['id'] ?>">Hapus</a> |
<a href="edit.php?id=<?= $mhs['id'] ?>">Edit</a>
</td>
</tr>

<?php } ?>

</table>

</body>
</html>