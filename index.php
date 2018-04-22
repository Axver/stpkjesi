<?php

include "database/koneksi.php";

 ?>

<!doctype html>
<html>
<head>


  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


<meta charset="utf-8">
<title>Tugas STPK kelompok 16</title>
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<style>
table, th, td {
   border: 1px solid black;
}
*,
*:before,
*:after {
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

html,
body {
  height: 100%;
  overflow: hidden;
  background-image: url("image/gambar.jpg");
}

body {
  background: -webkit-linear-gradient(45deg, #e10522 0%, rgba(225, 5, 34, 0) 70%), -webkit-linear-gradient(315deg, #3105d1 10%, rgba(49, 5, 209, 0) 80%), -webkit-linear-gradient(225deg, #0adbd8 10%, rgba(10, 219, 216, 0) 80%), -webkit-linear-gradient(135deg, #09f505 100%, rgba(9, 245, 5, 0) 70%);
  background: linear-gradient(45deg, #e10522 0%, rgba(225, 5, 34, 0) 70%), linear-gradient(135deg, #3105d1 10%, rgba(49, 5, 209, 0) 80%), linear-gradient(225deg, #0adbd8 10%, rgba(10, 219, 216, 0) 80%), linear-gradient(315deg, #09f505 100%, rgba(9, 245, 5, 0) 70%);
}

.absolute-center,
.menu,
.menu .btn .fa,
.menu .btn.trigger .line {
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translateX(-50%) translateY(-50%);
  -ms-transform: translateX(-50%) translateY(-50%);
  transform: translateX(-50%) translateY(-50%);
}

.menu {
  width: 5em;
  height: 5em;
}

.menu .btn {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.15);
  opacity: 0;
  z-index: -10;
  cursor: pointer;
  -webkit-transition: opacity 1s, z-index 0.3s, -webkit-transform 1s;
  transition: opacity 1s, z-index 0.3s, transform 1s;
  -webkit-transform: translateX(0);
  -ms-transform: translateX(0);
  transform: translateX(0);
}

.menu .btn .fa {
  font-size: 3em;
  -webkit-transition: color 0.3s;
  transition: color 0.3s;
}

.menu .btn:hover .fa { color: rgba(255, 255, 255, 0.7); }

.menu .btn.trigger {
  opacity: 1;
  z-index: 100;
  cursor: pointer;
  -webkit-transition: -webkit-transform 0.3s;
  transition: transform 0.3s;
}

.menu .btn.trigger:hover {
  -webkit-transform: scale(1.2);
  -ms-transform: scale(1.2);
  transform: scale(1.2);
}

.menu .btn.trigger:hover .line { background-color: rgba(255, 255, 255, 0.7); }

.menu .btn.trigger:hover .line:before,
.menu .btn.trigger:hover .line:after { background-color: rgba(255, 255, 255, 0.7); }

.menu .btn.trigger .line {
  width: 60%;
  height: 6px;
  background: #000;
  border-radius: 6px;
  -webkit-transition: background-color 0.3s, height 0.3s, top 0.3s;
  transition: background-color 0.3s, height 0.3s, top 0.3s;
}

.menu .btn.trigger .line:before,
.menu .btn.trigger .line:after {
  content: "";
  display: block;
  position: absolute;
  left: 0;
  width: 100%;
  height: 6px;
  background: #000;
  border-radius: 6px;
  -webkit-transition: background-color 0.3s, -webkit-transform 0.3s;
  transition: background-color 0.3s, transform 0.3s;
}

.menu .btn.trigger .line:before {
  top: -12px;
  -webkit-transform-origin: 15% 100%;
  -ms-transform-origin: 15% 100%;
  transform-origin: 15% 100%;
}

.menu .btn.trigger .line:after {
  top: 12px;
  -webkit-transform-origin: 25% 30%;
  -ms-transform-origin: 25% 30%;
  transform-origin: 25% 30%;
}

.menu .rotater {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  -webkit-transform-origin: 50% 50%;
  -ms-transform-origin: 50% 50%;
  transform-origin: 50% 50%;
}

.menu.active .btn-icon {
  opacity: 1;
  z-index: 50;
}

.menu.active .trigger .line {
  height: 0px;
  top: 45%;
}

.menu.active .trigger .line:before {
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
  width: 110%;
}

.menu.active .trigger .line:after {
  -webkit-transform: rotate(-45deg);
  -ms-transform: rotate(-45deg);
  transform: rotate(-45deg);
  width: 110%;
}

/* horrible things are happening here
for some reason nth-child(1) is always busy and elements starting from 2 */

.rotater:nth-child(1) {
  -webkit-transform: rotate(-22.5deg);
  -ms-transform: rotate(-22.5deg);
  transform: rotate(-22.5deg);
}

.menu.active .rotater:nth-child(1) .btn-icon {
  -webkit-transform: translateX(-10em) rotate(22.5deg);
  -ms-transform: translateX(-10em) rotate(22.5deg);
  transform: translateX(-10em) rotate(22.5deg);
}

.rotater:nth-child(2) {
  -webkit-transform: rotate(22.5deg);
  -ms-transform: rotate(22.5deg);
  transform: rotate(22.5deg);
}

.menu.active .rotater:nth-child(2) .btn-icon {
  -webkit-transform: translateX(-10em) rotate(-22.5deg);
  -ms-transform: translateX(-10em) rotate(-22.5deg);
  transform: translateX(-10em) rotate(-22.5deg);
}

.rotater:nth-child(3) {
  -webkit-transform: rotate(67.5deg);
  -ms-transform: rotate(67.5deg);
  transform: rotate(67.5deg);
}

.menu.active .rotater:nth-child(3) .btn-icon {
  -webkit-transform: translateX(-10em) rotate(-67.5deg);
  -ms-transform: translateX(-10em) rotate(-67.5deg);
  transform: translateX(-10em) rotate(-67.5deg);
}

.rotater:nth-child(4) {
  -webkit-transform: rotate(112.5deg);
  -ms-transform: rotate(112.5deg);
  transform: rotate(112.5deg);
}

.menu.active .rotater:nth-child(4) .btn-icon {
  -webkit-transform: translateX(-10em) rotate(-112.5deg);
  -ms-transform: translateX(-10em) rotate(-112.5deg);
  transform: translateX(-10em) rotate(-112.5deg);
}

.rotater:nth-child(5) {
  -webkit-transform: rotate(157.5deg);
  -ms-transform: rotate(157.5deg);
  transform: rotate(157.5deg);
}

.menu.active .rotater:nth-child(5) .btn-icon {
  -webkit-transform: translateX(-10em) rotate(-157.5deg);
  -ms-transform: translateX(-10em) rotate(-157.5deg);
  transform: translateX(-10em) rotate(-157.5deg);
}

.rotater:nth-child(6) {
  -webkit-transform: rotate(202.5deg);
  -ms-transform: rotate(202.5deg);
  transform: rotate(202.5deg);
}

.menu.active .rotater:nth-child(6) .btn-icon {
  -webkit-transform: translateX(-10em) rotate(-202.5deg);
  -ms-transform: translateX(-10em) rotate(-202.5deg);
  transform: translateX(-10em) rotate(-202.5deg);
}

.rotater:nth-child(7) {
  -webkit-transform: rotate(247.5deg);
  -ms-transform: rotate(247.5deg);
  transform: rotate(247.5deg);
}

.menu.active .rotater:nth-child(7) .btn-icon {
  -webkit-transform: translateX(-10em) rotate(-247.5deg);
  -ms-transform: translateX(-10em) rotate(-247.5deg);
  transform: translateX(-10em) rotate(-247.5deg);
}

.rotater:nth-child(8) {
  -webkit-transform: rotate(292.5deg);
  -ms-transform: rotate(292.5deg);
  transform: rotate(292.5deg);
}

.menu.active .rotater:nth-child(8) .btn-icon {
  -webkit-transform: translateX(-10em) rotate(-292.5deg);
  -ms-transform: translateX(-10em) rotate(-292.5deg);
  transform: translateX(-10em) rotate(-292.5deg);
}

.rotater:nth-child(9) {
  -webkit-transform: rotate(337.5deg);
  -ms-transform: rotate(337.5deg);
  transform: rotate(337.5deg);
}

.menu.active .rotater:nth-child(9) .btn-icon {
  -webkit-transform: translateX(-10em) rotate(-337.5deg);
  -ms-transform: translateX(-10em) rotate(-337.5deg);
  transform: translateX(-10em) rotate(-337.5deg);
}
</style>
</head>

<body style="background-image: url('image/gambar.jpg')">
<h1 style="color:#fff" align="center">Tugas STPK kelompok 16</h1>

<div class="menu">
  <div class="btn trigger"> <span class="line"></span> </div>
  <div class="rotater">
    <div class="btn btn-icon" style="background-color:blue;"> <b style="color:white;"> <li onclick="inputdata()" class="fa fa-keyboard-o"></li>Data</b></div>
  </div>
  <div class="rotater">
    <div class="btn btn-icon" style="background-color:red;"> <li onclick="addKriteria()" class="fa fa-database"></li><b style="color:white;"> Kriteria</b> </div>
  </div>
  <div class="rotater">
    <div class="btn btn-icon" style="background-color:green;"> <li onclick="test()" class="fa fa-edit"></li> <b style="color:white;">Ranking</b> </div>
  </div>
  <div class="rotater">
    <div class="btn btn-icon" style="background-color:yellow;"> <li class="fa fa-pie-chart"></li> <b style="color:white;">Hasil</b> </div>
  </div>
  <div class="rotater">
    <div class="btn btn-icon" style="background-color:pink;"><li class="fa fa-user"></li> User </div>
  </div>
  <div class="rotater">
    <div class="btn btn-icon" style="background-color:white;"> Menu </div>
  </div>
  <div class="rotater">
    <div class="btn btn-icon" style="background-color:orange;"> Menu </div>
  </div>
  <div class="rotater">
    <div class="btn btn-icon" style="background-color:brown;"> Test </div>
  </div>
</div>

<div class="test" style="background-image: url('image/bg.gif')">

  <div style="color:red" id="1">
    <div class="row">

      <div class="col-sm-3">
        <div class="panel panel-info" style=" height: 400px; background-image: url('image/bg.gif')">

          <div class="panel-head">

          </div>

          <div class="panel-body">
            <button type="button" class="btn btn-warning" name="button">Clear</button> <br/>
             Ranking:
             <input id="ranking" type="text" name="ranking" value="" disabled>
             Kriteria:

             <table>
               <th>Kriteria</th>
               <th>Hapus</th>


             <?php


                 $query = "SELECT * FROM kriteria";
                 $query2=mysqli_query($konek, $query);
                 $data = [];
                 $i = 0;

                 while ($row = mysqli_fetch_array($query2))
                        {
                             $data[$i]['id' ] = $row['id'];
                             $data[$i]['kriteria'] = $row['kriteria'];
                             echo "<tr>";
                             echo "<td>"."<b style='color:white;'>".$data[$i]['kriteria']."</b>"."</td>";
                             echo "<td><button onclick='hapus(" .$data[$i]['id'] . ")' class='btn btn-danger'> Hapus </button></td>";
                             echo "</tr>";
                             $i++;
                     }

              ?>
              </table>
              <br/>
              <button type="button" class="btn btn-info" name="button">Tampilkan Data</button>
          </div>
        </div>
      </div>

      <div class="col-sm-3">

        <div class="">
              Test
        </div>

      </div>


      <div class="col-sm-3">



      </div>

      <div class="col-sm-3">


        <div class="panel panel-warning"  style=" height:400px;background-image: url('image/bg.gif');">

          <div class="panel-head">
            Tambah Data
          </div>


          <div class="panel-body">

            <form class="" action="proses/tambahalternatif.php" method="post">
              <label for="alternatif">Alternatif : </label>
              <input type="text" name="alternatif" value="">
               <?php

               $queryselect = "SELECT * FROM kriteria";
               $query2select=mysqli_query($konek, $queryselect);
               $num_rows = mysqli_num_rows($query2select);
               // echo $num_rows;

               $data1 = [];
               $j = 0;

               while ($row = mysqli_fetch_array($query2select))
                  {
                     $data1[$j]['id' ] = $row['id'];
                     $data1[$j]['kriteria'] = $row['kriteria'];
                     $j++;

                  }

               if($num_rows>0)
               {
                 echo "<br/>";
                 $i=0;
                 while($i<$num_rows)
                 {
                   echo "<label for='".$i."'>".$data1[$i]['kriteria']."</label>";
                   echo "<input name='".$i. "' type='text'>"."<br/>";
                   $i++;
                 }

               }



                ?>

              <input type="submit" class="btn btn-sucess" name="" value="Tambahkan">
            </form>

          </div>

        </div>
      </div>

    </div>

    <div class="row">

      <div class="panel panel-info" style="background-color:#424242; color:green;">

        <div class="panel-body">

          Hasil TOPSIS:

          <b>
            

          <?php

            include "proses/backup.php";

           ?>

         </b>

        </div>

      </div>

    </div>


  </div>

</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
  $(".trigger").click(function() {
    $(".menu").toggleClass("active");
  });
});
</script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

<script>


function bos()
{
  console.log(value);
}

function test()
{
  swal("Masukkan Jumlah Ranking:", {
    content: "input",
  })
  .then((value) => {
    swal(`Jumlah Max Ranking = ${value}`);
    console.log(value);
    document.getElementById("ranking").value=value;
  });
}

function addKriteria()
{
  swal("Masukkan Kriteria:", {
    content: "input",
  })
  .then((value) => {

    window.location = "proses/tambahkriteria.php?id="+value;

  });
}


function hapus(test)
{
  window.location = "proses/hapuskriteria.php?id="+test;
}

function inputdata()
{
  swal("Test");
}

</script>



</body>
</html>
