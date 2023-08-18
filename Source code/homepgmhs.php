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
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/eos-icons@2.1.0/eos-icons.min.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.0.7/css/boxicons.min.css">
   <link rel="stylesheet" href="huha.css">
   <link rel="stylesheet" href="homepage.css">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/parallax/3.1.0/parallax.min.js"></script>
   <script src="homepage.js"></script>
   <title>MAHASISWA</title>
</head>

<body>
   <div class="sidebar">
      <div class="logo_content">
         <div class="profil">
            <i class='bx bxs-user-circle' id="bxs-user-circle"></i>
            <div class="logo_name">
               <?php
               echo $_SESSION['nama'];
               ?>
            </div>
         </div>
         <i class='bx bx-menu white-icon' id='btn'></i>
      </div>
      <div class="src">
         <i class='bx bx-search'></i>
         <input type="text" placeholder="Search..">
      </div>

      <ul class="nav">
         <li>
            <a href="homepgmhs.php">
               <i class='bx bx-bar-chart-square'></i>
               <span class="link_name">DASHBOARD</span>
            </a>
            <span class="tooltip">DASHBOARD</span>
         </li>
         <li>
            <a href="absen.php">
               <i class='bx bxs-user-check'></i>
               <span class="link_name">PRESENSI</span>
            </a>
            <span class="tooltip">PRESENSI</span>
         </li>
         <li>
            <a href="absenlist.php">
               <i class='bx bx-user-pin'></i>
               <span class="link_name">DATA PRESENSI</span>
            </a>
            <span class="tooltip">DATA PRESENSI</span>
         </li>
         <li>
            <a href="logout.php">
               <i class='bx bx-log-out-circle'></i>
               <span class="link_name">LOGOUT</span>
            </a>
            <span class="tooltip">LOGOUT</span>
         </li>
      </ul>
   </div>

   <div>
      <nav>
         <div class="menu">
            <img src="logo.png" alt="logo">
         </div>
      </nav>

      <section class="wrapper">
         <div class="container">
            <div id="scene" class="scene" data-hover-only="false">
               <div class="circle" data-depth="1.2"></div>

               <div class="one" data-depth="0.9">
                  <div class="content">
                     <span class="piece"></span>
                     <span class="piece"></span>
                     <span class="piece"></span>
                  </div>
               </div>

               <div class="two" data-depth="0.60">
                  <div class="content">
                     <span class="piece"></span>
                     <span class="piece"></span>
                     <span class="piece"></span>
                  </div>
               </div>

               <div class="three" data-depth="0.40">
                  <div class="content">
                     <span class="piece"></span>
                     <span class="piece"></span>
                     <span class="piece"></span>
                  </div>
               </div>

               <p class="p404" data-depth="0.50">WELCOME</p>
               <p class="p404" data-depth="0.10">WELCOME</p>
            </div>

            <div class="text">
               <article>
                  <p>Jangan Lupa Mengisi Presensi <br>SEMANGAT KULIAH!</p>
                  <a href="absen.php"><button>PRESENSI</button></a>
               </article>
            </div>
         </div>
      </section>
      <script src="homepage.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/parallax/3.1.0/parallax.min.js">
         var scene = document.getElementById('scene');
         var parallax = new Parallax(scene);
      </script>
   </div>
   <script src="side.js"></script>
</body>

</html>