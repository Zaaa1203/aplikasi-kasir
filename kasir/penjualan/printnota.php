<?php  
session_start();
if(isset($_GET['penid'])){
$penid=$_GET['penid'];
$kbl=$_GET['kbl'];
include "../../config.php";
$sqlpenjualan="select * from penjualan where penjualan_id='$penid'";
$respenjualan=mysqli_query($koneksi,$sqlpenjualan);
$dtpenjualan=mysqli_fetch_array($respenjualan);
$tgl=$dtpenjualan['tanggal'];
$bayar=$dtpenjualan['bayar'];
$nbayar=number_format($bayar,0,",",".");

$id_petugas=$dtpenjualan['id_petugas'];
$sqlpetugas="select * from petugas where id_petugas='$id_petugas'";
$respetugas=mysqli_query($koneksi,$sqlpetugas);
$dtpetugas=mysqli_fetch_array($respetugas);
$npet=$dtpetugas['nama_petugas'];
?>
<!DOCTYPE html>
<html>
<head>
<title>Minimarket</title>
<link rel="icon" type="image" href="../../img/minimarket.png">
	<!-- <link rel="stylesheet" type="text/css" href="../style.css"> -->
	<link rel="stylesheet" href="print.css?time=<?= md5(time()) ?>">
</head>
<body class="struk" onload="printOut()">
<section class="sheet">
<center>
	<br>
	<img src="../../img/minimarket.png" width="60px">
	<h1 style="margin:0px">Minimarket</h1>
	Jl. Siliwangi No. 30 Kadipaten Majalengka<br>
	Telp. 082122354533 <br>
	<td style="padding:5px 5px;">Tgl : <?= $tgl ?></td>
</center>
<?php echo str_repeat("=", 57) ?>
<table width="100%" cellspacing="0">
	<tr>
		
	</tr>
	<tr>
		<td  style="padding:2px 5px;">Penjualan ID : <?= $penid ?></td>
	</tr>
	<tr>
		<td  style="padding:2px 5px;">Kasir : <?= $npet ?></td>
	</tr>
</table>
<?php echo str_repeat("-", 57) ?>
<table width="100%" cellspacing="0">
	<?php 
	include "../../config.php";
	$sql="select * from detail_penjualan where penjualan_id='$penid'";
	$result=mysqli_query($koneksi,$sql);
	$no= 1;
	$jmltot=0;
	while($data=mysqli_fetch_array($result)){
		$hp=number_format($data['harga'],0,",",".");
		$jp=number_format($data['jumlah'],0,",",".");
		$total=$data['harga']*$data['jumlah'];
		$tot=number_format($total,0,",",".");
	?>
		<tr>
			<td  valign="top" style="padding:5px;">
				<?= $no ?>.
			</td>
			<td valign="top" style="padding:5px 2px; width:180px">
				<?= $jp ?> <?= $data['nama_produk'] ?> Rp <?= $hp ?>		
			</td>
			<td align="right" valign="top" style="padding:5px; width:60px">Rp<?= $tot ?></td>
		</tr>
	<?php
	$no++;
	$jmltot=$jmltot+$total;
	$jmltotal=number_format($jmltot,0,",",".");
	}
	?>
</table>
<table width="100%" cellspacing="0">
		<tr>
			<td colspan="3">
				<?= str_repeat("-", 57) ?>
			</td>
		</tr>
		<tr>
			<td align="right" style="padding:3px 3px;">Total :</td>
			<th align="right" style="font-size:10pt; padding:2px 5px;">Rp<?= $jmltotal ?></th>
		</tr>
		<tr>
			<td align="right" style="padding:5px 5px;">Bayar :</td>
			<td align="right" style="padding:4px 4px;">Rp<?= $nbayar ?></td>
		</tr>
		<tr>
			<td align="right" style="padding:5px 5px;">Kembali :</td>
			<td align="right" style="padding:5px 5px;">Rp<?= $kbl ?></td>
		</tr>
</table>
<?= str_repeat("-", 57) ?>
<br>
<center>
	<b>
Barang yang sudah dibeli tidak dapat dikembalikan <br>
harap periksa kembali pesanan anda sebelum<br>
	meninggalkan toko kami Terimakasih....
	</b>
</center>
<br/><br/><br/><br/>
<p></p>
</section>
<script>
    var lama = 1000;
    t = null;
    function printOut(){
        window.print();
        t = setTimeout("self.close()",lama);
    }
</script>
<?php }else{} ?>
</body>
</html>
