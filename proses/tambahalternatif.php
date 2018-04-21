<?php

include "../database/koneksi.php";
$queryselect = "SELECT * FROM kriteria";
$query2select=mysqli_query($konek, $queryselect);
$num_rows = mysqli_num_rows($query2select);
$nama=$_POST['alternatif'];

$data=[];
$i=0;
$test="";

while ($i<$num_rows) {
  $data[$i]=$_POST[$i];
  // echo $data[$i].",";
  $test=$test.$data[$i].",";
  $i++;
}

$final=$test.$nama;
echo $final;

$queryinput= "INSERT INTO alternatif (alternatif) VALUES ('$final')";
$result=mysqli_query($konek,$queryinput);

header('Location: ../index.php');




 ?>
