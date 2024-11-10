<?php  
if (isset($_POST['save'])) {
    $kp = $_POST['kp']; // Product code
    $jp = $_POST['jp']; // Quantity
    $id = $_POST['id']; // Detail ID (for existing entry)
    include "../../config.php";

    // Fetch product information
    $sqlpr = "SELECT stok FROM produk WHERE kode_produk=?";
    $stmt = mysqli_prepare($koneksi, $sqlpr);
    mysqli_stmt_bind_param($stmt, 's', $kp);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $stokawal);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // Calculate total quantity sold for this product
    $sqlst = "SELECT COALESCE(SUM(jumlah), 0) as total_jumlah FROM detail_penjualan WHERE kode_produk=?";
    $stmt = mysqli_prepare($koneksi, $sqlst);
    mysqli_stmt_bind_param($stmt, 's', $kp);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $jmlst);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // Calculate additional stock added
    $sqltp = "SELECT COALESCE(SUM(jumlah), 0) as total_tambah FROM tambah_stok WHERE kode_produk=?";
    $stmt = mysqli_prepare($koneksi, $sqltp);
    mysqli_stmt_bind_param($stmt, 's', $kp);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $jmltp);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // Final stock calculation
    $stokakhir = $stokawal - $jmlst + $jmltp;

    // Check for existing entry in the cart
    $sqltr = "SELECT * FROM detail_penjualan WHERE detail_id=? AND kode_produk=?";
    $stmt = mysqli_prepare($koneksi, $sqltr);
    mysqli_stmt_bind_param($stmt, 'is', $id, $kp);
    mysqli_stmt_execute($stmt);
    $restr = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($restr) > 0) {
        // Update the quantity of the existing entry
        $dtr = mysqli_fetch_array($restr);
        $jmbr = $dtr['jumlah']; // Previous quantity
        $new_jumlah = $jp + $jmbr; // New quantity

        if ($new_jumlah > $stokakhir) {
            $sp = number_format($stokakhir, 0, ",", ".");
            echo "<script>alert('Stok Produk tinggal $sp! Jumlah penjualan tidak boleh lebih dari $sp.')</script>";
        } else {
            // Update the quantity in the detail_penjualan table
            $sqle = "UPDATE detail_penjualan SET jumlah=? WHERE detail_id=?";
            $stmt = mysqli_prepare($koneksi, $sqle);
            mysqli_stmt_bind_param($stmt, 'ii', $new_jumlah, $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    } else {
        // Check if we can add a new entry
        if ($jp > $stokakhir) {
            $sp = number_format($stokakhir, 0, ",", ".");
            echo "<script>alert('Stok Produk tinggal $sp! Jumlah penjualan tidak boleh lebih dari $sp.')</script>";
        } elseif ($jp <= 0) {
            echo "<script>alert('Jumlah Penjualan tidak boleh kurang dari 1.')</script>";
        } else {
            $sqle = "INSERT INTO detail_penjualan (kode_produk, jumlah) VALUES (?, ?)";
            $stmt = mysqli_prepare($koneksi, $sqle);
            mysqli_stmt_bind_param($stmt, 'si', $kp, $jp);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }

    // Redirect after processing
    header("Location: transaksi.php");
    exit();
}
?>
