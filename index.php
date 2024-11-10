<!DOCTYPE html>
<html>
	
<?php 
//alert gagal login/tidak sesuai user dan password
	if(isset($_GET['pesan'])){
		if($_GET['pesan']=="gagal"){
			echo "<div class='alert'>Username dan Password tidak sesuai !</div>";
		}
	}
	?>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Minimarket</title>
    <link rel="icon" type="image" href="img/minimarket.png">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body class="backimg">
<div class="redup"></div>
<div class="window">
<div align="center">
	<div class="kotak_login" align="center">
		<div align="center"><img src="img/minimarket.png" width="170px">
	
		</div><br>
<form class="login" method="POST" action="login_proses.php">
<h2>Silahkan Login</h2>
	<label>Username</label><br>
	<input type="text" name="username" placeholder="User Name" autocomplete="off"><br>
	<label>Username</label><br>
	<input type="password" name="password" placeholder="Password" id="myInput"><br>
	<input type="checkbox" onclick="myFunction()"> <label style="color:#808080;">Show Password</label>
	<input type="submit" value="LOGIN">
</form>
<center>
				<a class="bg-primary" href="https://g.co/kgs/8GZHDxn">kembali</a>
			</center>	
<br>
</div>

</div>
<script>
function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
<small>Copyright &copy <?= date("Y") ?> By.</small> <a href="" class="bg-warning">Kelompok 5</a>
</body>
</html>