<?php
require_once('connection.php');

$status		= $_REQUEST['status'];
$jumlah		= $_REQUEST['jumlah'];
$keterangan	= $_REQUEST['keterangan'];
$tanggal	= date('Y-m-d');

// insert comment
$query = mysqli_query($conn, "INSERT INTO transaksi (status, jumlah, keterangan, tanggal) VALUES ('$status', '$jumlah', '$keterangan', '$tanggal') ");

if ($query) {
	echo json_encode(array('response' => 'success'));
} else {
	echo json_encode(array('response' => 'failed'));
}
