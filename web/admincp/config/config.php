<?php 
	//kết nối database//
	$mysqli = new mysqli("localhost","root","","quanlydathang");

	// Kiểm tra kết nối //
	if ($mysqli->connect_errno) {
	  echo "Kết nối MYSQLi lỗi" . $mysqli->connect_error;
	  exit();
	}

?>