<?php
include('../../config/config.php');

$tensanpham = $_POST['tenhang'];
$masp = $_POST['masohang'];
$giasp = $_POST['gia'];
$soluong = $_POST['soluong'];
//xuly hinh anh
$hinhanh = $_FILES['hinhanh']['name'];
$hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
$hinhanh = time().'_'.$hinhanh;
//
$quycach = $_POST['quycach'];
$tinhtrang = $_POST['tinhtrang'];
$loaihang = $_POST['loaihanghoa'];
$ghichu = $_POST['ghichu'];

if(isset($_POST['themsanpham'])){
	//them
	if($tensanpham == "" ||$masp == ""||$giasp == "" ||$soluong == ""||$quycach == ""){
		echo '<script language="javascript">alert("Vui lòng nhập đầy đủ thông tin!"); window.location="xuly.php";</script>';
	}else{
	$sql_them = "INSERT INTO hanghoa(TenHH,MSHH,Gia,SoLuong,hinhanh,QuyCach,TinhTrang,MaLoaiHang,GhiChu) VALUE('".$tensanpham."','".$masp."','".$giasp."','".$soluong."','".$hinhanh."','".$quycach."','".$tinhtrang."','".$loaihang."','".$ghichu."')";
	mysqli_query($mysqli,$sql_them);
	move_uploaded_file($hinhanh_tmp,'uploads/'.$hinhanh);
	header('Location:../../index.php?action=quanlysp&query=them');}
}elseif(isset($_POST['suasanpham'])){
	//sua
	if($hinhanh!=''){
		// Nếu đã có hình ảnh thì đưa ảnh mới vào //
		move_uploaded_file($hinhanh_tmp,'uploads/'.$hinhanh); 
		
		$sql_update = "UPDATE hanghoa SET TenHH='".$tensanpham."',MSHH='".$masp."',Gia='".$giasp."',SoLuong='".$soluong."',hinhanh='".$hinhanh."',QuyCach='".$quycach."',TinhTrang='".$tinhtrang."',MaLoaiHang='".$loaihang."' WHERE MSHH='$_GET[masohang]'";
		//Xóa hình ảnh cũ //
		$sql = "SELECT * FROM hanghoa WHERE MSHH = '$_GET[masohang]' LIMIT 1";
		$query = mysqli_query($mysqli,$sql);
		while($row = mysqli_fetch_array($query)){
			unlink('uploads/'.$row['hinhanh']);
		}

	}else{ //Chưa có ảnh chỉ cần thêm //
		$sql_update = "UPDATE hanghoa SET TenHH='".$tensanpham."',MSHH='".$masp."',Gia='".$giasp."',SoLuong='".$soluong."',QuyCach='".$quycach."',TinhTrang='".$tinhtrang."',MaLoaiHang='".$loaihang."' WHERE MSHH='$_GET[masohang]'";
	}
	mysqli_query($mysqli,$sql_update);
		header('Location:../../index.php?action=quanlysp&query=them');
}else{ //xóa hàng hóa//
	$id=$_GET['masohang'];
	$sql = "SELECT * FROM hanghoa WHERE MSHH = '$id' LIMIT 1";
	$query = mysqli_query($mysqli,$sql);
	//xóa ảnh//
	while($row = mysqli_fetch_array($query)){
		unlink('uploads/'.$row['hinhanh']);
	}
	$sql_xoa = "DELETE FROM hanghoa WHERE MSHH='".$id."'";
	mysqli_query($mysqli,$sql_xoa);
	header('Location:../../index.php?action=quanlysp&query=them');
}

?>