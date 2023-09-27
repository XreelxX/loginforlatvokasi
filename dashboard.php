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

	<title>Dashboard</title>
</head>
<body>

	<?php include('navbar.php'); ?>
    
    <?php 
     
     //memulai atau memulai sesi dalam PHP//
     session_start();
      
     // Jika variabel sesi 'username' belum di input (artinya pengguna belum login), maka akan di arahkan kembali ke index.php//
     if (!isset($_SESSION['nama'])) {
         header("Location: index.php");
     }
      
     ?>

     <section>
    	<div class="container mt-5 text-white">
      	<!--pesan selamat datang dengan diambil dari variabel sesi 'username', dan pesan tersebut akan ditampilkan sebagai heading 1-->
    	<?php echo "<h1>Selamat Datang, " . $_SESSION['nama'] ."!". "</h1>"; ?>
             
            <div class="input-group">
              <a href="logout.php" class="btn btn-primary">Logout</a>
            </div>
        </div>
	</section>

    <section>
		<div class="container text-white">
	          <h2 class="mt-5 text-center">Data Diri Anggota Forlatvokasi</h2>
	          <form id="registrationForm" class="mt-3">
	            <div class="mb-3">
	              <label for="nama" class="form-label">Nama Lengkap</label>
	              <input type="text" class="form-control" id="namalengkap" required>
	            </div>
	            <div class="mb-3">
	              <label for="nama" class="form-label">Jenis Kelamin:</label>
	              <input type="text" class="form-control" id="jeniskelamin" required>
	            </div>
	            <div class="mb-3">
	              <label for="tanggalBergabung" class="form-label">No HP:</label>
	              <input type="number" class="form-control" id="nohp" required>
	            </div>
	        
	            <div class="mb-3">
	              <label for="nomorAnggota" class="form-label">Alamat:</label>
	              <input type="text" class="form-control" id="Alamat" required>
	            </div>
	        
	            <div class="mb-3">
	              <label for="tanggalBergabung" class="form-label">Tanggal Bergabung:</label>
	              <input type="date" class="form-control" id="tanggalBergabung" required>
	            </div>

	            <button type="button" class="btn btn-primary" onclick="buatKartuAnggota()">Simpan</button>
	          </form>
	    </div>
	  </section>

	  <section>
	  <div class="container mt-5">
	          <div id="kartuAnggota" class="card d-block m-5">
	            <div class="card-body">
	              <h5 class="card-title text-center">Kartu Anggota Forlatvokasi</h5>
	              <p class="card-text">Nama Lengkap: <span id="outputnamalengkap"></span></p>
	              <p class="card-text">Jenis Kelamin: <span id="outputjeniskelamin"></span></p>
	              <p class="card-text">No HP: <span id="outputnohp"></span></p>
	              <p class="card-text">Alamat: <span id="outputAlamat"></span></p>
	              <p class="card-text">Tanggal Bergabung: <span id="outputtanggalBergabung"></span></p>
	              <button type="button" class="btn btn-primary" onclick="cetakkartu()">Cetak</button>
	            </div>
	          </div>
	  </section>

	  <script>
	    //jika tombol simpan di klik//
	      function buatKartuAnggota() {
			//variabel berisikan id//
	          var namapimpinan = document.getElementById("namalengkap").value;
	          var namalpk = document.getElementById("jeniskelamin").value;
	          var nohp = document.getElementById("nohp").value;
	          var Alamat = document.getElementById("Alamat").value;
	          var tanggalBergabung = document.getElementById("tanggalBergabung").value;

			  //mengambil elemen dari id//
	          document.getElementById("outputnamalengkap").textContent = namapimpinan;
	          document.getElementById("outputjeniskelamin").textContent = namalpk;
	          document.getElementById("outputnohp").textContent = nohp;
	          document.getElementById("outputAlamat").textContent = Alamat;
	          document.getElementById("outputtanggalBergabung").textContent = tanggalBergabung;

	          document.getElementById("registrationForm").style.display = "none";
	          document.getElementById("kartuAnggota").classList.remove("d-none");
	       }
	        
	       //untuk cetak print di windows//
	       function cetakkartu() {
	          window.print();
	      }
	      
	  </script>

</body>
</html>