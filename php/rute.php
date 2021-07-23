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
$hargarute = mysqli_query($koneksi, "SELECT harga_rute FROM harga_sewa_rute WHERE code_harga = '".$id."';");

while ($data = mysqli_fetch_array($hargarute)){
    echo $data['harga_rute'];
}
 ?> 