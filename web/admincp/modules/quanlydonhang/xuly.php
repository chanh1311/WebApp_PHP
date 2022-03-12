<?php
	session_start();
	include('../../config/config.php');//kết nối database//
	
	if(isset($_GET['madonhang'])){
		// Khi người Nhân Viên Bấm xác nhận đơn hàng //
		$code_cart = $_GET['madonhang'];
		$nv_xacnhan = $_SESSION['dangnhap'];
		//trạng thái đơn hàng và msnv được cập nhật vào bảng //
		$sql_update ="UPDATE dathang SET TrangThai=0,MSNV='".$nv_xacnhan."' WHERE SoDonDH='".$code_cart."'";
		$query = mysqli_query($mysqli,$sql_update);
		header('Location:../../index.php?action=quanlydonhang&query=lietke');
	} 
?>