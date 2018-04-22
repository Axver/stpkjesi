<?php

ini_set('display_errors', 0);
error_reporting(E_ERROR | E_WARNING | E_PARSE); 

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
    // echo $hasiljum[$tambah]."<br/>";
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
     // echo $hasilakar[$kuadrat]."<br/>";
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
         // echo $dataolah[$olah][$jesi].",";
         $jesi++;
    }

    $olah++;


  }

  //Didapatkan Nilai baru hasil pembagian dan dilanjutkan dengan perkalian matriks dengan bobot

  //1.Dapatkan Nilai bobot dari database

  $querymatriks = "SELECT * FROM matriks_w";
  $query2matriks=mysqli_query($konek, $querymatriks);
  $datamatriks = [];
  $servant = 0;
  $num_rows = mysqli_num_rows($query2matriks);
  while ($row = mysqli_fetch_array($query2matriks))
         {
              $datamatriks[$servant]['id' ] = $row['id'];
              $datamatriks[$servant]['nilai'] = $row['nilai'];
              // echo $datamatriks[$servant]['nilai']."<br/>";
              $servant++;
      }

  //Kalikan matriks sebelumnya dengan matriks w

  $matriksbaru=[];

  $axver=0;

  $dataolah=[];
  while ($axver<$jumbaris)
    {
      $deva=0;
      $pembagian=0;
      while ($deva<$jumbaris) {

           $pembagian=$simpan[$axver][$deva]*$datamatriks[$axver]['nilai']; //Jangan Lupa ini di parse ke float
           $matriksbaru[$axver][$deva]=$pembagian;
           // echo $matriksbaru[$axver][$deva].",";
           $deva++;
      }

      $axver++;


    }

// Cari Y plus nya dan dapatkan A plus nya

$maksy=[];
$arraymaks=[];
$jumbarisbaru=count($matriksbaru);
$y=0;
while($y<$jumbarisbaru)
   {
     $maksy[$y]=max($matriksbaru[$y]);
     $arraymaks[$y]=$maksy[$y];
     // echo "</br>".$arraymaks[$y];
     $y++;
   }

//Cari Y min dan dapatkan A min nya
$miny=[];
$arraymin=[];
$y=0;
while($y<$jumbarisbaru)
   {
     $miny[$y]=min($matriksbaru[$y]);
     $arraymin[$y]=$miny[$y];
     // echo "</br>".$arraymin[$y];
     $y++;
   }


//cari jarak antar setiap nilai terbobot setiap alternatif
//Terhadap solusi ideal positif
// *pengurangan dengan max
$hasilkurang=[];

$axver=0;

$dataolah=[];
while ($axver<$jumbaris)
  {
    $deva=0;
    $pengurangan=0;
    $totalpangkat=0;
    while ($deva<$jumbaris) {

         $pengurangan=$matriksbaru[$deva][$axver]-$maksy[$axver]; //Jangan Lupa ini di parse ke float
         // Kuadratkan mereka
         $pengurangan=$pengurangan*$pengurangan;
         $hasilkurang[$axver][$deva]=$pengurangan;
         // echo "<br/>".$hasilkurang[$axver][$deva];
         $deva++;
    }

    $axver++;


  }
//*Jumlahkan hasil kuadrat perbaris dan cari akarnya
$total=count($hasilkurang[0]);
// echo $total;
$i=0;
$arraybaru=[];
while ($i<$total)
{
  $j=0;
  $hasilakhir=0;
  while ($j<$total)
  {
    $hasilakhir=$hasilakhir+$hasilkurang[$i][$j];

    $j++;
  }
  $arraybaru[$i]=sqrt($hasilakhir);
  // echo "<br/>".$arraybaru[$i];
  $i++;

}


//cari jarak antar setiap nilai terbobot setiap alternatif
//Terhadap solusi ideal negatif

$hasilkurang1=[];

$axver=0;

$dataolah1=[];
while ($axver<$jumbaris)
  {
    $deva=0;
    $pengurangan=0;
    $totalpangkat=0;
    while ($deva<$jumbaris) {

         $pengurangan=$dataolah[$deva][$axver]-$miny[$axver]; //Jangan Lupa ini di parse ke float
         // Kuadratkan mereka
         $pengurangan=$pengurangan*$pengurangan;
         $hasilkurang1[$axver][$deva]=$pengurangan;
         // echo "<br/>".$hasilkurang1[$axver][$deva];
         $deva++;
    }

    $axver++;


  }
//*Jumlahkan hasil kuadrat perbaris dan cari akarnya
$total=count($hasilkurang1[0]);
// echo $total;
$i=0;
$arraybaru1=[];
while ($i<$total)
{
  $j=0;
  $hasilakhir=0;
  while ($j<$total)
  {
    $hasilakhir=$hasilakhir+$hasilkurang1[$i][$j];

    $j++;
  }
  $arraybaru1[$i]=sqrt($hasilakhir);
  // echo "<br/>".$arraybaru1[$i];
  $i++;

}

// Kedetakatan setiap alternatif terhadap solusi ideal
/*
Di negatif/ Di Negatif + Di Positif
*/

$i=0;
$preferensi=0;
$matpref=[];
while ($i<$total)
 {
   $preferensi=$arraybaru1[$i]/($arraybaru1[$i]+$arraybaru[$i]);
   $matpref[$i]=$preferensi;
   echo "<br/>".$matpref[$i];
   $i++;
 }


// Dapatkan solusi dengan mengambil data array pertama
// Dapatkan max nya terlebih dahulu dan dapatkan index max tersebut

 ?>
