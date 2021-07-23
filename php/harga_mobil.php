<?php  
//koneksi Database
$server = "localhost";
$user="root";
$pass="";
$database = "rentalmobil_b4";
$koneksi = mysqli_connect($server, $user, $pass, $database)or die(mysqli_error($koneksi));


// declare variable
$id = $_REQUEST["id"];

// query to get harga by rute   
$hargaMobil = mysqli_query($koneksi, "SELECT Harga_sewa_mobil FROM mobil WHERE ID_mobil = '".$id."';");

while ($data = mysqli_fetch_array($hargaMobil)){
    echo $data['Harga_sewa_mobil'];
}
 ?> 