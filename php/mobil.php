<?php
	//koneksi Database
	$server = "localhost";
	$user="root";
	$pass="";
	$database = "rentalmobil_b4";

	$koneksi = mysqli_connect($server, $user, $pass, $database)or die(mysqli_error($koneksi));

	//jika tombol simpan diklik
	if(isset($_POST['bsimpan']))
	{
		//Pengujian Apakah data akan diedit atau disimpan baru
		if($_GET['hal'] == 'edit')
		{
			//data diedit
			$edit = mysqli_query($koneksi, "UPDATE mobil set ID_Mobil = '$_POST[tidmobil]',
				Jenis_mobil = '$_POST[tjenismobil]',
				Warna_mobil = '$_POST[twarnamobil]',
				Harga_sewa_mobil = '$_POST[thargasewamobil]'
				where ID_Mobil = '$_GET[id]'
			");
			if($edit) //jika edit sukses
			{
				echo "<script>
						alert('Edit data sukses!');
						document.location = 'mobil.php';
					 </script>";
			}
			else
			{
				echo "<script>
						alert('Edit data GAGAL!');
						document.location = 'mobil.php';
					 </script>";
			}
		}
		else
		{
			//Data akan disimpan baru
			$simpan = mysqli_query($koneksi, "INSERT INTO mobil (ID_Mobil,Jenis_mobil,Warna_mobil,Harga_sewa_mobil) Values ('$_POST[tidmobil]', '$_POST[tjenismobil]', '$_POST[twarnamobil]','$_POST[thargasewamobil]')
			");
			if($simpan) //jika simpan sukses
			{
				echo "<script>
						alert('Simpan data sukses!');
						document.location = 'mobil.php';
					 </script>";
			}
			else
			{
				echo "<script>
						alert('Simpan data GAGAL!');
						document.location = 'mobil.php';
					 </script>";
			}
		}

		
	}

	//pengujian jika tombol edit/hapus diklik
	if(isset($_GET['hal']))
	{
		//pengujian jika edit data
		if($_GET['hal'] == "edit")
		{
			//Tampilkan data yang akan diedit
			$tampil = mysqli_query($koneksi, "SELECT * FROM mobil where ID_Mobil = '$_GET[id]'");
				$data = mysqli_fetch_array($tampil);
				if($data)
				{
					//jika data ditemukan maka data ditampung dalam variabel
					$vidmobil = $data['ID_Mobil'];
					$vjenismobil = $data['Jenis_mobil'];
					$vwarnamobil = $data['Warna_mobil'];
					$vhargasewamobil = $data['Harga_sewa_mobil'];
				}
		}
		else if ($_GET['hal']=='hapus')
		{
			//persiapan hapus data
			$hapus = mysqli_query($koneksi, "DELETE FROM mobil where ID_mobil = '$_GET[id]' ");
			if($hapus){
				echo "<script>
						alert('Hapus data sukses!');
						document.location = 'mobil.php';
					 </script>";
			}

		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>CRUD Rental Mobil</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
<div class="container">

	<h1 class="text-center">CRUD Rental Mobil</h1>
	<h2 class="text-center">Basis Data</h2>

	<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Menu</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item ">
        <a class="nav-link" href="penyewaan.php">Penyewaan </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="pelanggan.php">Pelanggan</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="mobil.php">Daftar Mobil <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item ">
        <a class="nav-link " href="harga_sewa_rute.php">Daftar Rute  </a>
      </li>
	  <li class="nav-item ">
        <a class="nav-link " href="karyawan.php">Karyawan </a>
      </li>
    </ul>
  </div>
</nav>
	<!--Awala card form-->
	<div class="card mt-5">
	  <div class="card-header bg-primary text-white">
	    Form Input Data Mobil
	  </div>
	  <div class="card-body">
	    <form method= "post" action="">
	    	<div class = "form-group">
	    		<label>ID Mobil</label>
	    		<input type="text" name="tidmobil" value="<?=@$vidmobil?>" class="form-control" placeholder="Input id Mobil disini" required>
	    	</div>
	    	<div class = "form-group">
	    		<label>Jenis Mobil</label>
	    		<input type="text" name="tjenismobil" value="<?=@$vjenismobil?>" class="form-control" placeholder="Input jenis Mobil disini" required>
	    	</div>
	    	<div class = "form-group">
	    		<label>Warna Mobil</label>
	    		<input type="text" name="twarnamobil" value="<?=@$vwarnamobil?>" class="form-control" placeholder="Input warna mobil disini" required>
	    	</div>
	    	<div class = "form-group">
	    		<label>Harga Sewa Mobil</label>
	    		<input type="number" name="thargasewamobil" value="<?=@$vhargasewamobil?>" class="form-control" placeholder="Input harga sewa mobil disini" required>
	    	</div>
	    	<button type="submit" class="btn btn-success" name="bsimpan">Simpan</button>
	    	<button type="reset" class="btn btn-danger" name="breset">Reset</button>

	    </form>
	  </div>
	</div>
	<!-- Akhir Card Form-->

	<!--Awal card Tabel-->
	<div class="card mt-5">
	  <div class="card-header bg-success text-white">
	    Daftar Mobil Rental
	  </div>
	  <div class="card-body">

	  	<table class="table table-bordered table-striped">
	  		<tr>
	  			<th>No.</th>
	  			<th>Id Mobil</th>
	  			<th>Jenis Mobil</th>
	  			<th>Warna Mobil</th>
	  			<th>Harga Sewa Mobil</th>
	  			<th>Aksi</th>
	  		</tr>
	  		<?php
	  			$no = 1;
	  			$tampil = mysqli_query ($koneksi, "SELECT * from mobil order by ID_Mobil desc");
	  			while($data=mysqli_fetch_array($tampil)) :

	  		?>
	  		<tr>
	  			<td><?=$no++;?></td>
	  			<td><?=$data['ID_Mobil']?></td>
	  			<td><?=$data['Jenis_mobil']?></td>
	  			<td><?=$data['Warna_mobil']?></td>
	  			<td><?=$data['Harga_sewa_mobil']?></td>
	  			<td>
	  				<a href="mobil.php?hal=edit&id=<?=$data['ID_Mobil']?>" class="btn btn-warning"> Edit </a>
	  				<a href="mobil.php?hal=hapus&id=<?=$data['ID_Mobil']?>" 
	  					onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')" class="btn btn-danger"> Hapus </a>
	  			</td>
	  		</tr>
	  	<?php endwhile; //penutup while ?>
	  	</table>

	  </div>
	</div>
	<!-- Akhir Card Tabel-->

</div>

<script type="text/javascript" src="js/bootstrap.min.js" ></script>
</body>
</html>