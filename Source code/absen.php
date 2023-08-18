<?php
session_start();
if(!isset($_SESSION['nama'])){
   header("Location:login.php");
   exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- Link Bootstrap -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
   <!-- Link CSS -->
   <link rel="stylesheet" href="absen3.css">
   <style>
      body {
         margin-top: 1px;
         margin-bottom: 1px;
      }
   </style>
   <!-- Title -->
   <title>Presensi</title>
</head>

<body>
<?php
include 'connect.php';

if(isset($_POST['submit'])){
   $absen_id = $_POST['absen_id'];
   $nama = $_POST['nama'];
   $nrp = $_POST['nrp'];
   $matkul = $_POST['matkul'];
   $week = $_POST['week'];
   $status = $_POST['status'];
   // cek apakah nama yang diinputkan sama dengan sesi yang diberikan
   if($nama != $_SESSION['nama']){
      $error = "<script> alert(\"Error, Nama atau NRP yang dimasukkan tidak sesuai dengan dengan Sistem!\")</script>";
      echo $error;
   }
   // cek apakah absen id sudah ada / belum pada db absensi
   $query2 = "SELECT * FROM absensi WHERE absensi_id = :absen_id";
	$declar2 = $connect->prepare($query2);
   $declar2->bindParam(':absen_id', $absen_id);
   $declar2->execute();
	$result = $declar2->rowCount();
	if($result > 0){
		$error = "<script> alert(\"Error, Data yang dimasukkan sudah ada pada Sistem!\")</script>";
      echo $error;
	}
   // create data ke databse absensi
   if(empty($error)){
      $query = "INSERT INTO absensi VALUES('$absen_id', '$nama', '$nrp', '$matkul', '$week', '$status')";
      $declar = $connect->prepare($query);
      $result = $declar->execute();
      echo "<script> alert(\"Data berhasil disimpan\")</script>";
   }
}
?>

<div class="card">
   <form class="container" action="" method="post">
   <h1 class="text-center">PRESENSI MAHASISWA</h1>
      <br>
      <div class="form-group">
         <label for="absen_id">Presensi ID :</label>
         <input type="text" class="form-control" name="absen_id" required>
      </div>
      <div class="form-group">
         <label for="nama">Nama :</label>
         <input type="text" class="form-control" name="nama" id="nama" required>
      </div>
      <div class="form-group">
         <label for="nrp">NRP :</label>
         <input type="text" class="form-control" name="nrp" id="nrp" required>
      </div>
      <div class="form-group">
         <label for="matkul">Mata Kuliah :</label>
         <select class="form-control" id="matkul" name="matkul">
            <option value="">-- Pilih Mata Kuliah --</option>
            <option value="kewarganegaraan">kewarganegaraan</option>
            <option value="Agama">Agama</option>
            <option value="Praktek Algoritma dan Struktur Data">Praktek Algoritma dan Struktur Data</option>
            <option value="Algoritma dan Struktur Data">Algoritma dan Struktur Data</option>
            <option value="Praktek Sistem Operasi">Praktek Sistem Operasi</option>
            <option value="Workshop Pemrograman Website">Workshop Pemrograman Website</option>
            <option value="Sistem Operasi">Sistem Operasi</option>
            <option value="Praktek Basis Data">Praktek Basis Data</option>
            <option value="Basis Data">Basis Data</option>
            <option value="Matematika-2">Matematika-2</option>
         </select>
      </div>
      <div class="form-group">
         <label for="week">Minggu ke :</label>
         <select class="form-control" id="week" name="week">
            <option value="">-- Minggu ke - --</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
         </select>
      </div>
      <div class="form-group">
         <label>Keterangan :</label>
         <div class="form-inline">
            <div class="form-check ml-2">
               <input type="radio" class="form-check-input" id="status" name="status" value="H">
               <label class="form-check-label" for="status">Hadir</label> </div>
            <div class="form-check ml-2">
               <input type="radio" class="form-check-input" id="status" name="status" value="I">
               <label class="form-check-label" for="status">Ijin</label>
            </div>
            <div class="form-check ml-2">
               <input type="radio" class="form-check-input" id="status" name="status" value="S">
               <label class="form-check-label" for="status">Sakit</label>
            </div>
            </div>
         </div>
      <br>
      <button type="submit" name="submit" class="btn btn-primary" href="tabel.php">Submit</button>
      <button type="reset" class="btn btn-secondary">Reset</button>
      <a class="btn btn-dark" href="homepgmhs.php" role="button">Kembali</a>
   </form>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

</html>