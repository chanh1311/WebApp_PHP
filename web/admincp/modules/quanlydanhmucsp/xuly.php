<?php
include('../../config/config.php');
//chèn file kết nối database //
$tenloaisp = $_POST['tenloaihang']; //lấy từ trang index (Thêm Loại Sản Phẩm)
$maloaihang = $_POST['maloaihang'];
if(isset($_POST['themdanhmuc'])){
	//them
	if($tenloaisp == "" ||$maloaihang == ""){
		//kt rỗng//
		echo '<script language="javascript">alert("Vui lòng nhập đầy đủ thông tin!"); window.location="xuly.php";</script>';
	}else{
		//thêm vào database//
		$sql_them = "INSERT INTO LoaiHangHoa(MaLoaiHang,TenLoaiHang) VALUE('".$maloaihang."','".$tenloaisp."')";
		mysqli_query($mysqli,$sql_them);
		header('Location:../../index.php?action=quanlydanhmucsanpham&query=them');
	}
}elseif(isset($_POST['suadanhmuc'])){
	//sua
	$sql_update = "UPDATE loaihanghoa SET TenLoaiHang='".$tenloaisp."' WHERE MaLoaiHang='$_GET[maloaihang]'";
	mysqli_query($mysqli,$sql_update);
	header('Location:../../index.php?action=quanlydanhmucsanpham&query=them');
}else{
	//xoa
	$id=$_GET['maloaihang'];
	$sql_xoa = "DELETE FROM LoaiHangHoa WHERE MaLoaiHang='".$id."'";
	mysqli_query($mysqli,$sql_xoa);
	header('Location:../../index.php?action=quanlydanhmucsanpham&query=them');
}

?>