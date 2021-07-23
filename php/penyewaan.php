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
			$edit = mysqli_query($koneksi, "UPDATE penyewaan set 
				ID_karyawan = '$_POST[tidkaryawan]',
				id_pelanggan = '$_POST[tidpelanggan]',
				Jenis_ID = '$_POST[tjenisid]',
				waktu_peminjaman = '$_POST[twaktupeminjaman]',
				waktu_pengembalian = '$_POST[twaktupengembalian]',
				denda = '$_POST[tdenda]',
				code_harga = '$_POST[tcodeharga]',
				id_mobil = '$_POST[tidmobil]',
				total_harga = '$_POST[ttotalharga]'
				where id_sewa = '$_GET[id]'
			");

			if($edit) //jika edit sukses
			{
				echo "<script>
						alert('Edit data sukses!');
						document.location = 'penyewaan.php';
					 </script>";
			}
			else
			{
				echo "<script>
						alert('Edit data GAGAL!');
						document.location = 'penyewaan.php';
					 </script>";
			}
			
		}
		else
		{
			//Data akan disimpan baru
			$simpan = mysqli_query($koneksi, "INSERT INTO penyewaan (ID_karyawan,id_pelanggan,Jenis_id,waktu_peminjaman,waktu_pengembalian,denda,code_harga,id_mobil,total_harga) Values ('$_POST[tidkaryawan]', '$_POST[tidpelanggan]','$_POST[tjenisid]','$_POST[twaktupeminjaman]','$_POST[twaktupengembalian]','$_POST[tdenda]','$_POST[tcodeharga]','$_POST[tidmobil]','$_POST[ttotalharga]')
			");
			if($simpan) //jika simpan sukses
			{
				echo "<script>
						alert('Simpan data sukses!');
						document.location = 'penyewaan.php';
					 </script>";
			}
			else
			{
				echo "<script>
						alert('Simpan data GAGAL!');
						document.location = 'penyewaan.php';
					 </script>";
			}
		}

		
	}

	//pengujian jika tombol edi/hapus diklik
	if(isset($_GET['hal']))
	{
		//pengujian jika edit data
		if($_GET['hal'] == "edit")
		{
			//Tampilkan data yang akan diedit
			$tampil = mysqli_query($koneksi, "SELECT * FROM penyewaan where id_sewa = '$_GET[id]'");
				$data = mysqli_fetch_array($tampil);
				if($data)
				{
					//jika data ditemukan maka data ditampung dalam variabel
					$vidsewa = $data['ID_sewa'];
					$vidkaryawan = $data['ID_karyawan'];
					$vidpelanggan = $data['ID_pelanggan'];
					$vjenisid = $data['Jenis_ID'];
					$vwaktupeminjaman = $data['Waktu_peminjaman'];
					$vwaktupengembalian = $data['Waktu_pengembalian'];
					$vdenda = $data['denda'];
					$vcodeharga = $data['code_harga'];
					$vidmobil = $data['ID_mobil'];
					$vtotalharga = $data['total_harga'];
				}
		}
		else if ($_GET['hal']=='hapus')
		{
			//persiapan hapus data
			$hapus = mysqli_query($koneksi, "DELETE FROM penyewaan where id_sewa = '$_GET[id]' ");
			if($hapus){
				echo "<script>
						alert('Hapus data sukses!');
						document.location = 'penyewaan.php';
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
      <li class="nav-item active">
        <a class="nav-link" href="penyewaan.php">Penyewaan <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="pelanggan.php">Pelanggan</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="mobil.php">Daftar Mobil</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="harga_sewa_rute.php">Daftar Rute</a>
      </li>
	  <li class="nav-item">
        <a class="nav-link " href="karyawan.php">Karyawan</a>
      </li>
    </ul>
  </div>
</nav>
	<!--Awala card form-->
	<div class="card mt-6">
	  <div class="card-header bg-primary text-white">
	    Form penyewaan
	  </div>
	  <div class="card-body">
	    <form method= "post" action="">
	    	<div class = "form-group">
	    		<label for="tidkaryawan">ID Karyawan</label>
	    		<select name="tidkaryawan" id="tidkaryawan" class="form-control" required>
	    			<option value="">-Pilih-</option>
	    			<?php
	    			$sql_karyawan = mysqli_query($koneksi, "SELECT * from Karyawan") or die (mysqli_error($con));
	    			while ($data_karyawan = mysqli_fetch_array($sql_karyawan)){
	    				echo '<option value="'.$data_karyawan['ID_karyawan'].'">'.$data_karyawan['ID_karyawan'].'</option>';
	    			}
	    			?>
	    		</select>
	    		
	    	</div>
	    	<div class = "form-group">
	    		<label for="tidpelanggan">ID Pelanggan</label>
	    		<select name="tidpelanggan" id="tidpelanggan" class="form-control" required>
	    			<option value="">-Pilih-</option>
	    			<?php
	    			$sql_pelanggan = mysqli_query($koneksi, "SELECT * from pelanggan") or die (mysqli_error($con));
	    			while ($data_pelanggan = mysqli_fetch_array($sql_pelanggan)){
	    				echo '<option value="'.$data_pelanggan['ID_pelanggan'].'">'.$data_pelanggan['ID_pelanggan'].'</option>';
	    			}
	    			?>
	    		</select>
	    		
	    	</div>
	    	<div class = "form-group">
	    		<label>Jenis ID</label>
	    		<select class="form-control" name="tjenisid">
	    			<option value="">-Pilih-</option>
	    			<option value="KTP">KTP</option>
	    			<option value="KK">KK</option>
	    		</select>
	    	</div>

	    	<div class = "form-group">
	    		<label>Waktu Peminjaman</label>
	    		

	    		<input type="datetime-local" name="twaktupeminjaman" value="<?=@$date?>" class="form-control" placeholder="Input waktu peminjaman disini" required>
	    		
	    		
	    	</div>

	    	<div class = "form-group">
	    		<label>Waktu Pengembalian</label>
	    		<input type="datetime-local" name="twaktupengembalian" value="<?=@$vwaktupengembalian?>" class="form-control" placeholder="Input waktu pengembalian disini" required>
	    		
	    	</div>

	    	<div class = "form-group">
	    		<label>Denda</label>
	    		<input type="text" name="tdenda" value="<?=@$vdenda?>" class="form-control" placeholder="Input denda disini" required onkeyup="hargaDenda(this.value)">	
	    	</div>

	    	<div class = "form-group">
	    		<label for="tcodeharga">ID Rute</label>
	    		<select name="tcodeharga" id="tcodeharga" class="form-control" required onchange="hargaRute(this.value)">
	    			<option value="default">-Pilih-</option>
	    			<?php
	    			$sql_sewarute = mysqli_query($koneksi, "SELECT * from Harga_sewa_rute") or die (mysqli_error($con));
	    			while ($data_sewarute = mysqli_fetch_array($sql_sewarute)){
	    				echo '<option value="'.$data_sewarute['Code_harga'].'">'.$data_sewarute['Code_harga'].'</option>';
	    			}
	    			?>
	    		</select>
	    		
	    	</div>

	    	<div class = "form-group">
	    		<label for="tidmobil">ID Mobil</label>
	    		<select name="tidmobil" id="tidmobil" class="form-control" required onchange="hargaMobil(this.value)">
	    			<option value="default">-Pilih-</option>
	    			<?php
	    			$sql_mobil = mysqli_query($koneksi, "SELECT * from Mobil") or die (mysqli_error($con));
	    			while ($data_mobil = mysqli_fetch_array($sql_mobil)){
	    				echo '<option value="'.$data_mobil['ID_Mobil'].'">'.$data_mobil['ID_Mobil'].'</option>';
	    			}
	    			?>
	    		</select>
	    		
	    	</div>

			<script >
				var denda = 0;
				var rute = 0;
				var mobil = 0;

				function hargaDenda (str){
					if (str == ""){
						denda = 0
					} else {
						denda = parseInt(str);	
					}
					document.getElementById("ttotalharga").value = denda + rute + mobil;
				}

				function hargaRute (id){
				    var xmlhttp = new XMLHttpRequest();
				    xmlhttp.onreadystatechange = function() {
				      if (this.readyState == 4 && this.status == 200) {
						if (id === "default"){
							rute = 0
						} else {
							rute = parseInt(this.responseText)
						}
				        document.getElementById("ttotalharga").value = denda + rute + mobil;
				      }
				    };

				    xmlhttp.open("GET","rute.php?id="+id,true);
				    xmlhttp.send();
				}

				function hargaMobil (id){
				    var xmlhttp = new XMLHttpRequest();
				    xmlhttp.onreadystatechange = function() {
				      if (this.readyState == 4 && this.status == 200) {
						if (id === "default"){
							mobil = 0
						} else {
							mobil = parseInt(this.responseText)
						}
				        document.getElementById("ttotalharga").value = denda + rute + mobil;
				      }
				    };

				    xmlhttp.open("GET","harga_mobil.php?id="+id,true);
				    xmlhttp.send();
				}
			</script>


	    	<div class = "form-group">
	    		<label>Total Harga</label>
	    		<?php
	    		#$hargarute = mysqli_query($koneksi, "SELECT harga_rute FROM harga_sewa_rute WHERE code_harga = ")
	    		?>

	    		<input type="text" name="ttotalharga" id="ttotalharga" value="<?=@$vtotalharga?>" class="form-control" readonly>	
	    	</div>

	    	

	    	<button type="submit" class="btn btn-success" name="bsimpan">Simpan</button>
	    	<button type="reset" class="btn btn-danger" name="breset">Reset</button>
		
	    </form>
	  </div>
	</div>
	<!-- Akhir Card Form-->

	<!--Awal card Tabel-->
	<div class="card mt-5">
	  <div class="card-header bg-info text-white">
	    Daftar Penyewaan
	  </div>
	  <div class="card-body">

	  	<table class="table table-bordered table-striped">
	  		<tr>
	  			<th>ID Sewa</th>
	  			<th>ID Karyawan</th>
	  			<th>ID Pelanggan</th>
	  			<th>Jenis Id</th>
	  			<th>Waktu Peminjaman</th>
	  			<th>Waktu Pengembalian</th>
	  			<th>Denda</th>
	  			<th>Code Harga</th>
	  			<th>ID Mobil</th>
	  			<th>Total Harga</th>
	  			<th>Aksi</th>

	  		</tr>
	  		<?php
	  			$tampil = mysqli_query ($koneksi, "SELECT * from penyewaan order by id_sewa desc");
	  			while($data=mysqli_fetch_array($tampil)) :

	  		?>
	  		<tr>
	  			<td><?=$data['ID_sewa']?></td>
	  			<td><?=$data['ID_karyawan']?></td>
	  			<td><?=$data['ID_pelanggan']?></td>
	  			<td><?=$data['Jenis_ID']?></td>
	  			<td><?=$data['Waktu_peminjaman']?></td>
	  			<td><?=$data['Waktu_pengembalian']?></td>
	  			<td><?=$data['denda']?></td>
	  			<td><?=$data['code_harga']?></td>
	  			<td><?=$data['ID_mobil']?></td>
	  			<td><?=$data['total_harga']?></td>
	  			<td>
	  				<a href="penyewaan.php?hal=edit&id=<?=$data['ID_sewa']?>" class="btn btn-warning"> Edit </a>
	  				<a href="penyewaan.php?hal=hapus&id=<?=$data['ID_sewa']?>" 
	  					onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')" class="btn btn-danger"> Hapus </a>
					<a href="print_invoice.php?id=<?=$data['ID_sewa']?>" class="btn btn-success" > Cetak Invoice </a>
					<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.debug.js"></script>
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