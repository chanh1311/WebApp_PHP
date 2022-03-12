
<!DOCTYPE html>
<html lang="en"> <!-- Định dạng ngôn ngữ cho thẻ -->
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Thiết lập hiển thị cho trang web -->
	<title>Admincp</title>
	<link rel="stylesheet" type="text/css" href="css/styleadmincp.css"> <!-- Chèn file css -->
</head>
<?php
 session_start();
 if(!isset($_SESSION['dangnhap'])){  //nếu chưa có session đăng nhập thì đến trang login//
 	header('Location:login.php');
 } 
?>
<body>
	<h3 class="title_admin"> Trang Admin</h3>
	<div class="wrapper">
	<?php 
			include("config/config.php"); //chèn file kết nối database//
	?>
	
	<?php	//nếu đăng xuất thì xóa bỏ session đăng nhập và quay về login//
			if(isset($_GET['dangxuat'])&&$_GET['dangxuat']==1){
				unset($_SESSION['dangnhap']);
				header('Location:login.php');
			}
	?>		
			<!-- Hiển thị nút bấm đăng xuất -->
			<p id="tk"><a href="index.php?dangxuat=1">Đăng xuất : <?php if(isset($_SESSION['dangnhap'])){
				echo $_SESSION['dangnhap'];

			} ?></a></p>
			
			<!-- Menu chọn -->
			<ul class="admincp_list">
				<li><a href="index.php?action=quanlydanhmucsanpham&query=them">Quản lý danh mục sản phẩm</a></li>
				<li><a href="index.php?action=quanlysp&query=them">Quản lý sản phẩm</a></li>
				<li><a href="index.php?action=quanlydonhang&query=lietke">Quản lý đơn hàng</a></li>
				<li><a href="index.php?action=quanlybaiviet&query=them">Quản lí đánh giá</a></li>

			</ul>
			
			<div class="clear"></div>
				<div class="main">

							<?php
								// kiểm tra biến $tam và $query được tạo hay chưa, nếu đã được tạo thì lấy giá trị bằng GET//
								if(isset($_GET['action']) && $_GET['query']){
									$tam = $_GET['action'];
									$query = $_GET['query'];
								}else{ //ngược lại gán bằng rỗng//
									$tam = '';
									$query = '';
								}
								//nếu là thêm Loại Hàng Hóa thì hiển thị cái bên dưới //
								if($tam=='quanlydanhmucsanpham' && $query=='them'){
							?>
									
									<p id = "trai">Thêm danh mục sản phẩm</p>
									<table border="1" width="50%" style="border-collapse: collapse;">
										 <form method="POST" action="modules/quanlydanhmucsp/xuly.php">
											  <tr>
												<td>Mã Loại Hàng</td>
												<td><input type="text" name="maloaihang"></td>
											  </tr>
											  <tr>
												<td>Tên Loại Hàng</td>
												<td><input type="text" name="tenloaihang"></td>
											  </tr>
											   <tr>
												<td colspan="2"><input type="submit" name="themdanhmuc" value="Thêm danh mục sản phẩm"></td>
											  </tr>
										 </form>
									</table>
									
									<!-- lấy tất cả Loại Hàng Hóa và hiển thị ra màn hình theo thứ tự giảm dần -->
									<?php
										$sql_lietke_danhmucsp = "SELECT * FROM LoaiHangHoa ORDER BY MaLoaiHang DESC";
										$query_lietke_danhmucsp = mysqli_query($mysqli,$sql_lietke_danhmucsp);
									?>
									
									<p class="giua">Liệt kê danh mục sản phẩm</p>
									<table style="width:100%" border="1" style="border-collapse: collapse;">
									  <tr>
										<th>Thứ tự</th>
										<th>Mã Loại Hàng</th>
										<th>Tên Loại Hàng</th>
										<th>Quản lý</th>
									  
									  </tr>
									  <?php
									  $i = 0;
									  while($row = mysqli_fetch_array($query_lietke_danhmucsp)){
										$i++;
									  ?>
									  <tr>
										<td><?php echo $i ?></td>
										<td><?php echo $row['MaLoaiHang'] ?></td>
										<td><?php echo $row['TenLoaiHang'] ?></td>
										<td>
											<!-- Nếu là xóa Loại Hàng Hóa thì được xuly.php xử lý, nếu là sửa thì query=sua tức là sẽ được đoạn code bên dưới xử lý -->
											<a href="modules/quanlydanhmucsp/xuly.php?maloaihang=<?php echo $row['MaLoaiHang'] ?>">Xoá</a> | <a href="?action=quanlydanhmucsanpham&query=sua&maloaihang=<?php echo $row['MaLoaiHang'] ?>">Sửa</a> 
										</td>
									   
									  </tr>
									  <?php
									  } 
									  ?>
									 
									</table>
							<?php //đây là đoạn code sửa Loại Hàng Hóa//		
								}elseif ($tam=='quanlydanhmucsanpham' && $query=='sua') {
									
								
									$sql_sua_danhmucsp = "SELECT * FROM loaihanghoa WHERE MaLoaiHang='$_GET[maloaihang]' LIMIT 1";
									$query_sua_danhmucsp = mysqli_query($mysqli,$sql_sua_danhmucsp);
							?>
								<!-- Hiển thị trang sửa tên Loại Hàng Hóa -->
									<p>Sửa danh mục sản phẩm</p>
									<table border="1" width="50%" style="border-collapse: collapse;">
										 <form method="POST" action="modules/quanlydanhmucsp/xuly.php?maloaihang=<?php echo $_GET['maloaihang'] ?>">
											<?php
											while($dong = mysqli_fetch_array($query_sua_danhmucsp)) {
											?>
											  <tr>
												<td>Tên Loại Hàng</td>
												<td><input type="text" value="<?php echo $dong['TenLoaiHang'] ?>" name="tenloaihang"></td>
											  </tr>
											   <tr>
												<td colspan="2"><input type="submit" name="suadanhmuc" value="Sửa danh mục sản phẩm"></td>
											  </tr>
											  <?php
											  } 
											  ?>

										 </form>
									</table>
							<?php		
								}elseif ($tam=='quanlysp' && $query=='them') {
									// Đây là đoạn code nếu người dùng chọn Quản Lý sản phẩm//
							?>		
									<!-- Đây là một comment -->
									<p>Thêm sản phẩm</p>
									<table border="1" width="100%" style="border-collapse: collapse;">
										 <form method="POST" action="modules/quanlysp/xuly.php" enctype="multipart/form-data">
											  <tr>
												<td>Tên Hàng Hóa</td>
												<td><input type="text" name="tenhang"></td>
											  </tr>
											   <tr>
												<td>Mã Hàng Hóa</td>
												<td><input type="text" name="masohang"></td>
											  </tr>
											  <tr>
												<td>Giá</td>
												<td><input type="text" name="gia"></td>
											  </tr>
											  <tr>
												<td>Số Lượng</td>
												<td><input type="text" name="soluong"></td>
											  </tr>
											   <tr>
												<td>Hình ảnh</td>
												<td><input type="file" name="hinhanh"></td>
											  </tr>
											  <tr>
												<td>Quy Cách</td>
												<td><textarea rows="5"  name="quycach" style="resize: none"></textarea></td>
											  </tr>
											  <tr>
												<td>Ghi Chú</td>
												<td><textarea rows="10"  name="ghichu" style="resize: none"></textarea></td>
											  </tr>
											  <tr>
												<td>Loại Hàng Hóa</td>
												<td>
													<select name="loaihanghoa">
														<?php
														$sql_loaihang = "SELECT * FROM loaihanghoa ORDER BY MaLoaiHang DESC";
														$query_loaihang = mysqli_query($mysqli,$sql_loaihang);
														while($row_loaihang = mysqli_fetch_array($query_loaihang)){
														?>
														<option value="<?php echo $row_loaihang['MaLoaiHang'] ?>"><?php echo $row_loaihang['TenLoaiHang'] ?></option>
														<?php
														} 
														?>
													</select>
												</td>
											  </tr>
											  <tr>
												<td>Tình trạng</td>
												<td>
													<select name="tinhtrang">
														<option value="1">Kích hoạt</option>
														<option value="0">Ẩn</option>
													</select>
												</td>
											  </tr>
											   <tr>
												<td colspan="2"><input type="submit" name="themsanpham" value="Thêm sản phẩm"></td>
											  </tr>
										 </form>
									</table>
									
									<!-- Đây là đoạn hiển thị tất cả sản phẩm có trong bảng hàng hóa -->
								<?php
									$sql_lietke_sp = "SELECT * FROM hanghoa,loaihanghoa WHERE hanghoa.MaLoaiHang=loaihanghoa.MaLoaiHang ORDER BY MSHH DESC";
									$query_lietke_sp = mysqli_query($mysqli,$sql_lietke_sp);
								?>
									<p class="giua">Liệt kê danh mục sản phẩm</p>
									<table style="width:100%" border="1" style="border-collapse: collapse;">
									  <tr>
										<th>Thứ Tự</th>
										<th>MSHH</th>
										<th>Tên sản phẩm</th>
										<th>Hình ảnh</th>
										<th>Giá sp</th>
										<th>Số lượng</th>
										<th>Danh mục</th>
										<th>Quy Cách</th>
										<th>Tình Trạng</th>
									  </tr>
								<?php
								  $i = 0;
								  while($row = mysqli_fetch_array($query_lietke_sp)){
									$i++;
								?>
								  <tr>
									<td><?php echo $i ?></td>
									<td><?php echo $row['MSHH'] ?></td>
									<td><?php echo $row['TenHH'] ?></td>
									<td><img src="modules/quanlysp/uploads/<?php echo $row['hinhanh'] ?>" width="150px"></td>
									<td><?php echo $row['Gia'] ?></td>
									<td><?php echo $row['SoLuong'] ?></td>
									<td><?php echo $row['TenLoaiHang'] ?></td>
									<td><?php echo $row['QuyCach'] ?></td>
									<td><?php if($row['TinhTrang']==1){
										echo 'Kích hoạt';
									  }else{
										echo 'Ẩn';
									  } 
										?>
									  
									</td>
									
									<td>
										<!-- Nếu chọn xóa thì sẽ đi đến đường dẫn bên dưới để xử lý, chọn sửa thì sẽ được đoạn code phía dưới xử lý -->
										<a href="modules/quanlysp/xuly.php?masohang=<?php echo $row['MSHH'] ?>">Xoá</a> | <a href="?action=quanlysp&query=sua&masohang=<?php echo $row['MSHH'] ?>">Sửa</a> 
									</td>
								   
								  </tr>
								<?php
								  } 
								 ?>
								 
								</table>
						<?php	// Đây là đoạn code xử lý khi cần sửa sản phẩm // 
								}elseif($tam=='quanlysp' && $query=='sua'){
									
									$sql_sua_sp = "SELECT * FROM hanghoa WHERE MSHH='$_GET[masohang]' LIMIT 1";
									$query_sua_sp = mysqli_query($mysqli,$sql_sua_sp);
						?>
								<!-- Hiển thị trang sửa sản phẩm -->
									<p>Sửa sản phẩm</p>
									<table border="1" width="100%" style="border-collapse: collapse;">
								<?php
									while($row = mysqli_fetch_array($query_sua_sp)) {
								?>
									 <form method="POST" action="modules/quanlysp/xuly.php?masohang=<?php echo $row['MSHH'] ?>" enctype="multipart/form-data">
										  <tr>
											<td>Tên Hàng Hóa</td>
											<td><input type="text" value="<?php echo $row['TenHH'] ?>" name="tenhang"></td>
										  </tr>
										   <tr>
											<td>Mã Hàng Hóa</td>
											<td><input type="text" value="<?php echo $row['MSHH'] ?>" name="masohang"></td>
										  </tr>
										  <tr>
											<td>Giá</td>
											<td><input type="text" value="<?php echo $row['Gia'] ?>" name="gia"></td>
										  </tr>
										  <tr>
											<td>Số Lượng</td>
											<td><input type="text" value="<?php echo $row['SoLuong'] ?>" name="soluong"></td>
										  </tr>
										   <tr>
											<td>Hình ảnh</td>
											<td>
												<input type="file" name="hinhanh">
												<img src="modules/quanlysp/uploads/<?php echo $row['hinhanh'] ?>" width="150px">
											</td>

										  </tr>
										  <tr>
											<td>Quy Cách</td>
											<td><textarea rows="10"  name="quycach" style="resize: none"><?php echo $row['QuyCach'] ?></textarea></td>
										  </tr>
										   
										  <tr>
											<td>Loại Hàng Hóa</td>
											<td>
												<select name="loaihanghoa">
												<?php
													$sql_loaihang = "SELECT * FROM loaihanghoa ORDER BY MaLoaiHang DESC";
													$query_loaihang = mysqli_query($mysqli,$sql_loaihang);
													while($row_loaihang = mysqli_fetch_array($query_loaihang)){
														if($row_loaihang['MaLoaiHang']==$row['MaLoaiHang']){
												?>
												<option selected value="<?php echo $row_loaihang['MaLoaiHang'] ?>"><?php echo $row_loaihang['TenLoaiHang'] ?></option>
												<?php
														}else{
												?>
												<option value="<?php echo $row_loaihang['MaLoaiHang'] ?>"><?php echo $row_loaihang['TenLoaiHang'] ?></option>
												<?php
														}
													} 
												?>
											</select>
										</td>
									  </tr>
									  <tr>
										<td>Tình trạng</td>
										<td>
											<select name="tinhtrang">
												<?php
												if($row['TinhTrang']==1){ 
												?>
												<option value="1" selected>Kích hoạt</option>
												<option value="0">Ẩn</option>
												<?php
												}else{ 
												?>
												<option value="1">Kích hoạt</option>
												<option value="0" selected>Ẩn</option>
												<?php
												} 
												?>

											</select>
										</td>
									  </tr>
									   <tr>
										<td colspan="2"><input type="submit" name="suasanpham" value="Sửa sản phẩm"></td>
									  </tr>
								 </form>
								 <?php
								 } 
								 ?>

									</table>
						<?php
								}elseif($tam=='quanlydonhang' && $query=='lietke'){
						?>			<!-- Đây là đoạn xử lý khi click chuột vào quản lý đơn hàng -->
									<p class="giua">Liệt kê đơn hàng</p>
								<?php
									$sql_lietke_dh = "SELECT * FROM dathang,khachhang,diachikh WHERE dathang.MSKH=khachhang.MSKH AND khachhang.MSKH=diachikh.MSKH ";
									$query_lietke_dh = mysqli_query($mysqli,$sql_lietke_dh);
								?>
								<!-- Hiển thị -->
									<table style="width:100%" border="1" style="border-collapse: collapse;">
									  <tr>
										<th>ID</th>
										<th>Mã đơn hàng</th>
										<th>Tên khách hàng</th>
										<th>Địa chỉ</th>
										<th>Email</th>
										<th>Số điện thoại</th>
										<th>Tình trạng</th>
										<th>Quản lý</th>
									  
									  </tr>
									  <?php
										  $i = 0;
										  while($row = mysqli_fetch_array($query_lietke_dh)){
											$i++;
									  ?>
									  <tr>
										<td><?php echo $i ?></td>
										<td><?php echo $row['SoDonDH'] ?></td>
										<td><?php echo $row['HoTenKH'] ?></td>
										<td><?php echo $row['DiaChi'] ?></td>
										<td><?php echo $row['Email'] ?></td>
										<td><?php echo $row['SoDienThoai'] ?></td>
										<td>
											<?php if($row['TrangThai']==1){ //nếu trạng thái bằng 1 thì sẽ được trang xử lý ở đường dẫn bên dưới xử lý//
												echo '<a href="modules/quanlydonhang/xuly.php?madonhang='.$row['SoDonDH'].'">Đơn hàng mới</a>';
											}else{ //ngược lại in ra Đã xác nhận//
												echo 'Đã xác nhận';
											}
											?>
										</td>
										<td>
											<!-- Tạo đường dẫn đi đến xem đơn hàng ( được xử lý bên dưới ) -->
											<a href="index.php?action=donhang&query=xemdonhang&madonhang=<?php echo $row['SoDonDH'] ?>">Xem đơn hàng</a> 
										</td>
									   
									  </tr>
									  <?php
											} 
									  ?>
									 
									</table>
						<?php			
								}elseif($tam=='donhang' && $query=='xemdonhang'){
						?>
								<!-- Đây là đoạn xử lý khi click vào xem đơn hàng -->
									<p>Xem đơn hàng</p>
								<?php
									$code = $_GET['madonhang']; // Lấy mã đơn hàng cần xem gán cho biến $code //
									$sql_lietke_dh = "SELECT * FROM chitietdathang,hanghoa WHERE chitietdathang.MSHH=hanghoa.MSHH AND chitietdathang.SoDonDH='".$code."'";
									$query_lietke_dh = mysqli_query($mysqli,$sql_lietke_dh);
								?>
									<table style="width:100%" border="1" style="border-collapse: collapse;">
									  <tr>
										<th>ID</th>
										<th>Mã đơn hàng</th>
										<th>Tên sản phẩm</th>
										<th>Số lượng</th>
										<th>Đơn giá</th>
										<th>Thành tiền</th>
									  
									  
									  </tr>
								<?php
									  $i = 0;
									  $tongtien = 0;
									  while($row = mysqli_fetch_array($query_lietke_dh)){
										$i++;
										$thanhtien = ($row['Gia']*$row['SoLuongMua']);
										$thanhtien = $thanhtien - ($thanhtien * $row['GiamGia']); // Thành tiền từng loại sản phẩm trong giỏ//
										$tongtien += $thanhtien ; //Tổng cộng số tiền phải trả cho tất cả sản phẩm trong giỏ //
								?>
									  <tr>
										<td><?php echo $i ?></td>
										<td><?php echo $row['SoDonDH'] ?></td>
										<td><?php echo $row['TenHH'] ?></td>
										<td><?php echo $row['SoLuongMua'] ?></td>
										<td><?php echo number_format($row['Gia'],0,',','.').'vnđ' ?></td> <!-- Tạo định dạng in ra số tiền -->
										<td><?php echo number_format($thanhtien,0,',','.').'vnđ' ?></td>
										
									  </tr>
								  <?php
										} 
								  ?>
									  <tr>
										<td colspan="6">
											<p>Tổng tiền : <?php echo number_format($tongtien,0,',','.').'vnđ' ?></p>
										</td>
									   
									  </tr>
								 
									</table>
						<?php	
								}
								else{ //ngược lại tất cả thì in ra trang này //
						?>
									<p id="welcome">CHÀO MỪNG ĐẾN VỚI TRANG Admin!!!</p>
						<?php
								}
						?>
					
			</div>
			<!-- Hiển thị -->
			<p id = "footer">Chanh_B1809107</p>
	
	</div>

</body>
</html>