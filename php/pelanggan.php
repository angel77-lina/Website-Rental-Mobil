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
			$edit = mysqli_query($koneksi, "UPDATE pelanggan set ID_pelanggan = '$_POST[tidpelanggan]',
				Nama_pelanggan = '$_POST[tinamapelanggan]',
				Alamat = '$_POST[talamat]',
				No_HP = '$_POST[tnohp]'
				where ID_pelanggan = '$_GET[id]'
			");
			if($edit) //jika edit sukses
			{
				echo "<script>
						alert('Edit data sukses!');
						document.location = 'pelanggan.php';
					 </script>";
			}
			else
			{
				echo "<script>
						alert('Edit data GAGAL!');
						document.location = 'pelanggan.php';
					 </script>";
			}
		}
		else
		{
			//Data akan disimpan baru
			$simpan = mysqli_query($koneksi, "INSERT INTO pelanggan (ID_pelanggan,Nama_pelanggan,Alamat,No_HP) Values ('$_POST[tidpelanggan]', '$_POST[tinamapelanggan]', '$_POST[talamat]','$_POST[tnohp]')
			");
			if($simpan) //jika simpan sukses
			{
				echo "<script>
						alert('Simpan data sukses!');
						document.location = 'pelanggan.php';
					 </script>";
			}
			else
			{
				echo "<script>
						alert('Simpan data GAGAL!');
						document.location = 'pelanggan.php';
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
			$tampil = mysqli_query($koneksi, "SELECT * FROM pelanggan where ID_pelanggan = '$_GET[id]'");
				$data = mysqli_fetch_array($tampil);
				if($data)
				{
					//jika data ditemukan maka data ditampung dalam variabel
					$vidpelanggan = $data['ID_pelanggan'];
					$vnama = $data['Nama_pelanggan'];
					$valamat = $data['Alamat'];
					$vnohp = $data['No_HP'];
				}
		}
		else if ($_GET['hal']=='hapus')
		{
			//persiapan hapus data
			$hapus = mysqli_query($koneksi, "DELETE FROM pelanggan where ID_pelanggan = '$_GET[id]' ");
			if($hapus){
				echo "<script>
						alert('Hapus data sukses!');
						document.location = 'pelanggan.php';
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
        <a class="nav-link active" href="pelanggan.php">Pelanggan <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="mobil.php">Daftar Mobil </a>
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
	    Form Input Data Pelanggan
	  </div>
	  <div class="card-body">
	    <form method= "post" action="">
	    	<div class = "form-group">
	    		<label>ID Pelanggan</label>
	    		<input type="text" name="tidpelanggan" value="<?=@$vidpelanggan?>" class="form-control" placeholder="Input id pelanggan disini" required>
	    	</div>
	    	<div class = "form-group">
	    		<label>Nama Pelanggan</label>
	    		<input type="text" name="tinamapelanggan" value="<?=@$vnama?>" class="form-control" placeholder="Input nama pelanggan disini" required>
	    	</div>
	    	<div class = "form-group">
	    		<label>Alamat</label>
	    		<textarea class="form-control" name="talamat" placeholder="Input Alamat anda disini"><?=@$valamat?></textarea>
	    	</div>
	    	<div class = "form-group">
	    		<label>No HP</label>
	    		<input type="text" name="tnohp" value="<?=@$vnohp?>" class="form-control" placeholder="Input No Hp disini" required>
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
	    Daftar Pelanggan
	  </div>
	  <div class="card-body">

	  	<table class="table table-bordered table-striped">
	  		<tr>
	  			<th>No.</th>
	  			<th>Id Pelanggan</th>
	  			<th>Nama Pelanggan</th>
	  			<th>Alamat</th>
	  			<th>No HP</th>
	  			<th>Aksi</th>
	  		</tr>
	  		<?php
	  			$no = 1;
	  			$tampil = mysqli_query ($koneksi, "SELECT * from pelanggan order by ID_pelanggan desc");
	  			while($data=mysqli_fetch_array($tampil)) :

	  		?>
	  		<tr>
	  			<td><?=$no++;?></td>
	  			<td><?=$data['ID_pelanggan']?></td>
	  			<td><?=$data['Nama_pelanggan']?></td>
	  			<td><?=$data['Alamat']?></td>
	  			<td><?=$data['No_HP']?></td>
	  			<td>
	  				<a href="pelanggan.php?hal=edit&id=<?=$data['ID_pelanggan']?>" class="btn btn-warning"> Edit </a>
	  				<a href="pelanggan.php?hal=hapus&id=<?=$data['ID_pelanggan']?>" 
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