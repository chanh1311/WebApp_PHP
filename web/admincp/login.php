<?php
	session_start();
	include('config/config.php'); //chèn file kết nối vào//
	//kiểm tra tài khoản đăng nhập admin//
	if(isset($_POST['dangnhap'])){
		$taikhoan = $_POST['manhanvien'];
		$matkhau = md5($_POST['password']);
		$sql = "SELECT * FROM nhanvien  WHERE MSNV='".$taikhoan."' AND matkhaunv='".$matkhau."' LIMIT 1";
		$row = mysqli_query($mysqli,$sql);
		$count = mysqli_num_rows($row);
		
		if($count>0){
			$_SESSION['dangnhap'] = $taikhoan;
			header("Location:index.php"); //đăng nhập thành công trả về trang chủ//
		}else{
			echo '<script language="javascript">alert("Tài khoản hoặc mật khẩu không đúng!"); window.location="login.php";</script>';
			//ngược lại in ra dòng này và trả về trang login//
		}
	} 
?>
<!DOCTYPE html>
<html lang="en"> <!-- Định dạng ngôn ngữ cho thẻ -->
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Thiết lập hiển thị cho trang web -->
	<title>Đăng nhập Admincp</title>
	<style type="text/css"> <!-- Định dạng css -->
		body{
			background:#f2f2f2;
		}
		.wrapper-login {
		    width: 20%;
		    margin: 0 auto;
		}
		table.table-login {
		    width: 100%;
			background:white;
		}
		table.table-login tr td {
		    padding: 5px;
			
		}
	</style>
</head>
<body> <!-- nội dung trang login -->
<div class="wrapper-login">
	<form action="" autocomplete="off" method="POST">
		<table border="1" class="table-login" style="text-align: center;border-collapse: collapse;">
			<tr>
				<td colspan="2" bgcolor='#99FFFF' ><h3>Đăng nhập Admin</h3></td>
			</tr>
			<tr>
				<td><b>Tài Khoản</b></td>
				<td><input type="text" name="manhanvien"></td>
			</tr>
			<tr>
				<td><b>Mật Khẩu</b></td>
				<td><input type="password" name="password"></td>
			</tr>
			<tr>
				
				<td colspan="2" bgcolor='#99FFFF'><input type="submit" name="dangnhap" value="Đăng nhập"></td>
			</tr>
	</table>
	</form>

</div>
</body>
</html>
