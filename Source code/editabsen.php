<?php
session_start();
if (!isset($_SESSION['nama'])) {
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
   <!-- Link CSS -->
   <link rel="stylesheet" href="editabsen2.css">
   <script src="tabel.js"></script>
</head>

<body>
   <?php
   // Koneksi ke database
   include "connect.php";
   // Mengambil data mahasiswa
   $connect->exec("USE pa_absensi");
   $query = "SELECT * FROM absensi";
   $declar = $connect->prepare($query);
   $declar->execute();
   $result = $declar->fetchAll();

   if (isset($_POST['edit'])) {
      $status = $_POST['status'];
      $absen_id = $_POST['id_absen'];
      $connect->exec("USE pa_absensi");
      $query = "UPDATE absensi SET status = '$status' WHERE absensi_id='$absen_id'";
      $declar = $connect->prepare($query);
      $result = $declar->execute();
      if ($result == true) {
         $error = "<script> alert(\"Data berhasil disimpan\")</script>";
         echo $error;
         header('location:editabsen.php');
      }
   }
   if (isset($_POST['hapus'])) {
      $absen_id = $_POST['id_absen'];
      $connect->exec("USE pa_absensi");
      $query = "DELETE FROM absensi WHERE absensi_id='$absen_id'";
      $declar = $connect->prepare($query);
      $result = $declar->execute();
      if ($result == true) {
         $error = "<script> alert(\"Data berhasil disimpan\")</script>";
         echo $error;
         header('location:editabsen.php');
      }
   }
   ?>
   <video autoplay muted loop id="kontak">
      <source src="Reviews.mp4" video/mp4">
   </video>
   <div class="navbar">
      <nav class="navbar navbar-expand-sm fixed-top">
         <div class="container-fluid">
            <a class="navbar-brand">
               <strong>EDIT DATA PRESENSI</strong>
            </a>
         </div>
      </nav>
   </div>
   <div class="container" style="margin-top:20px;">
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
                           <th>Absensi_id</th>
                           <th>Nama</th>
                           <th>NRP</th>
                           <th>Matkul</th>
                           <th>Week</th>
                           <th>Status</th>
                           <th>Opsi</th>
                           <th>Ubah</th>
                        </tr>
                     </thead>
                     <tbody>
                        <!-- Menampilkan data mahasiswa dari database -->
                        <?php $i = 1;
                        foreach ($result as $row) { ?>
                           <tr>
                              <th><?php echo $i; ?></th>
                              <td><?php echo $row['absensi_id']; ?></td>
                              <td><?php echo $row['nama']; ?></td>
                              <td><?php echo $row['nrp']; ?></td>
                              <td><?php echo $row['matkul']; ?></td>
                              <td><?php echo $row['week']; ?></td>
                              <td><?php echo $row['status']; ?></td>
                              <td>
                                 <form method="post">
                                    <input type="text" style="display:none" name="id_absen" value="<?php echo $row['absensi_id']; ?>">
                                    <input type="text" style="display:none" name="status" value="<?php echo $row['status']; ?>">
                                    <button formaction="editabsen.php" name='edit' type='submit' class='btn btn-info btn-sm'>Edit</button>
                                    <button formaction="editabsen.php" name='hapus' type='submit' class='btn btn-info btn-sm'>Hapus</button>
                              </td>
                              <td>
                                 <div class="form-inline">
                                    <div class="form-check ml-2">
                                       <input type="radio" class="form-check-input" id="status" name="status" value="A">
                                       <label class="form-check-label" for="status">Alpha</label>
                                    </div>
                                    <div class="form-check ml-2">
                                       <input type="radio" class="form-check-input" id="status" name="status" value="H">
                                       <label class="form-check-label" for="status">Hadir</label>
                                    </div>
                                    <div class="form-check ml-2">
                                       <input type="radio" class="form-check-input" id="status" name="status" value="I">
                                       <label class="form-check-label" for="status">Ijin</label>
                                    </div>
                                    <div class="form-check ml-2">
                                       <input type="radio" class="form-check-input" id="status" name="status" value="S">
                                       <label class="form-check-label" for="status">Sakit</label>
                                    </div>
                                 </div>
                              </td>
                              </form>
                           </tr>
                        <?php $i++;
                        } ?>
                     </tbody>
                  </table>
                  <a class="btn btn-primary" href="homepgadmin.php" role="button" style="margin-top: 20px; margin-bottom: 20px;">Kembali</a>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- Modal Tambah Mahasiswa -->
   <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
      <!-- Isi form tambah mahasiswa -->
   </div>

   <!-- Modal Edit Mahasiswa -->
   <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
      <!-- Isi form edit mahasiswa -->
   </div>

   <!-- Modal Hapus Mahasiswa -->
   <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <!-- Konfirmasi penghapusan mahasiswa -->
   </div>

   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   <script src="https://kit.fontawesome.com/1d954ea888.js" crossorigin="anonymous"></script>
   <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
   <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

   <script>
      $(document).ready(function() {
         $('.table').DataTable();
      })
   </script>
   <script src="tabel.js"></script>

</body>

</html>