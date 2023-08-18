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
   <title>Presensi Mahasiswa</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
   <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
   <!-- Link CSS & JS -->
   <link rel="stylesheet" href="datamhs2.css">
   <script src="datamhs.js"></script>
</head>

<body>
<?php
include 'connect.php';

$nama = $_SESSION['nama'];
$connect->exec("USE pa_absensi");
$query = "SELECT matkul,
      MAX(CASE WHEN week = '1' THEN status END) AS week1,
      MAX(CASE WHEN week = '2' THEN status END) AS week2,
      MAX(CASE WHEN week = '3' THEN status END) AS week3,
      MAX(CASE WHEN week = '4' THEN status END) AS week4
FROM absensi
WHERE nama = :nama
GROUP BY matkul";
$declar = $connect->prepare($query);
$declar->bindParam(':nama', $nama);
$declar->execute();
// $query2 = "SELECT * FROM absensi_view";
// $declar2 = $connect->prepare($query2);
// $declar2->execute();
$result = $declar->fetchAll(PDO::FETCH_ASSOC);
?>

   <div class="navbar">
   <nav class="navbar navbar-expand-sm fixed-top">
      <div class="container-fluid">
         <a class="navbar-brand">
            <strong>DATA PRESENSI</strong>
         </a>
      </div>
   </nav>
   </div>
   <div class="container" style="margin-top:100px;">
      <br>
      <div class="row">
         <div class="col table-responsive">
            <div class="card">
               <div class="card-header">
               <h2 class="text-center">
               <strong>DATA PRESENSI</strong>
            </h2>
            <table class="table table-striped">
               <thead>
                  <tr>
                     <th>Nomor</th>
                     <th>Matkul</th>
                     <th>Week 1</th>
                     <th>Week 2</th>
                     <th>Week 3</th>
                     <th>Week 4</th>
                  </tr>
               </thead>
               <tbody>
               <?php $i = 1;
                  foreach($result as $row){?>
                     <tr>
                        <th><?php echo $i; ?></th>
                        <td><?php echo $row['matkul']; ?></td>
                        <td><?php echo $row['week1']; ?></td>
                        <td><?php echo $row['week2']; ?></td>
                        <td><?php echo $row['week3']; ?></td>
                        <td><?php echo $row['week4']; ?></td>
                     </tr>
                  <?php $i++; } ?>
               </tbody>
            </table>
            <a class="btn btn-primary" href="homepgmhs.php" role="button" style="margin-top: 20px; margin-bottom: 20px;">Kembali</a>
               </div>
            </div>
         </div>
      </div>
   </div>

   <script src="https://kit.fontawesome.com/1d954ea888.js" crossorigin="anonymous"></script>
   <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
   <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

   <script>
      $(document).ready(function() {
         $('.table').DataTable();
      })
   </script>
   <script src="datamhs.js"></script>
</body>

</html>