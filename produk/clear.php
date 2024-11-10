<?php
include "../config.php";
$sql="delete from produk";
$hapus=mysqli_query($koneksi,$sql);
header("location:index.php");
?>