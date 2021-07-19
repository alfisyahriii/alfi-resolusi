<?php
	session_start();
	$conn = mysqli_connect("localhost","root","","stokbarang");

	if (isset($_POST['addnewbarang'])) {
		$namabarang = $_POST['namabarang'];
		$deskripsi = $_POST['deskripsi'];
		$stok = $_POST['stok'];

		$addtotable = mysqli_query($conn, "insert into stok (namabarang, deskripsi, stok) values('$namabarang','$deskripsi','$stok')");

		if ($addtotable) {
			header('location:index.php');
		}else{
			echo 'gagal';
			header('location:index.php');
		}
	};

	if (isset($_POST['barangmasuk'])) {
		$barangnya = $_POST['barangnya'];
		$penerima = $_POST['penerima'];
		$qty = $_POST['qty'];

		$cekstoksekarang= mysqli_query($conn,"select * from stok where idbarang='$barangnya'");
		$ambildatanya = mysqli_fetch_array($cekstoksekarang);

		$stoksekarang = $ambildatanya['stok'];
		$tambahkanstoksekarangdenganquantity = $stoksekarang+$qty;

		$addtomasuk = mysqli_query($conn, "insert into masuk (idbarang, keterangan, qty) values('$barangnya','$penerima','$qty')");
		$updatestokmasuk = mysqli_query($conn,"update stok set stok='$tambahkanstoksekarangdenganquantity' where idbarang='$barangnya'");

		if ($addtomasuk&&$updatestokmasuk) {
			header('location:index.php');
		}else{
			echo 'gagal';
			header('location:index.php');
		}
	};


	if (isset($_POST['addbarangkeluar'])) {
		$barangnya = $_POST['barangnya'];
		$penerima = $_POST['penerima'];
		$qty = $_POST['qty'];

		$cekstoksekarang= mysqli_query($conn,"select * from stok where idbarang='$barangnya'");
		$ambildatanya = mysqli_fetch_array($cekstoksekarang);

		$stoksekarang = $ambildatanya['stok'];
		$tambahkanstoksekarangdenganquantity = $stoksekarang-$qty;

		$addtokeluar = mysqli_query($conn, "insert into keluar (idbarang, penerima, qty) values('$barangnya','$penerima','$qty')");
		$updatestokmasuk = mysqli_query($conn,"update stok set stok='$tambahkanstoksekarangdenganquantity' where idbarang='$barangnya'");

		if ($addtokeluar&&$updatestokmasuk) {
			header('location:keluar.php');
		}else{
			echo 'gagal';
			header('location:keluar.php');
		}
	};

?>