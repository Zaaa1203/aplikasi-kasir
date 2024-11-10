<?php  
session_start();
if (isset($_POST['save'])) {
    $kp = $_POST['kp']; // Product code
    $jp = $_POST['jp']; // Quantity
    $penid = $_SESSION['penid']; // Transaction ID
    include "../../config.php";

    // Fetch product information
    $sqlpr = "SELECT * FROM produk WHERE kode_produk=?";
    $stmt = mysqli_prepare($koneksi, $sqlpr);
    mysqli_stmt_bind_param($stmt, 's', $kp);
    mysqli_stmt_execute($stmt);
    $respr = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_array($respr);
    $stokawal = $data['stok'];

    // Calculate total quantity sold for this product
    $sqlst = "SELECT COALESCE(SUM(jumlah), 0) as total_jumlah FROM detail_penjualan WHERE kode_produk=?";
    $stmt = mysqli_prepare($koneksi, $sqlst);
    mysqli_stmt_bind_param($stmt, 's', $kp);
    mysqli_stmt_execute($stmt);
    $resst = mysqli_stmt_get_result($stmt);
    $jmlst = mysqli_fetch_array($resst)['total_jumlah'];

    // Calculate additional stock added
    $sqltp = "SELECT COALESCE(SUM(jumlah), 0) as total_tambah FROM tambah_stok WHERE kode_produk=?";
    $stmt = mysqli_prepare($koneksi, $sqltp);
    mysqli_stmt_bind_param($stmt, 's', $kp);
    mysqli_stmt_execute($stmt);
    $restp = mysqli_stmt_get_result($stmt);
    $jmltp = mysqli_fetch_array($restp)['total_tambah'];

    // Calculate final stock after sales and restocks
    $stokakhir = $stokawal - $jmlst + $jmltp;
    $sp = number_format($stokakhir, 0, ",", ".");

    // Check if quantity is valid
    if ($jp > $stokakhir) {
        echo "<script>alert('Stok Produk tinggal $sp! Jumlah penjualan tidak boleh lebih dari $sp.')</script>";
    } elseif ($jp <= 0) {
        echo "<script>alert('Jumlah Penjualan tidak boleh kurang dari 1.')</script>";
    } else {
        // Check if the product already exists in detail_penjualan for this session
        $sqlCheck = "SELECT * FROM detail_penjualan WHERE kode_produk=? AND penjualan_id=?";
        $stmt = mysqli_prepare($koneksi, $sqlCheck);
        mysqli_stmt_bind_param($stmt, 'si', $kp, $penid);
        mysqli_stmt_execute($stmt);
        $restr = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($restr) > 0) {
            // Product exists, update the quantity
            $dtr = mysqli_fetch_array($restr);
            $new_jumlah = $jp + $dtr['jumlah']; // Add new quantity to the existing quantity

            // Check if the updated quantity exceeds stock
            if ($new_jumlah <= $stokakhir) {
                $sqlUpdate = "UPDATE detail_penjualan SET jumlah=? WHERE kode_produk=? AND penjualan_id=?";
                $stmt = mysqli_prepare($koneksi, $sqlUpdate);
                mysqli_stmt_bind_param($stmt, 'isi', $new_jumlah, $kp, $penid);
                mysqli_stmt_execute($stmt);
            } else {
                // If new quantity exceeds stock, show an alert
                echo "<script>alert('Stok Produk tinggal $sp! Jumlah penjualan tidak boleh lebih dari $sp.')</script>";
            }
        } else {
            // If the product doesn't exist in the transaction, insert it
            $np = $data['nama_produk'];
            $hp = $data['harga'];
            $sqlInsert = "INSERT INTO detail_penjualan (kode_produk, nama_produk, harga, jumlah, penjualan_id) VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($koneksi, $sqlInsert);
            mysqli_stmt_bind_param($stmt, 'ssiii', $kp, $np, $hp, $jp, $penid);
            mysqli_stmt_execute($stmt);
        }
    }
}
?>
<meta http-equiv="refresh" content="1;url=transaksi.php">  <!-- Auto-redirect after save -->
