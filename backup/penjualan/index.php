<?php
session_start();
 
	// cek apakah yang mengakses halaman ini sudah login
	if($_SESSION['level']==""){
		header("location:../index.php?pesan=gagal");
	}
    $id_petugas = $_SESSION['id_petugas'];
$level = $_SESSION['level'];  // Menyimpan level pengguna (admin atau petugas)
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<title>Minimarket</title>
    <link rel="icon" type="image" href="../../img/minimarket.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="../../style.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css" />
</head>
<body>
<?php include "../header_petugas.php" ?>
<main class="container border py-3">
<br><br><br>
<!-- pencarian -->

	<div class="row">
			<div class="col-sm-8"><h3>Daftar Penjualan</h3></div>
			<div class="col-sm-4">
					<form class="d-flex" method="GET" action="">
					<input class="form-control me-2" type="date" name="tgl" value="<?= date('Y-m-d') ?>">
        	<button class="btn btn-primary" type="submit"><i class='bx bx-search-alt'>Cari</button></i>
      </form>
			</div>
	</div>

<!-- akhir pencarian -->

<table class="table table-hover table-striped table-sm">
	<thead class="bg-primary text-white">
		<tr>
			<th class="py-2 px-3 rounded-start" width="55px">No.</th>
			<th class="py-2" width="200px">Tanggal</th>
			<th class="py-2 text-end" width="100px">Total Harga</th>
			<th class="py-2 text-end" width="100px">Bayar</th>
			<th class="py-2 text-end" width="100px">Kembali</th>
			<th class="py-2 px-3" width="200px">Pelanggan</th>
			<th class="py-2" width="200px">Petugas</th>
			<th class="py-2 text-center rounded-end" width="150px">Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php  
		include "../../config.php";
		$id_petugas=$_SESSION['id_petugas'];
		$batas = 10;
		$halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
		$halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;	

		$previous = $halaman - 1;
		$next = $halaman + 1;
		$tglskr=date("Y-m-d");
		if(isset($_GET['tgl'])){
			$tgl=$_GET['tgl'];
			$sqldata="select * from penjualan where tanggal like '$tgl%' and id_petugas='$id_petugas'";
		}else{
			$sqldata="select * from penjualan where tanggal like '$tglskr%' and id_petugas='$id_petugas'";
		}
		$resdata=mysqli_query($koneksi,$sqldata);
		$jumlah_data = mysqli_num_rows($resdata);
		$total_halaman = ceil($jumlah_data / $batas);

		if(isset($_GET['tgl'])){
			$tgl=$_GET['tgl'];
			$sql="select * from penjualan where tanggal like '$tgl%' and id_petugas='$id_petugas' limit $halaman_awal, $batas";
		}else{
			$sql="select * from penjualan where tanggal like '$tglskr%' and id_petugas='$id_petugas' limit $halaman_awal, $batas";
		}

        $result = mysqli_query($koneksi, $sql);
        $no = $halaman_awal + 1;
        while ($data = mysqli_fetch_array($result)) {
            $tohar = number_format($data['total_harga'], 0, ",", ".");
            $byr = number_format($data['bayar'], 0, ",", ".");
            $kembali = $data['bayar'] - $data['total_harga'];
            $kbl = number_format($kembali, 0, ",", ".");

            // Handle pelanggan - if id_pelanggan is empty or null
            $id_pelanggan = isset($data['id_pelanggan']) ? $data['id_pelanggan'] : null;
            if ($id_pelanggan) {
                // Ambil data pelanggan
                $sqlpelanggan = "SELECT * FROM pelanggan WHERE id_pelanggan='$id_pelanggan'";
                $respelanggan = mysqli_query($koneksi, $sqlpelanggan);
                $dtpelanggan = mysqli_fetch_array($respelanggan);
                $nama_pelanggan = $dtpelanggan['nama_pelanggan'];
            } else {
                $nama_pelanggan = "No Customer";  // Default text when customer is not set
            }

            // Ambil data petugas
            $sqlpetugas = "SELECT * FROM petugas WHERE id_petugas='$id_petugas'";
            $respetugas = mysqli_query($koneksi, $sqlpetugas);
            $dtpetugas = mysqli_fetch_array($respetugas);
        ?>
        <tr>
            <td class="px-3"><?= $no ?>.</td>
            <td><?= $data['tanggal'] ?></td>
            <td align="right"><?= $tohar ?></td>
            <td align="right"><?= $byr ?></td>
            <td align="right"><?= $kbl ?></td>
            <td class="px-3"><?= $nama_pelanggan ?></td>
            <td><?= $dtpetugas['nama_petugas'] ?></td>
			<td align="right">
					<a href="printnota.php?penid=<?= $data['penjualan_id'] ?>&kbl=<?= $kbl ?>" target="blank" class="btn btn-secondary btn-sm"><i class='bx bx-printer'></i>Cetak Nota</a>
					<a href="detail_penjualan.php?penid=<?= $data['penjualan_id'] ?>&npet=<?= $dtpetugas['nama_petugas'] ?>&tgl=<?= $data['tanggal'] ?>&byr=<?= $byr ?>&kbl=<?= $kbl ?>&halaman=<?= $halaman ?>" class="btn btn-primary btn-sm"><i class='bx bxs-detail'></i>Detail</a>
				</td>
        </tr>

<!-- Modal Edit -->
<div class="modal fade" id="modaledit<?= $data['penjualan_id'] ?>">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h3 class="modal-title">Edit Data Produk</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <div class="row my-1">
        	<div class="col-12">
        		
        	</div>
        	
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      	<button type="submit" class="btn btn-primary" name="save">Simpan</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
      </div>
    </form>
    </div>
  </div>
</div>

<!-- akhir modal Edit -->

		<?php  
		$no++;
		}
		?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="7" class="text-center">
				<div class="container">
					<div class="row">
						<div class="col-4 text-start py-3">

							<a class="btn btn-primary" href="penjualan_simpan.php">[+] Penjualan Baru</a>						
						</div>
						<div class="col-8 text-end py-3">

						<!-- Untuk nomor Halaman -->
							<ul class="pagination justify-content-end pagination-sm">
								<li class="page-item"><a class="page-link" <?php if($halaman > 1){ echo "href='?halaman=$previous'"; } ?>>&laquo; Previous</a></li>
								
								<?php 
								for($x=1;$x<=$total_halaman;$x++){
									if($x==$halaman){
								?>
									<li class="page-item active"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
								<?php
									}else{
								?> 
									<li class="page-item"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
								<?php
									}
								}
								?>				
								<li class="page-item"><a class="page-link" <?php if($halaman < $total_halaman) { echo "href='?halaman=$next'"; } ?>>Next &raquo;</a></li>
							</ul>				
						</div>
					</div>
				</div>
							
			</td>
		</tr>
	</tfoot>
</table>
</div>
<!-- Modal Form -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h3 class="modal-title">Input Data Produk</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form method="POST" action="simpan.php?halaman=<?= $halaman ?>">
      <!-- Modal body -->
      <div class="modal-body">
        <div class="row my-1">
        	<div class="col-4">

<!-- akhir modal Form -->
</main>
<script src="../../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>