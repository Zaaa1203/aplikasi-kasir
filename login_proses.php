<?php 
// mengaktifkan session pada php
session_start();

 
// menghubungkan php dengan koneksi database
include 'config.php';
 
// menangkap data yang dikirim dari form login
$username=stripslashes(strip_tags(htmlspecialchars($_POST['username'],ENT_QUOTES)));
$password=stripslashes(strip_tags(htmlspecialchars($_POST['password'],ENT_QUOTES)));

 
 
// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($koneksi,"select * from petugas where username='$username' and password='$password'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);
 
// cek apakah username dan password di temukan pada database
if($cek > 0){
 
	$data = mysqli_fetch_assoc($login);
 
	// cek jika user login sebagai admin
	if($data['level']=="admin"){
 
		// buat session login dan username
		$_SESSION['username']=$data['username'];
		$_SESSION['password']=$data['password'];
		$_SESSION['level']=$data['level'];
		$_SESSION['nama_petugas']=$data['nama_petugas'];
		$_SESSION['id_petugas']=$data['id_petugas'];
		// alihkan ke halaman dashboard admin
		header("location:beranda/index.php");
 
	// cek jika user login sebagai pegawai
	}else if($data['level']=="petugas"){
		// buat session login dan username
		$_SESSION['username']=$data['username'];
		$_SESSION['password']=$data['password'];
		$_SESSION['level']=$data['level'];
		$_SESSION['nama_petugas']=$data['nama_petugas'];
		$_SESSION['id_petugas']=$data['id_petugas'];
		// alihkan ke halaman dashboard petugas
		header("location:kasir/beranda/index.php");
 
	}else{
 
		// alihkan ke halaman login kembali
		header("location:index.php?pesan=gagal");
	}	
}else{
	header("location:index.php?pesan=gagal");
}
 
