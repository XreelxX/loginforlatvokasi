<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="style.css">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

	<title>Login</title>
</head>
<body>

	<!--ambil data dari navbar-->
	<?php include('navbar.php'); ?>

	<?php 
	 
	//ambil database dari config.php
	include 'koneksi.php';
	 
	//Menghilangkan tampilan pesan kesalahan
	error_reporting(0);
	 
	//// Memulai sesi atau mengaktifkan sesi yang sudah ada//
	session_start();

	//jika pengguna telah login maka akan dialihkan ke dashboard.php
	if (isset($_SESSION['nama'])) {
	    header("Location: dashboard.php");
	}
	 
	//jika kilk tombol login//
	//mengambil nilai melalui formulir dengan nama input "email dan password" menggunakan metode POST//
	if (isset($_POST['submit'])) {
	    $email = $_POST['email'];
	    $password = md5($_POST['password']);
	     
	    //pernyataan SQL yang digunakan untuk mengambil data dari tabel "users".//
	    $sql = "SELECT * FROM tb_anggota WHERE email='$email' AND password='$password'";
	    $result = mysqli_query($conn, $sql);

	    //pernyataan yang digunakan untuk mengambil data dari hasil permintaan SQL//
	    if ($result->num_rows > 0) {
	        $row = mysqli_fetch_assoc($result);

	        //sesi "username" yang telah di simpan di cek jika ada akan di arahkan ke dashboard".
	        $_SESSION['nama'] = $row['nama'];
	        header("Location: dashboard.php");
	    } 
	    //sesi "username" tidak di temukan maka muncul alert"
	    else {
	        echo "<script>alert('Email atau password Anda salah. Silahkan coba lagi!')</script>";
	    }
	}
	 
	?>

	<div class="container">
	    <div class="row mt-5">
	        <div class="col-md-6 mx-auto">
	            <div class="card">
	                <div class="card-header bg-primary text-white">
	                    <h3 class="text-center">Halaman Login</h3>
	                </div>
	                <div class="card-body">
	                    <form action="" method="POST">
	                        <div class="mb-3">
	                            <label for="email" class="form-label">Email</label>
	                            <input type="text" class="form-control" id="email" placeholder="Masukkan username Anda" name="email" value="<?php echo $email; ?>">
	                        </div>
	                        <div class="mb-3">
	                            <label for="password" class="form-label">Password</label>
	                            <input type="password" class="form-control" id="password" placeholder="Masukkan password Anda" name="password" value="<?php echo $_POST['password']; ?>" >
	                        </div>
	                        <p>Anda belum punya akun? <a href="register.php">Register</a></p>
	                        <div class="text-center mt-5">
	                            <button type="submit" name="submit" class="btn btn-primary">Masuk</button>
	                        </div>
	                    </form>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

</body>
</html>