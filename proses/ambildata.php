<?php

include "database/koneksi.php";

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

// echo $num_rows;

$batas=0;
$hasil=[];
while($batas<$num_rows)
{
$hasil[$batas]=explode(',', $data[$batas]['alternatif']);
$batas++;
}


// foreach($hasil as $row){
// print_r($row);
// echo'<br>';
// }
// print_r($hasil);
// echo count($hasil);

// Mendapatkan data tiap-tiap kolom

$w=0;
$kolom1=count($hasil[0]);
$kolom1=$kolom1-1;
$simpan=[];

while($w<$kolom1)
{
  for($x=0;$x<$num_rows;$x++)
  {
     $simpan[$w][$x]=$hasil[$x][$w];
     // echo $simpan[$w][$x];
  }

  $w++;
}


// foreach($simpan as $row){
// print_r($row);
// echo'<br>';
// }

// echo print_r($simpan);
//Olah Array Multidimensi masing-masing Kolom
$maksimum=[];
// echo max($simpan[0]);
// echo count($simpan);
// echo "<br/>".max($simpan[3])."<br/>";
$jumbaris=count($simpan);
$y=0;
while($y<$jumbaris)
   {
     $maksimum[$y]=max($simpan[$y]);
     // echo "<br/>".$maksimum[$y];
     $y++;
   }

$minimun=[];

  $jumbaris=count($simpan);
  $z=0;
   while($z<$jumbaris)
      {
        $minimum[$z]=min($simpan[$z]);
        // echo "<br/>".$minimum[$z];
        $z++;
      }


//Ambil data database dan cek max atau min nya
$qmaxmin= "SELECT status FROM kriteria";
$qmaxmin2=mysqli_query($konek, $qmaxmin);
$num_rows1 = mysqli_num_rows($qmaxmin2);
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
   while($tambah1<$num_rows)
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


$querymatriks = "SELECT * FROM matriks_w";
$query2matriks=mysqli_query($konek, $querymatriks);
$datamatriks = [];
$servant = 0;
$num_rows2 = mysqli_num_rows($query2matriks);
while ($row = mysqli_fetch_array($query2matriks))
       {
            $datamatriks[$servant]['id' ] = $row['id'];
            $datamatriks[$servant]['nilai'] = $row['nilai'];
            // echo $datamatriks[$servant]['nilai'].",";
            $servant++;
    }

  // echo "<br/>"."<br/>".print_r($datamatriks)."<br/>";
  // echo $datamatriks[0]['nilai'];


$olah=0;
$pembagian;
$dataolah=[];
while ($olah<$jumbaris)
  {
    $jesi=0;
    while ($jesi<$num_rows) {

         $pembagian=$simpan[$olah][$jesi]/$hasilakar[$olah];
         $dataolah[$olah][$jesi]=$pembagian*$datamatriks[$olah]['nilai'];
         // echo $dataolah[$olah][$jesi].",";
         $jesi++;
    }

    // echo print_r($dataolah);

    $olah++;


  }

//   foreach($dataolah as $row){
// print_r($row);
// echo'<br>';
// }

  //Didapatkan Nilai baru hasil pembagian dan dilanjutkan dengan perkalian matriks dengan bobot

  //1.Dapatkan Nilai bobot dari database



// Cari Y plus nya dan dapatkan A plus nya

$maksy=[];
$arraymaks=[];
$jumbarisbaru=count($dataolah);
// echo "<br/>"."<br/>".$jumbarisbaru;
$y=0;
while($y<$jumbarisbaru)
   {
     $maksy[$y]=max($dataolah);
     $arraymaks[$y]=$maksy[$y];
     // echo "</br>".$arraymaks[$y];
     $y++;
   }


   //   foreach($maksy as $row){
   // print_r($row);
   // echo'<br>';
   // }

//Cari Y min dan dapatkan A min nya
$miny=[];
$arraymin=[];
$y=0;
while($y<$jumbarisbaru)
   {
     $miny[$y]=min($dataolah);
     $arraymin[$y]=$miny[$y];
     // echo "</br>".$arraymin[$y];
     $y++;
   }

// foreach($miny as $row){
//       print_r($row);
//       echo'<br>';
//       }


//cari jarak antar setiap nilai terbobot setiap alternatif
//Terhadap solusi ideal positif
// *pengurangan dengan max


$hasilkurang=[];

$axver=0;

while ($axver<$jumbaris)
  {
    $deva=0;
    $pengurangan=0;
    $totalpangkat=0;
    while ($deva<$num_rows) {
        // echo $dataolah[$axver][$deva]."<br/>";
        // echo $maksy[$axver][$deva]."<br/>";
         $pengurangan=$dataolah[$axver][$deva]-$maksy[$axver][$deva]; //Jangan Lupa ini di parse ke float
         // Kuadratkan mereka
         $pengurangan=$pengurangan*$pengurangan;
         $hasilkurang[$axver][$deva]=$pengurangan;
         // echo "<br/>".$hasilkurang[$axver][$deva];
         $deva++;
    }

    $axver++;


  }
  // echo print_r($hasilkurang);
//*Jumlahkan hasil kuadrat perbaris dan cari akarnya
$total=count($hasilkurang[0]);
// echo "hahaha".$total;
$i=0;
$arraybaru=[];
while ($i<$num_rows)
{
  $j=0;
  $hasilakhir=0;
  while ($j<$jumbaris)
  {
    $hasilakhir=$hasilakhir+$hasilkurang[$j][$i];

    $j++;
  }
  $arraybaru[$i]=sqrt($hasilakhir);
  // echo "<br/>".$arraybaru[$i];
  $i++;

}

// foreach($arraybaru as $row){
//       print_r($row);
//       echo',';
//       }


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
    while ($deva<$num_rows) {

         $pengurangan=$dataolah[$axver][$deva]-$miny[$axver][$deva]; //Jangan Lupa ini di parse ke float
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
while ($i<$num_rows)
{
  $j=0;
  $hasilakhir=0;
  while ($j<$jumbaris)
  {
    $hasilakhir=$hasilakhir+$hasilkurang1[$j][$i];

    $j++;
  }
  $arraybaru1[$i]=sqrt($hasilakhir);
  // echo "<br/>".$arraybaru1[$i];
  $i++;

}

// echo "<br/>";
// foreach($arraybaru1 as $row){
//       print_r($row);
//       echo'<br>';
//       }

// Kedetakatan setiap alternatif terhadap solusi ideal
/*
Di negatif/ Di Negatif + Di Positif
*/

$i=0;
$preferensi=0;
$matpref=[];
while ($i<$num_rows)
 {
   $preferensi=$arraybaru1[$i]/($arraybaru1[$i]+$arraybaru[$i]);
   $matpref[$i]=$preferensi;
   echo "<br/>".$matpref[$i];
   $i++;
 }

 $indexmax= max(array_keys($matpref));
 


// Dapatkan solusi dengan mengambil data array pertama
// Dapatkan max nya terlebih dahulu dan dapatkan index max tersebut

 ?>
