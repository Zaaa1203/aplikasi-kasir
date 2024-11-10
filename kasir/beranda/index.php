<?php
session_start();
 
	// cek apakah yang mengakses halaman ini sudah login
	if($_SESSION['level']==""){
		header("location:../index.php?pesan=gagal");
	}
    ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Minimarket</title>
    <link rel="icon" type="image" href="../../img/minimarket.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="../../style.css">
    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css" />
   </head>
<body>
<?php include "../header_petugas.php" ?>
<main class="container border py-3">
<br><br><br>
<?php
// Koneksi ke database
include "../../config.php";

// Query untuk mengambil data penjualan
$sql = "SELECT tanggal, total_harga FROM penjualan ORDER BY tanggal";
$result = $koneksi->query($sql);

$tanggal = [];
$total_harga = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $tanggal[] = $row['tanggal'];
        $total_harga[] = $row['total_harga'];
    }
} 
$koneksi->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="myChart"></canvas>
    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($tanggal); ?>,
                datasets: [{
                    label: 'Total Harga',
                    data: <?php echo json_encode($total_harga); ?>,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: true,
                    tension: 0.1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>


<script src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>