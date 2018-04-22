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
     // echo $maksimum[$y];
     $y++;
   }

$minimun=[];

  $jumbaris=count($simpan);
  $z=0;
   while($z<$jumbaris)
      {
        $minimum[$z]=min($simpan[$z]);
        // echo $minimum[$z];
        $z++;
      }


//Ambil data database dan cek max atau min nya
$qmaxmin= "SELECT status FROM kriteria";
$qmaxmin2=mysqli_query($konek, $qmaxmin);
$num_rows = mysqli_num_rows($qmaxmin2);
$status=[];
// echo "<br/>".$num_rows;
$n=0;
while ($row = mysqli_fetch_array($qmaxmin2))
       {
            $status[$n] = $row['status'];
            // echo $data[$i]['alternatif'];
            $n++;
    }

    // echo "<br/>".$status[0];

//Olah data masing-masing dengan rumus yg ada

//Cari jumlah kuadrat perkolom data

$tambah=0;
$hasiljum=[];
while ($tambah<$jumbaris)
 {
   $tambah1=0;
   $penjumlahan=0;
   while($tambah1<$jumbaris)
    {
      $penjumlahan=$penjumlahan+($simpan[$tambah][$tambah1]*$simpan[$tambah][$tambah1]);
      $tambah1++;
    }
    $hasiljum[$tambah]=$penjumlahan;
    echo $hasiljum[$tambah]."<br/>";
    $tambah++;
 }

 //Cari Akar kuadrat dari jumlah kuadrat data
 $kuadrat=0;
 $hasilakar=[];
 while ($kuadrat<$jumbaris)
 {
     $haskuadrat=0;
     $haskuadrat= sqrt($hasiljum[$kuadrat]);
     $hasilakar[$kuadrat]=$haskuadrat;
     echo $hasilakar[$kuadrat]."<br/>";
     $kuadrat++;
 }

//Cari hasil pembagian dengan akar kuadrat
// $olah=0;
// $pembagian;
// $dataolah=[];
// while ($olah<$jumbaris)
//   {
//     $jesi=0;
//     while ($jesi<$jumbaris) {
//       if($status[$olah]==1)
//        {
//          $pembagian=$simpan[$olah][$jesi]/$maksimum[$olah];
//          $dataolah[$olah][$jesi]=$pembagian;
//          // echo $dataolah[$olah][$jesi]."<br/>";
//        }
//        else {
//          $pembagian=$minimum[$olah]/$simpan[$olah][$jesi];
//          $dataolah[$olah][$jesi]=$pembagian;
//          // echo $dataolah[$olah][$jesi]."<br/>";
//        }
//        $jesi++;
//     }
//
//     $olah++;
//
//
//   }


$olah=0;
$pembagian;
$dataolah=[];
while ($olah<$jumbaris)
  {
    $jesi=0;
    while ($jesi<$jumbaris) {

         $pembagian=$simpan[$olah][$jesi]/$hasilakar[$olah];
         $dataolah[$olah][$jesi]=$pembagian;
         echo $dataolah[$olah][$jesi].",";
         $jesi++;
    }

    $olah++;


  }

  //Didapatkan Nilai baru hasil pembagian dan dilanjutkan dengan perkalian matriks dengan bobot




 ?>
