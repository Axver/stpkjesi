<?php

include "../database/koneksi.php";

$kriteria=$_GET['id'];
echo $kriteria;
$query = "INSERT INTO kriteria (kriteria) VALUES('$kriteria')";
$query2=mysqli_query($konek, $query);

header('Location: ../index.php');

 ?>
