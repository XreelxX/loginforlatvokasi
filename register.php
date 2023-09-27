<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" type="text/css" href="style.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

    <title>Registrasi</title>
</head>
<body>

         <!--ambil data dari navbar-->
        <?php include('navbar.php'); ?>

        <?php
        //ambil data dari database//
        include 'koneksi.php';

        // menghilangkan tampilan pesan kesalahan //
        error_reporting(0);

        // memulai sesi atau mengaktifkan sesi yang sudah ada //
        session_start();

         //jika sesi usernmae telah di buat//
         //akan di arahkan ke index.php//
        if(isset($_SESSION['nama'])) {
            header("Location: index.php");
        }

        //jika klik tombol submit/register//
         //mengambil nilai yang telah di tambahkan melalui formuir//
        if(isset($_POST['submit'])) {
            $username = $_POST['nama'];
            $jk = $_POST['jenis_kelamin'];
            $alamat = $_POST['alamat'];
            $email = $_POST['email'];
            $password = md5($_POST['password']);
            $cpassword = md5($_POST['cpassword']);

            //jika kedua kata sandi ini cocok satu sama lain, maka kondisi ini akan bernilai true//
            if($password == $cpassword) {
                ////pernyataan SQL digunakan untuk melakukan permintaan pemilihan (SELECT) data dari tabel "users" pada email//
                $sql = "SELECT * FROM tb_anggota WHERE email ='$email'";
                $result = mysqli_query($conn, $sql);

                 //hasil input formulir akan di tambahkan ke sql pada table users//
                if(!$result->num_rows > 0) {
                    $sql = "INSERT INTO tb_anggota (nama, jenis_kelamin, alamat, email, password)
                        VALUES ('$username', '$jk', '$alamat', '$email', '$password')";
                    $result = mysqli_query($conn, $sql);

                    //jika data yang di input belum ada di database users maka muncul alert//
                    if($result) {
                        echo "<script>alert('Selamat, registrasi berhasil!')</script>";
                        $username = "";
                        $email = "";
                        $_POST['password'] = "";
                        $_POST['cpassword'] = "";
                    } else {
                        //jika input tidak sesuai formulir maka muncul alert//
                        echo "<script>alert('Woops! Terjadi kesalahan.')</script>";
                    }
                } else {
                    //jika data sudah penah di tambahkan maka muncul alert//
                    echo "<script>alert('Woops! Email sudah terdaftar.')</script>";
                }
            } else {
                 //jika salah masukan konfirmasi password akan muncul alert//
                echo "<script>alert('Password Tidak Sesuai')</script>";
            }
        }
        ?>

       <!--formulir register-->
        <div class="container">
            <div class="row mt-3">
                <div class="col-md-6 mx-auto">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h3 class="text-center">Halaman Registrasi</h3>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama" placeholder="Masukkan nama lengkap Anda" name="username" value="<?php echo $username; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                    <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin" value="<?php echo $jk; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" placeholder="Masukkan Alamat Anda" name="alamat" value="<?php echo $alamat; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="Masukkan email Anda" name="email" value="<?php echo $email; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" placeholder="Masukkan password Anda" name="password" value="<?php echo $_POST['password']; ?>">
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Konfirmasi Password</label>
                                    <input type="password" class="form-control" id="nama" placeholder="Confirm Password" name="cpassword" value="<?php echo $_POST['cpassword']; ?>">
                                </div>
                                <div>
                                    <p>Anda sudah punya akun? <a href="login.php">Login</a></p>
                                </div>

                                <div class="text-center mt-5">
                                    <button name="submit" class="btn btn-primary">Daftar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</body>
</html>