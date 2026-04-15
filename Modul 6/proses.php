<?php

$nama = $_POST['nama'];
$nim = $_POST['nim'];
$jurusan = $_POST['jurusan'];

$foto = $_FILES['foto']['name'];
$tmp = $_FILES['foto']['tmp_name'];

move_uploaded_file($tmp,"uploads/".$foto);

$file = "data/mahasiswa.json";

$data = [];

if(file_exists($file)){
$data = json_decode(file_get_contents($file), true);
}

$data[] = [

"nama"=>$nama,
"nim"=>$nim,
"jurusan"=>$jurusan,
"foto"=>$foto

];

file_put_contents($file,json_encode($data));

header("Location:index.php");

?>