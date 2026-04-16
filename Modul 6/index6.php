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

<?php

$file = "data/mahasiswa.json";

if(file_exists($file)){

$data = json_decode(file_get_contents($file), true);

echo "<table border='1' cellpadding='10'>";

echo "<tr>
<th>No</th>
<th>Foto</th>
<th>Nama</th>
<th>NIM</th>
<th>Jurusan</th>
<th>Aksi</th>
</tr>";

$no = 1;

foreach($data as $index => $mhs){

echo "<tr>";

echo "<td>".$no++."</td>";

echo "<td><img src='uploads/".$mhs['foto']."' width='80'></td>";

echo "<td>".$mhs['nama']."</td>";

echo "<td>".$mhs['nim']."</td>";

echo "<td>".$mhs['jurusan']."</td>";

echo "<td>
<a href='hapus.php?id=".$index."'>Hapus</a>
</td>";

echo "</tr>";

}

echo "</table>";

}

?>

</body>
</html>