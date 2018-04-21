<?php

include "../database/koneksi.php";

$query = "SELECT * FROM alternatif";
$query2=mysqli_query($konek, $query);
$data = [];
$i = 0;
$num_rows = mysqli_num_rows($query2);
while ($row = mysqli_fetch_array($query2))
       {
            $data[$i]['id' ] = $row['id'];
            $data[$i]['alternatif'] = $row['alternatif'];
            // echo $data[$i]['alternatif'];
            $i++;
    }

$batas=0;
$hasil=[];
while($batas<$num_rows)
{

$hasil[$batas]=explode(',', $data[$batas]['alternatif']);
// echo $hasil[0];
// echo $hasil[1];
$batas++;
}
$baris= count ($hasil);
$kolom= count($hasil[0]);

// echo $hasil[0][0];
// echo $hasil[0][1];
// echo $hasil[1][0];

// Mendapatkan data max untuk tiap-tiap kolom


 ?>
