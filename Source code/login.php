<!-- FILE INI DIGUNAKAN UNTUK SIGN UP/REGISTER DAN UNTUK LOG IN -->

<?php
session_start();
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="login2.css">
	<title>Webleb</title>
</head>

<body>
<?php
include 'connect.php';

//untuk register / sign up
if(isset($_POST['register'])){
	try{
		$nama = strtolower(stripslashes($_POST['username']));
		$nrp = $_POST['nrp'];
		$noid = $_POST['nrp'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$role = 'mahasiswa';
		$connect->exec("USE pa_absensi");
		// cek apakah data sudah ada / belum di DB mahasiswa
		$query2 = "SELECT * FROM mahasiswa WHERE nama = :username AND nrp = :nrp";
		$declar2 = $connect->prepare($query2);
		$declar2->bindParam(':username', $username);
      $declar2->bindParam(':nrp', $nrp);
      $declar2->execute();
		$result = $declar2->rowCount();
		if($result > 0){
			$error = "<script> alert(\"Error, Data yang dimasukkan sudah ada pada Sistem!\")</script>";
			echo $error;
		}
		// create ke database mahasiswa
		if(empty($error)){
			$query = "INSERT INTO mahasiswa VALUES('$nama', '$nrp', '$email', '$password')";
			$declar = $connect->prepare($query);
			$declar->execute();
			echo "<script> alert(\"Data berhasil disimpan\")</script>";
		}

		// cek apakah data sudah ada / belum di DB user
		$query2 = "SELECT * FROM user WHERE nama = :username AND noid = :nrp";
		$declar2 = $connect->prepare($query2);
      $declar2->bindParam(':username', $username);
      $declar2->bindParam(':nrp', $noid);
      $declar2->execute();
		$result = $declar2->rowCount();
		if($result > 0){
			$error = "<script> alert(\"Error, Data yang dimasukkan sudah ada pada Sistem!\")</script>";
			echo $error;
		}
		// create ke database user
		if(empty($error)){
			$query = "INSERT INTO user VALUES('$nama', '$noid', '$email', '$password' ,'$role')";
			$declar = $connect->prepare($query);
			$declar->execute();
			echo "<script> alert(\"Data berhasil disimpan\")</script>";
		}
	}
	catch (PDOException $e) {
      // echo $e->getMessage();
		echo "<script> alert(\"Error, Data yang dimasukkan sudah ada pada Sistem!\")</script>";
	}
}

// untuk login
if (isset($_POST['login'])) {
	try{
		$username = $_POST['username'];
		$password = $_POST['password'];
		$connect->exec('USE pa_absensi');
		$query = "SELECT * FROM user WHERE nama = :username AND password = :password";
		$declar = $connect->prepare($query);
      $declar->bindParam(':username', $username);
      $declar->bindParam(':password', $password);
      $declar->execute();
		$result = $declar->rowCount();
      if ($result > 0) {
      	$roledeclr = "SELECT role FROM user WHERE nama = :username";
      	$declar2 = $connect->prepare($roledeclr);
         $declar2->bindParam(':username', $username);
         $declar2->execute();
         $role = $declar2->fetchColumn();
         $_SESSION['nama'] = $username;
         $_SESSION['role'] = $role;
			if($_SESSION['role'] == 'mahasiswa'){
				header('location:http://localhost/wpweb/PA/homepgmhs.php');
			}
			elseif($_SESSION['role'] == 'admin'){
				header('location:http://localhost/wpweb/PA/homepgadmin.php');
			}
      }
		else{
			echo "<script> alert(\"Error, Full Name atau Password salah\")</script>";
		}
		
	}
	catch (PDOException $e) {
      echo $e->getMessage();
		echo "<script> alert(\"Error, Full Name atau Password salah\")</script>";
	}
}
?>
   <video autoplay muted loop id="myVideo">
   <source src="Contact.mp4" type="video/mp4">
   </video>
	<div class="section">
		<div class="container">
			<div class="row full-height justify-content-center">
				<div class="col-12 text-center align-self-center py-5">
					<div class="section pb-5 pt-5 pt-sm-2 text-center">
						<h4 class="mb-0 pb-3"><span> PRESENSI PERKULIAHAN </span></h4>
						<h6 class="mb-0 pb-3"><span> LOG IN </span><span>SIGN UP</span></h6>
						<input class="checkbox" type="checkbox" id="reg-log" name="reg-log" />
						<label for="reg-log"></label>
						<div class="card-3d-wrap mx-auto">
							<div class="card-3d-wrapper">
								<div class="card-front pnl">
									<div class="center-wrap">
										<div class="section text-center">
											<h4 class="mb-4 pb-3">LOG IN</h4>
											<div class="form-group">
												<form action="" method="post">
													<input type="text" class="form-style" name="username" placeholder="Full Name">
												<i class="input-icon uil uil-at"></i>
											</div>
											<div class="form-group mt-2">
													<input type="password" class="form-style" name="password" placeholder="Password">
												<i class="input-icon uil uil-lock-alt"></i>
											</div>
											<button type="submit" name="login" class="btn mt-4" formaction="login.php">Login</button>
											</form>
										</div>
									</div>
								</div>
								<div class="card-back pnl">
									<div class="center-wrap">
										<div class="section text-center">
											<h4 class="mb-3 pb-3">SIGN UP</h4>
											<div class="form-group">
												<form action="" method="post">
												<input type="text" class="form-style" placeholder="Full Name" name="username" required>
												<i class="input-icon uil uil-user-circle"></i>
											</div>
											<div class="form-group mt-2">
												<input type="text" class="form-style" placeholder="NRP" name="nrp" required>
												<i class="input-icon uil uil-user"></i>
											</div>
											<div class="form-group mt-2">
												<input type="email" class="form-style" placeholder="Email" name="email" required>
												<i class="input-icon uil uil-at"></i>
											</div>
											<div class="form-group mt-2">
												<input type="password" class="form-style" placeholder="Password" name="password" required>
												<i class="input-icon uil uil-lock-alt"></i>
											</div>
											<button type="submit" name="register" class="btn mt-4" formaction="login.php">Register</button>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>
