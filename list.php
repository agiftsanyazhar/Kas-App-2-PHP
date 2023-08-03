<?php
require_once('connection.php');

$query = mysqli_query(
	$conn,
	"SELECT * FROM transaksi ORDER BY transaksi_id DESC"
);

$result = array();
while ($row = mysqli_fetch_array($query)) {
	array_push($result, array(
		'transaksi_id'	=> $row['transaksi_id'],
		'status'		=> $row['status'],
		'jumlah'		=> $row['jumlah'],
		'keterangan'	=> $row['keterangan'],
		'tanggal'		=> date("d/m/Y", strtotime($row['tanggal'])),
		'tanggal2'		=> $row['tanggal']
	));
}

$query = mysqli_query(
	$conn,
	"SELECT (SELECT COUNT(transaksi_id) AS counts FROM transaksi) AS total_transaksi, (SELECT SUM(jumlah) FROM transaksi WHERE status='MASUK') AS masuk, (SELECT SUM(jumlah) FROM transaksi WHERE status='KELUAR') AS keluar"
);

while ($row = mysqli_fetch_assoc($query)) {

	$total	= $row['total_transaksi'];
	$masuk 	= $row['masuk'];
	$keluar	= $row['keluar'];
}


echo json_encode(array(
	'total'		=> $total,
	'masuk'		=> $masuk 	== null ? 0 : $masuk,
	'keluar'	=> $keluar 	== null ? 0 : $keluar,
	'saldo'		=> ($masuk - $keluar),
	'result'	=> $result
), JSON_NUMERIC_CHECK);

mysqli_close($conn);
