<?php

$id = $_GET['id'];

$file = "data/mahasiswa.json";

$data = json_decode(file_get_contents($file), true);

$foto = $data[$id]['foto'];

unlink("uploads/".$foto);

unset($data[$id]);

$data = array_values($data);

file_put_contents($file,json_encode($data));

header("Location:index.php");

?>
