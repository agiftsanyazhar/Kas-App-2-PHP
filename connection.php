<?php

define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DB', 'kas-app-2');
$conn = mysqli_connect(HOST, USER, PASS, DB) or die('Unable to Connect');

date_default_timezone_set("Asia/Jakarta");
