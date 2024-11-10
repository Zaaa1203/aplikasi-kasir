<?php 
$koneksi=mysqli_connect("localhost","root","");
//$koneksi=mysqli_connect("localhost:3306","root","root");
$db=mysqli_select_db($koneksi,"kasir_kel5");
date_default_timezone_set('Asia/Jakarta');
?>