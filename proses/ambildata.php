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

// Mendapatkan data tiap-tiap kolom

$w=0;
$kolom1=$kolom-1;
$simpan=[];

while($w<$kolom1)
{
  for($x=0;$x<$kolom1;$x++)
  {
     $simpan[$w][$x]=$hasil[$x][$w];
  }
  // $simpan[$w]=$

  $w++;
}

//Olah Array Multidimensi masing-masing Kolom
$maksimum=[];
// echo max($simpan[0]);
// echo count($simpan);
$jumbaris=count($simpan);
$y=0;
while($y<$jumbaris)
   {
     $maksimum[$y]=max($simpan[$y]);
     echo $maksimum[$y];
     $y++;
   }

$minimun=[];

  $jumbaris=count($simpan);
  $z=0;
   while($z<$jumbaris)
      {
        $minimum[$z]=min($simpan[$z]);
        echo $minimum[$z];
        $z++;
      }


//Olah data masing-masing dengan rumus yg ada




 ?>
