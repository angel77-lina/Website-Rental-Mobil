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
			$edit = mysqli_query($koneksi, "UPDATE Harga_sewa_rute set Code_harga = '$_POST[tcodeharga]',
				Tujuan = '$_POST[ttujuan]',
				Jenis_hari = '$_POST[tjenishari]',
				Harga_rute = '$_POST[thargarute]'
				where Code_harga = '$_GET[id]'
			");
			if($edit) //jika edit sukses
			{
				echo "<script>
						alert('Edit data sukses!');
						document.location = 'harga_sewa_rute.php';
					 </script>";
			}
			else
			{
				echo "<script>
						alert('Edit data GAGAL!');
						document.location = 'harga_sewa_rute.php';
					 </script>";
			}
		}
		else
		{
			//Data akan disimpan baru
			$simpan = mysqli_query($koneksi, "INSERT INTO harga_sewa_rute (Code_harga,Tujuan,Jenis_hari,Harga_rute) Values ('$_POST[tcodeharga]', '$_POST[ttujuan]', '$_POST[tjenishari]','$_POST[thargarute]')
			");
			if($simpan) //jika simpan sukses
			{
				echo "<script>
						alert('Simpan data sukses!');
						document.location = 'harga_sewa_rute.php';
					 </script>";
			}
			else
			{
				echo "<script>
						alert('Simpan data GAGAL!');
						document.location = 'harga_sewa_rute.php';
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
			$tampil = mysqli_query($koneksi, "SELECT * FROM harga_sewa_rute where Code_harga = '$_GET[id]'");
				$data = mysqli_fetch_array($tampil);
				if($data)
				{
					//jika data ditemukan maka data ditampung dalam variabel
					$vcodeharga = $data['Code_harga'];
					$vtujuan = $data['Tujuan'];
					$vJenis_hari = $data['Jenis_hari'];
					$vhargarute = $data['Harga_rute'];
				}
		}
		else if ($_GET['hal']=='hapus')
		{
			//persiapan hapus data
			$hapus = mysqli_query($koneksi, "DELETE FROM harga_sewa_rute where Code_harga = '$_GET[id]' ");
			if($hapus){
				echo "<script>
						alert('Hapus data sukses!');
						document.location = 'harga_sewa_rute.php';
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
      <li class="nav-item">
        <a class="nav-link" href="mobil.php">Daftar Mobil</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link " href="harga_sewa_rute.php">Daftar Rute <span class="sr-only">(current)</span> </a>
      </li>
	  <li class="nav-item">
        <a class="nav-link " href="karyawan.php">Karyawan</a>
      </li>
    </ul>
  </div>
</nav>
	<!--Awala card form-->
	<div class="card mt-5">
	  <div class="card-header bg-primary text-white">
	    Form Harga Sewa Berdasarkan Rute
	  </div>
	  <div class="card-body">
	    <form method= "post" action="">
	    	<div class = "form-group">
	    		<label>Code Harga</label>
	    		<input type="text" name="tcodeharga" value="<?=@$vcodeharga?>" class="form-control" placeholder="Input code harga disini" required>
	    	</div>
	    	<div class = "form-group">
	    		<label>Tujuan</label>
	    		<input type="text" name="ttujuan" value="<?=@$vtujuan?>" class="form-control" placeholder="Input Tujuan disini" required>
	    	</div>
	    	<div class = "form-group">
	    		<label>Jenis Hari</label>
	    		<select class="form-control" name="tjenishari">
	    			<option></option>
	    			<option value="Biasa">Biasa</option>
	    			<option value="Weekend/Libur">Weekend/Libur</option>
	    			<option value="Biasa/Weekend/Libur"> Biasa/Weekend/Libur</option>
	    		</select>
	    	</div>
	    	<div class = "form-group">
	    		<label>Harga Rute</label>
	    		<input type="number" name="thargarute" value="<?=@$vhargarute?>" class="form-control" placeholder="Input harga rute disini" required>
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
	    Daftar Harga Sewa Berdasakan Rute
	  </div>
	  <div class="card-body">

	  	<table class="table table-bordered table-striped">
	  		<tr>
	  			<th>No.</th>
	  			<th>Code Harga</th>
	  			<th>Tujuan</th>
	  			<th>Jenis Hari</th>
	  			<th>Harga Rute</th>
	  			<th>Aksi</th>
	  		</tr>
	  		<?php
	  			$no = 1;
	  			$tampil = mysqli_query ($koneksi, "SELECT * from harga_sewa_rute order by Code_harga desc");
	  			while($data=mysqli_fetch_array($tampil)) :

	  		?>
	  		<tr>
	  			<td><?=$no++;?></td>
	  			<td><?=$data['Code_harga']?></td>
	  			<td><?=$data['Tujuan']?></td>
	  			<td><?=$data['Jenis_hari']?></td>
	  			<td><?=$data['Harga_rute']?></td>
	  			<td>
	  				<a href="harga_sewa_rute.php?hal=edit&id=<?=$data['Code_harga']?>" class="btn btn-warning"> Edit </a>
	  				<a href="harga_sewa_rute.php?hal=hapus&id=<?=$data['Code_harga']?>" 
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