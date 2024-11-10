
<?php  
session_start();
if(isset($_GET['penid'])){
	$penid=$_GET['penid'];
	$npet=$_GET['npet'];	
	$tgl=$_GET['tgl'];
	$byr=$_GET['byr'];
	$kbl=$_GET['kbl'];
	$halaman=$_GET['halaman'];
?>
<html>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include "../header_petugas.php" ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" href="../../style.css">
	
</head>
<body>
<form class="d-flex" method="POST" action="simpan.php">
    <datalist id="kode_produk">
        <?php  
        include "../../config.php";
        $sqlp = "SELECT * FROM produk";
        $resp = mysqli_query($koneksi, $sqlp);
        while ($dt = mysqli_fetch_array($resp)) {
        ?>
        <option value="<?= $dt['kode_produk'] ?>"><?= $dt['nama_produk'] ?> | <?= $dt['harga'] ?></option>
        <?php
        }
        ?>
    </datalist>
</form>
<main class="container border py-3">
<br><br><br>
<div class="row py-2">
	<div class="col-4">
		<div class="row">
			<div class="col-4">Penjualan ID</div>
			<div class="col-8">: <b><?= $penid ?></b></div>
		</div>
		<div class="row">
			<div class="col-4">Tanggal</div>
			<div class="col-8">: <b><?= $tgl ?></b></div>
		</div>
	</div>
	<div class="col-4"></div>
	<div class="col-4">
		<div class="row">
			<div class="col-4">Nama Petugas</div>
			<div class="col-8">: <b><?= $npet ?></b></div>
		</div>

	</div>
</div>
<table class="table table-hover table-striped table-sm">
	<thead class="bg-primary text-white">
		<tr>
			<th class="py-2 px-3 rounded-start" width="55px">No.</th>
			<th class="py-2 px-3" width="100px">Kode</th>
			<th class="py-2">Nama Produk</th>
			<th class="py-2 text-end" width="100px">Harga</th>
			<th class="py-2 px-3 text-end" width="100px" >Jumlah</th>
			<th class="py-2 px-3 text-end rounded-end" width="100px" >Total</th>
		</tr>
	</thead>
	<tbody>
		<?php  
		include "../../config.php";
		$penid=$_GET['penid'];
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
				<td class="px-3"><?= $no ?>.</td>
				<td><?= $data['kode_produk'] ?></td>
				<td><?= $data['nama_produk'] ?></td>
				<td align="right"><?= $hp ?></td>
				<td align="right" class="px-3"><?= $jp ?></td>
				<td align="right" class="px-3"><?= $tot ?></td>
		</tr>

		<?php  
		$no++;
		$jmltot=$jmltot+$total;
		$jmltotal=number_format($jmltot,0,",",".");
		}
		?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="3" class="text-start py-1">
				<a class="btn btn-secondary btn-sm" href="index.php?halaman=<?= $halaman ?>">&laquo; Kembali</a>
			</td>
			<td class="text-start py-1">
				Total :<br>
				Bayar :<br>
				Kembali :
			</td>
			<td colspan="2" class="text-end px-3">
				<?= $jmltotal ?><br>
				<?= $byr ?><br>
				<?= $kbl ?><br>
			</td>
		</tr>
		
	</tfoot>
</table>
</main>
<script src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
<?php } ?>