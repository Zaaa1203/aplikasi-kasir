
     <head>
    <title>Minimarket</title>
    <link rel="icon" type="image" href="../../img/minimarket.png">
<link rel="stylesheet" href="style.css">
    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" />
   </head>
<body>
  <div class="sidebar close">
    <div class="logo-details">
      <i class='bx bxs-user-circle'></i>
      
      <span class="logo_name">Hallo <b><?php echo $_SESSION['nama_petugas']; ?></b><br>
<span class="user_role" style="font-size: 12px; color: white;"> Anda Adalah Petugas</span>
      
    </div>
    
    <ul class="nav-links">
      <li>
        <a href="../../kasir/beranda/index.php">
          <i class='bx bx-grid-alt' ></i>
          <span class="link_name">Beranda</span>
          
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="beranda/index.php">Beranda</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="../../kasir/penjualan/index.php">
            <i class='bx bx-wallet' ></i>
            <span class="link_name">Transaksi</span>
          </a>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Transaksi</a></li>
        </ul>
      </li>
      <li>
        <a href="../report/index.php">
          <i class='bx bxs-report' ></i>
          <span class="link_name">Laporan</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Laporan</a></li>
        </ul>
      </li>
      <li>
      <li>
    <div class="profile-details">
     
      <div class="name-job">
      
      </div>
      <a href="../../index.php">
      <i class='bx bx-log-out' title='Logout'></i>
      </a>
    </div>
  </li>
</ul>
</div>
  </div>
  <section class="home-section">  
    <div class="home-content">
      <i class='bx bx-menu' ></i>
      <span class="text">Minimarket</span><img src="../../img/minimarket.png" width="70px">    
  </div>
  <script>
    //fungsi sidebar/navbar
  let arrow = document.querySelectorAll(".arrow");
  for (var i = 0; i < arrow.length; i++) {
    arrow[i].addEventListener("click", (e)=>{
   let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
   arrowParent.classList.toggle("showMenu");
    });
  }
  let sidebar = document.querySelector(".sidebar");
  let sidebarBtn = document.querySelector(".bx-menu");
  console.log(sidebarBtn);
  sidebarBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("close");
  });
  </script>
</body>
</html>
