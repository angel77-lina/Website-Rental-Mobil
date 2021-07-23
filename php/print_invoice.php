<?php
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class Pdf extends Dompdf{
 public function __construct() {
        parent::__construct();
    }
}

//koneksi Database
$server = "localhost";
$user="root";
$pass="";
$database = "rentalmobil_b4";
$koneksi = mysqli_connect($server, $user, $pass, $database)or die(mysqli_error($koneksi));

$id = $_REQUEST["id"];

// query to get invoice info
$query = mysqli_query($koneksi, "SELECT penyewaan.ID_sewa, pelanggan.Nama_pelanggan, pelanggan.Alamat, penyewaan.Waktu_peminjaman, penyewaan.Waktu_pengembalian, penyewaan.ID_mobil, penyewaan.denda, mobil.Jenis_mobil, mobil.Warna_mobil, mobil.Harga_sewa_mobil,harga_sewa_rute.Tujuan,harga_sewa_rute.Harga_rute,penyewaan.total_harga FROM pelanggan INNER JOIN penyewaan ON penyewaan.ID_pelanggan = pelanggan.ID_pelanggan INNER JOIN mobil ON mobil.ID_Mobil=penyewaan.ID_mobil INNER JOIN harga_sewa_rute ON harga_sewa_rute.Code_harga = penyewaan.code_harga WHERE penyewaan.ID_sewa =  '".$id."'");

while ($data = mysqli_fetch_array($query)){
    $output = '
   <table width="100%" border="1" cellpadding="5" cellspacing="0">
    <tr>
     <td colspan="2" align="center" style="font-size:18px"><b>Invoice</b></td>
    </tr>
    <tr>
     <td colspan="2">
      <table width="100%" cellpadding="5">
       <tr>
        <td width="65%">
         Nama : '.$data['Nama_pelanggan'].'<br /> 
         Alamat : '.$data['Alamat'].'<br /><br />
        </td>
        <td width="35%">
         Nomor invoice : '.$data['ID_sewa'].'<br />
         Tanggal invoice : '.date("Y/m/d").'<br />
        </td>
       </tr>
      </table>
      <br />
      <table width="100%" border="1" cellpadding="5" cellspacing="0">
       <tr>
        <th>No.</th>
        <th>keterangan</th>
        <th>Harga</th>
       </tr>
       <tr>
        <td>1</th>
        <td align="left" >Harga Rute dengan Tujuan '.$data['Tujuan'].'</th>
        <td>Rp. '.$data['Harga_rute'].'</th>
       </tr>
       <tr>
        <td>2</th>
        <td align="left" >Harga Sewa Mobil dengan Jenis '.$data['Jenis_mobil'].' berwarna '.$data['Warna_mobil'].'</th>
        <td>Rp. '.$data['Harga_sewa_mobil'].'</th>
       </tr>
       <tr>
        <td>3</th>
        <td align="left" >Harga Denda dengan Waktu Peminjaman '.$data['Waktu_peminjaman'].' dan Waktu Pengembalian '.$data['Waktu_pengembalian'].'</th>
        <td>Rp. '.$data['denda'].'</th>
       </tr>
       <tr>
        <td align="center" colspan="2"><b>Total</b></td>
        <td ><b>Rp. '.$data["total_harga"].'</b></td>
       </tr>
    </table>
</table>
<div align="right" >
    <br><br><br><br><br><br>
    <p>PT. Rental Mobil</p>
</div>';
};

$pdf = new Pdf();
$file_name = 'Invoice-'.$id.'.pdf';
$pdf->loadHtml($output);
$pdf->render();
$pdf->stream($file_name, array("Attachment" => false));
?>