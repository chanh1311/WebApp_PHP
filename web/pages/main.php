<div id="main"> 
			<div class="sidebar">
				<ul class="list_sidebar">
					<?php
						//hiển thị danh sách loại hàng hóa (thanh sidebar) //
						$sql_danhmuc = "SELECT * FROM loaihanghoa ORDER BY MaLoaiHang DESC";
						$query_danhmuc = mysqli_query($mysqli,$sql_danhmuc);
						while($row = mysqli_fetch_array($query_danhmuc)){
						    		
					?>
						<li><a href="index.php?quanly=danhmucsanpham&id=<?php echo $row['MaLoaiHang'] ?>"><?php echo $row['TenLoaiHang'] ?></a></li>
					<?php

						} 
					?>
					
				</ul>
			</div> 

			<div class="maincontent"> 
				<?php
				 // Lấy biến quanly (khi người dùng chọn vào một mục) gán cho $tam//
					if(isset($_GET['quanly'])){
						$tam = $_GET['quanly'];
					}else{
						$tam = '';
					}
					// Nếu $tam bằng danh mục sản phẩm thì thực hiện bên dưới//
					if($tam=='danhmucsanpham'){
				?>	
						<?php
							//lấy hàng hóa khi người dùng chọn và một danh mục bất kì //
							$sql_layhh = "SELECT * FROM hanghoa WHERE hanghoa.MaLoaiHang='$_GET[id]' ORDER BY MSHH DESC";
							$query_layhh = mysqli_query($mysqli,$sql_layhh);
							//Lấy thông tin bảng loại hàng//
							$sql_layloaihh = "SELECT * FROM loaihanghoa WHERE loaihanghoa.MaLoaiHang='$_GET[id]' LIMIT 1";
							$query_layloaihh = mysqli_query($mysqli,$sql_layloaihh);
							$row_layloaihh = mysqli_fetch_array($query_layloaihh);
						?> 	<!-- Hiển thị các sản phẩm cùng thông tin  -->
						<h3>Danh mục sản phẩm : <?php echo $row_layloaihh['TenLoaiHang'] ?></h3>
										<ul class="product_list">
											<?php
											while($row_layhh = mysqli_fetch_array($query_layhh)){ 
											?>
											<li>
												<a href="index.php?quanly=sanpham&id=<?php echo $row_layhh['MSHH'] ?>">
													<img src="admincp/modules/quanlysp/uploads/<?php echo $row_layhh['hinhanh'] ?>">
													<p class="title_product">Tên sản phẩm : <?php echo $row_layhh['TenHH'] ?></p>
													<p class="price_product">Giá : <?php echo number_format($row_layhh['Gia'],0,',','.').'vnđ' ?></p>
												</a>
											</li>
											<?php
											} 
											?>
										</ul>	
				
				<?php						
					}elseif($tam=='giohang'){ //Nếu là giỏ hàng //
				?>	
					<p style="color:blue;font-size:18px;">Giỏ hàng 
						  <?php
						  if(isset($_SESSION['dangky'])){
							  // Nếu có session dangky thì in ra dòng này //
							echo 'xin chào: '.'<span style="color:red">'.$_SESSION['dangky'].'</span>';
						   
						  } 
						  ?>
						</p>
						<!-- Hiển thị Thông Tin Giỏ Hàng  -->
						<table style="width:100%;text-align: center;border-collapse: collapse;" border="1">
						  <tr style=background:#E6E6FA;>
								<th>ID</th>
								<th>Mã sp</th>
								<th>Tên sản phẩm</th>
								<th>Hình ảnh</th>
								<th>Số lượng</th>
								<th>Giá sản phẩm</th>
								<th>Thành tiền</th>
								<th>Quản lý</th>
						   
						  </tr>
						  <?php
							  if(isset($_SESSION['cart'])){
								$i = 0;
								$tongtien = 0;
								foreach($_SESSION['cart'] as $cart_item){
									$thanhtien = $cart_item['SoLuong']*$cart_item['Gia'];
									$tongtien+=$thanhtien;
									$i++;
								  ?>
								  <tr style=background:#E0FFFF>
									<td><?php echo $i; ?></td>
									<td><?php echo $cart_item['MSHH']; ?></td>
									<td><?php echo $cart_item['TenHH']; ?></td>
									<td><img src="admincp/modules/quanlysp/uploads/<?php echo $cart_item['hinhanh']; ?>" width="150px"></td>
									<td>
										<a href="pages/main/themgiohang.php?cong=<?php echo $cart_item['id'] ?>"><i class="fa fa-plus fa-style" aria-hidden="true"></i></i></a> <!-- Dấu Cộng  -->
										<?php echo $cart_item['SoLuong']; ?>
										<a href="pages/main/themgiohang.php?tru=<?php echo $cart_item['id'] ?>"><i class="fa fa-minus fa-style" aria-hidden="true"></i></a>	<!-- Dấu Trừ  -->

									</td>
									<td><?php echo number_format($cart_item['Gia'],0,',','.').'vnđ'; ?></td> <!-- Định dạng tiền  -->
									<td><?php echo number_format($thanhtien,0,',','.').'vnđ' ?></td>
									<td><a href="pages/main/themgiohang.php?xoa=<?php echo $cart_item['id'] ?>">Xoá</a></td> <!-- Tạo link xóa sản phẩm -->
								  </tr>
								<?php
								}	
								?>
						   <tr>
							<td colspan="8">
								<p style="float: left;background:#FFF8DC;color:red;">Tổng tiền: <?php echo number_format($tongtien,0,',','.').'vnđ' ?></p><br/>
								<p style="float: right;"><a href="pages/main/themgiohang.php?xoatatca=1">Xoá tất cả</a></p> <!-- Tạo link xóa tất cả được xử lý bên trang themgiohang.php  -->
							  <div style="clear: both;"></div>
							  <?php
								if(isset($_SESSION['dangky'])){
								  ?> <!-- Nếu đã đăng nhập thì có thể đặt hàng  -->
								   <p><a href="index.php?quanly=thanhtoan">Đặt hàng</a></p>
							  <?php
								}else{
							  ?><!-- Ngược lại thì có thể đăng kí để đặt hàng, hoặc đăng nhập để đặt hàng  -->
								<p><a style=background:#FAFAD2; href="index.php?quanly=dangky">Đăng ký đặt hàng</a></p>
								<p><a style=background:#FAFAD2; href="index.php?quanly=dangnhap">Đăng nhập để đặt hàng</a></p>
							  <?php
								}
							  ?>
							  

							</td>

						   
						  </tr>
						  <?php	
						  }else{ 
						  ?>
							   <tr>	<!-- In ra dòng giỏ hàng trống  -->
								<td colspan="8" style="color:red;"><p>Hiện tại giỏ hàng trống</p></td>
							   
							  </tr>
						  <?php
						  } 
						  ?>
					
						</table>	
				<?php
					}elseif($tam=='tintuc'){
				?>
						<p style="color:blue;font-size:30px;">Chào mừng bạn đến với trang web của chúng tôi!</p>
						<p style="color:#800000;font-size:20px;">Chúng tôi chuyên bán những mặc hàng phụ kiện điện thoại chính hãng giá cả phải chăng.</p>
						<p style="color:#800000;font-size:20px;">Đến với shop của chúng tôi khách hàng sẽ được nhiều ưu đãi khi mua sản phẩm như:<br><b>Khi mua tổng số tiền một sản phẩm trên 200k:</b> Giảm 0.05% <br><b>Khi mua tổng số tiền một sản phẩm trên 500k:</b> Giảm 0.1% <br><b>Khi mua tổng số tiền một sản phẩm trên 1 triệu:</b> Giảm tới 0.2% </p>
						<p style="color:blue;font-size:20px;">Rất hân hạnh được phục vụ quý khách!</p>
						
				<?php		
					}elseif($tam=='lienhe'){
				?>		
						<p style="color:blue;font-size:30px;">Chào mừng bạn đến với trang web của chúng tôi!</p>
						<p style="color:#800000;font-size:20px;">Chúng tôi chuyên bán những mặc hàng phụ kiện điện thoại chính hãng giá cả phải chăng.</p>
						<p style="color:black;font-size:20px;">Nếu bạn cần được sự hỗ trợ hay tư vấn hay liên hệ với chúng tôi qua:<br><b>Số Điện Thoại:</b> 090099999<br><b>Email:</b> chanh123@gmail.com<br><b>Địa chỉ:</b> Shop Phụ Kiện Chính Hãng,Đường 3/2 Ninh Kiều,TP Cần Thơ.</p>
						<p style="color:blue;font-size:20px;">Rất hân hạnh được phục vụ quý khách!</p>
				<?php		
					}elseif($tam=='sanpham'){
				?>	<!-- Khi bấm vào sản phẩm thì hiển thị theo định dạng bên dưới  -->
						<p style="color:blue;font-size:20px;text-align:center;">Chi tiết sản phẩm</p>
						<?php
							$sql_chitiet = "SELECT * FROM hanghoa,loaihanghoa WHERE hanghoa.MaLoaiHang=LoaiHangHoa.MaLoaiHang AND HangHoa.MSHH='$_GET[id]' LIMIT 1";
							$query_chitiet = mysqli_query($mysqli,$sql_chitiet);
							while($row_chitiet = mysqli_fetch_array($query_chitiet)){
						?>
						<div class="wrapper_chitiet">
							<div class="hinhanh_sanpham">
								<img width="100%" src="admincp/modules/quanlysp/uploads/<?php echo $row_chitiet['hinhanh'] ?>"><!-- Lấy hình ảnh theo đường link bên dưới  -->
							</div>
							<form method="POST" action="pages/main/themgiohang.php?idsanpham=<?php echo $row_chitiet['MSHH'] ?>">
								<div class="chitiet_sanpham">
									<h3 style="margin:0;color:red;">Tên sản phẩm : <?php echo $row_chitiet['TenHH'] ?></h3>
									<p><b>Mã sản phẩm:</b><?php echo $row_chitiet['MSHH'] ?></p>
									<p><b>Giá sản phẩm:</b> <?php echo number_format($row_chitiet['Gia'],0,',','.').'vnđ' ?></p>
									<p><b>Số lượng sản phẩm:</b> <?php echo $row_chitiet['SoLuong'] ?></p>
									<p><b>Loại sản phẩm:</b> <?php echo $row_chitiet['TenLoaiHang'] ?></p>
									<p><b>Quy Cách:</b> <?php echo $row_chitiet['QuyCach'] ?></p>
									<p><b>Ghi Chú:</b> <?php echo $row_chitiet['Ghichu'] ?></p>
									<p><input class="themgiohang" name="themgiohang" type="submit" value="Thêm giỏ hàng"></p>
								</div>
							</form>

						</div>
						<?php
							} 
						?>

							
			<?php
					}elseif($tam=='dangky'){
			?>			<!-- Đoạn xử lý khi người dùng click vào đăng ký -->
						<?php
							if(isset($_POST['dangky'])) {
								
								$tenkhachhang = isset($_POST['hovaten']) ? $_POST['hovaten'] : '';
								$email = isset($_POST['email']) ? $_POST['email'] : '';
								$dienthoai = isset($_POST['dienthoai']) ? $_POST['dienthoai'] : '';
								$matkhau = isset($_POST['matkhau']) ? $_POST['matkhau'] : '';
								$diachi = isset($_POST['diachi']) ? $_POST['diachi'] : '';
								$congty = isset($_POST['congty']) ? $_POST['congty'] : '';
								$nhaplai = isset($_POST['nhaplai']) ? $_POST['nhaplai'] : '';
								$kt_email = 0; //biến kt email hợp lệ //
								$kt_sdt = 0;
								if (preg_match ("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+\.[A-Za-z]{2,6}$/", $email)) {
									$kt_email = 1; 
								}
								if(is_numeric($dienthoai)){
									$kt_sdt = 1; 
								}
								if ($tenkhachhang == "" || $matkhau == "" || $email == "" || $dienthoai == "" || $diachi == "") {
									echo '<script language="javascript">alert("Vui lòng nhập đầy đủ thông tin!");window.location="index.php?quanly=dangky";</script>';//kiểm tra rỗng//
								}elseif($matkhau != $nhaplai){
									echo '<script language="javascript">alert("Mật khẩu và nhập lại mật khẩu không trùng nhau!");window.location="index.php?quanly=dangky";</script>'; //kiểm tra mật khẩu với nhập lại mật khẩu//
								}elseif($kt_email != 1){
									echo '<script language="javascript">alert("Email phải đúng định dạng!(VD:chanh123@gmail.com)");window.location="index.php?quanly=dangky";</script>'; //kiểm tra mật khẩu với nhập lại mật khẩu//
								}elseif($kt_sdt != 1){
									echo '<script language="javascript">alert("Số điện thoại không thể có ký tự!");window.location="index.php?quanly=dangky";</script>'; //kiểm tra mật khẩu với nhập lại mật khẩu//
								}
								else{
										$tenkhachhang = trim($_POST['hovaten']); //xóa kí tự dư thừa đầu hoặc cuối chuỗi//
										$email = trim($_POST['email']);
										$dienthoai = trim($_POST['dienthoai']);
										$matkhau = md5(trim($_POST['matkhau']));
										$diachi = trim($_POST['diachi']);
										$congty = trim($_POST['congty']);
										//thêm thông tin khách hàng và địa chỉ khách hàng vào database//
										$sql_dangky = mysqli_query($mysqli,"INSERT INTO khachhang(HoTenKH,Email,matkhau,SoDienThoai,TenCongTy) VALUES('".$tenkhachhang."','".$email."','".$matkhau."','".$dienthoai."','".$congty."')");
										$ID_new = mysqli_insert_id($mysqli);
										$sql_diachi = mysqli_query($mysqli,"INSERT INTO diachikh(MSKH,DiaChi) VALUES('$ID_new.','$diachi')");
										if($sql_dangky && $sql_diachi){ //nếu thêm dữ liệu thành công thì tạo session dangky và id_khachhang//
											$_SESSION['dangky'] = $tenkhachhang;
											$_SESSION['id_khachhang'] = $ID_new;
											//in ra dòng này//
											echo '<script language="javascript">alert("Đăng ký thành công, bạn có thể mua hàng!"); window.location="index.php?quanly=giohang";</script>';
										}
									}
							}
						?>
						<!-- Những thứ hiển thị ở trang đăng ký  -->
						<p style="color:blue;font-size:18px;"><b>ĐĂNG KÝ THÀNH VIÊN</b></p>
						<style type="text/css">
							table.dangky tr td {
								padding: 5px;
							}
						</style>
						<form action="" method="POST">
						<table class="dangky" border="1" width="50%" style="border-collapse: collapse;">
							<tr>
								<td style=background:#E6E6FA>Họ và tên</td>
								<td><input type="text" size="50" name="hovaten"></td>
							</tr>
							<tr>
								<td style=background:#E6E6FA>Email</td>
								<td><input type="text" size="50" name="email"></td>
							</tr>
							<tr>
								<td style=background:#E6E6FA>Điện thoại</td>
								<td><input type="text" size="50" name="dienthoai"></td>
							</tr>
							<tr>
								<td style=background:#E6E6FA>Địa chỉ</td>
								<td><input type="text" size="50" name="diachi"></td>
							</tr>
							<tr>
								<td style=background:#E6E6FA>Mật khẩu</td>
								<td><input type="password" size="50" name="matkhau"></td>
							</tr>
							<tr>
								<td style=background:#E6E6FA>Nhập Lại Mật Khẩu</td>
								<td><input type="password" size="50" name="nhaplai"></td>
							</tr>
							<tr>
								<td style=background:#E6E6FA>Tên Công Ty</td>
								<td><input type="text" size="50" name="congty"></td>
							</tr>
							<tr>
								
								<td style=background:#FFA07A><input type="submit" name="dangky" value="Đăng ký"></td>
								<td style=background:#FFA07A><a href="index.php?quanly=dangnhap">Đăng nhập nếu có tài khoản</a></td>
							</tr>
						</table>

						</form>
						
			<?php
					}elseif($tam=='thanhtoan'){
			?>			<!-- Khi người dùng click vào đặt hàng  -->
						<?php
							//session_start();
							//include('../../admincp/config/config.php');
							$id_khachhang = $_SESSION['id_khachhang'];
							$code_order = rand(0,9999); //mã số đặt hàng được tạo ngẫu nhiên//
							$ngay_dh = date("Y/m/d");
							$ngay_gh = strtotime(($ngay_dh. ' + 5 days'));
							$ngay_gh = date ("Y/m/d",$ngay_gh);//ngày giao hàng được cộng thêm 5 ngày từ khi đặt hàng//
							$insert_cart = "INSERT INTO dathang(MSKH,SoDonDH,TrangThai,NgayDH,NgayGH) VALUE('".$id_khachhang."','".$code_order."',1,'".$ngay_dh."','".$ngay_gh."')";
							$cart_query = mysqli_query($mysqli,$insert_cart);
							//thêm thông tin bảng dathang//
							if($cart_query){
								//them gio hang chi tiet
								foreach($_SESSION['cart'] as $key => $value){
									$id_sanpham = $value['id'];
									$soluong = $value['SoLuong'];
									$giamgia = 0;
									$gia_dathang = $soluong * $value['Gia'];
									// cập nhật $giamgia theo $gia_dathang//
									if($gia_dathang >= 200000){
										$giamgia = 0.05;
									}
									if($gia_dathang >= 500000){
										$giamgia = 0.1;
									}
									if($gia_dathang >= 1000000){
										$giamgia = 0.2;
									}
									//Thêm thông tin vào bảng chi tiết đặt hàng //
									
									$insert_order_details = "INSERT INTO ChiTietDatHang(MSHH,SoDonDH,SoLuongMua,GiaDatHang,GiamGia) VALUE('".$id_sanpham."','".$code_order."','".$soluong."','".$gia_dathang."','".$giamgia."')";
									mysqli_query($mysqli,$insert_order_details);
								}
							}
							// xóa session//
							unset($_SESSION['cart']);
							//hiển thị//
							echo '<script language="javascript">alert("Cảm ơn bạn đã đặt hàng, chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất!");window.location="/web/index.php";</script>';
							


						?>
						
			<?php	
					}elseif($tam=='dangnhap'){
			?>			<!-- Khi người dùng chọn đăng nhập  -->
						<?php
							if(isset($_POST['dangnhap'])){
								$email = $_POST['email'];
								$matkhau = md5($_POST['password']);
								$sql = "SELECT * FROM khachhang WHERE Email='".$email."' AND matkhau='".$matkhau."' LIMIT 1";
								$row = mysqli_query($mysqli,$sql);
								$count = mysqli_num_rows($row);
								// Kiểm tra đăng nhập//
								if($count>0){
									$row_data = mysqli_fetch_array($row);
									$_SESSION['dangky'] = $row_data['HoTenKH'];
									$_SESSION['id_khachhang'] = $row_data['MSKH'];
									header("Location:index.php?quanly=giohang");
								}else{
									echo '<script language="javascript">alert("Email hoặc mật khẩu không đúng!"); window.location="index.php?quanly=dangnhap";</script>';
									
								}
							} 
						?>
						<!-- Hiển thị bảng đăng nhập  -->
						<form action="" autocomplete="off" method="POST">
								<table border="1" width="50%" class="table-login" style="text-align: center;border-collapse: collapse;">
									<tr style=background:#E6E6FA>
										<td colspan="2"><h3 style="color:blue;font-size:18px;">Đăng nhập khách hàng(Tên tài khoản là Email)</h3></td>
									</tr>
									<tr>
										<td>Tài khoản</td>
										<td><input type="text" size="50" name="email" placeholder="Email..."></td>
									</tr>
									<tr>
										<td>Mật khẩu</td>
										<td><input type="password" size="50" name="password" placeholder="Mật khẩu..."></td>
									</tr>
									<tr style=background:#E6E6FA>
										
										<td colspan="2"><input type="submit" name="dangnhap" value="Đăng nhập"></td>
									</tr>
							</table>
						</form>
						
			<?php	
					}elseif($tam=='timkiem'){
			?>			<!-- Khi người dùng click vào ô tìm kiếm sản phẩm  -->
						<?php
							if(isset($_POST['timkiem'])){
								$tukhoa = $_POST['tukhoa'];
							}
							$sql_pro = "SELECT * FROM hanghoa,loaihanghoa WHERE hanghoa.MaLoaiHang=loaihanghoa.MaLoaiHang AND hanghoa.TenHH LIKE '%".$tukhoa."%'";
							$query_pro = mysqli_query($mysqli,$sql_pro);
							
						?>
						<!-- Hiển thị sản phẩm theo từ khóa -->
						<h3>Từ khoá tìm kiếm : <?php echo $_POST['tukhoa']; ?></h3>
										<ul class="product_list">
											<?php
											while($row = mysqli_fetch_array($query_pro)){ 
											?>
											<li>
												<a href="index.php?quanly=sanpham&id=<?php echo $row['MSHH'] ?>">
													<img src="admincp/modules/quanlysp/uploads/<?php echo $row['hinhanh'] ?>">
													<p class="title_product">Tên sản phẩm : <?php echo $row['TenHH'] ?></p>
													<p class="price_product">Giá : <?php echo number_format($row['Gia'],0,',','.').'vnđ' ?></p>
													<p style="text-align: center;color:#d1d1d1"><?php echo $row['MaLoaiHang'] ?></p>
												</a>
											</li>
											<?php
											} 
											?>
										</ul>
						
			<?php	
					}elseif($tam=='thaydoimatkhau'){	
			?>			<!-- Khi người dùng muốn thay đổi mật khẩu  -->
						<?php
							if(isset($_POST['doimatkhau'])){
								$taikhoan = $_POST['email'];
								$matkhau_cu = md5($_POST['password_cu']);
								$matkhau_moi = $_POST['password_moi'];
								$nhaplai = $_POST['nhaplai'];
								if($matkhau_moi == ""){ //Kiểm tra rỗng mật khẩu mới//
									echo '<p style="color:red">Mật khẩu mới trống!!!';
								}elseif($matkhau_moi != $nhaplai){ //Kiểm tra nhập lại //
									echo '<p style="color:red">Mật khẩu và Nhập lại không khớp!!!';
								}
								else{ // ngược lại không rỗng thì tiến hành update mật khẩu trong database //
									$matkhau_moi = md5($_POST['password_moi']);
									$sql = "SELECT * FROM khachhang WHERE email='".$taikhoan."' AND matkhau='".$matkhau_cu."' LIMIT 1";
									$row = mysqli_query($mysqli,$sql);
									$count = mysqli_num_rows($row);
									if($count>0){ // Nhập đúng mật khẩu cũ //
										$sql_update = mysqli_query($mysqli,"UPDATE khachhang SET matkhau='".$matkhau_moi."'");
										echo '<p style="color:green">Mật khẩu đã được thay đổi.</p>';
									}else{ //nhập sai //
										echo '<p style="color:red">Tài khoản hoặc Mật khẩu cũ không đúng,vui lòng nhập lại.</p>';
									}
								}
							} 
						?>
						<!-- Form đổi mật khẩu-->
						<style>  
						table, th, td {  
							border: 1px solid pink;  
							border-collapse: collapse;  
						}  
						th, td {  
							padding: 10px;  
						}  
						</style>
						<form action="" autocomplete="off" method="POST">
								<table border="1" class="table-login" style="text-align: center;border-collapse: collapse;">
									<tr style=background:#FFC0CB;>
										<td colspan="2"><h3>Đổi mật khẩu</h3></td>
									</tr>
									<tr>
										<td>Tài khoản</td>
										<td><input type="text" name="email"></td>
									</tr>
									<tr>
										<td>Mật khẩu cũ</td>
										<td><input type="password" name="password_cu"></td>
									</tr>
									<tr>
										<td>Mật khẩu mới</td>
										<td><input type="password" name="password_moi"></td>
									</tr>
									<tr>
										<td>Nhập lại Mật khẩu mới</td>
										<td><input type="password" name="nhaplai"></td>
									</tr>
									<tr style=background:#FFC0CB;>
										
										<td colspan="2"><input type="submit" name="doimatkhau" value="Đổi mật khẩu"></td>
									</tr>
							</table>
						</form>
			<?php			
					}else{	 //Ngược lại tất cả hiển thị sản phẩm mới nhất lên màn hình//		
			?>			
						<?php
							// Thiết lặp các biến để phân trang //
							if(isset($_GET['trang'])){
								$page = $_GET['trang'];
							}else{
								$page = 1;
							}
							if($page == '' || $page == 1){
								$begin = 0;
							}else{
								$begin = ($page*3)-3;
							}
							$sql_pro = "SELECT * FROM HangHoa,LoaiHangHoa WHERE HangHoa.MaLoaiHang=LoaiHangHoa.MaLoaiHang ORDER BY HangHoa.MSHH DESC LIMIT $begin,3";// 3sp//
							$query_pro = mysqli_query($mysqli,$sql_pro);
							
						?>
						<!-- Hiển thị sản phẩm -->
						<h2 style="color:blue;text-align:center">Sản phẩm mơí nhất</h2>
								<ul class="product_list">
											<?php
												while($row = mysqli_fetch_array($query_pro)){ 
											?>
											<li>
												<a href="index.php?quanly=sanpham&id=<?php echo $row['MSHH'] ?>">
													<img src="admincp/modules/quanlysp/uploads/<?php echo $row['hinhanh'] ?>">
													<p class="title_product">Tên sản phẩm : <?php echo $row['TenHH'] ?></p>
													<p class="price_product">Giá : <?php echo number_format($row['Gia'],0,',','.').'vnđ' ?></p>
													<p style="text-align: center;color:#d1d1d1"><?php echo $row['TenLoaiHang'] ?></p>
												</a>
											</li>
											<?php
												} 
											?>
										<!-- phần định dạng css-->
								</ul>
									<div style="clear:both;"></div>
										<style type="text/css">
											ul.list_trang {
												padding: 0;
												margin: 0;
												list-style: none;
											}
											ul.list_trang li {
												float: left;
												padding: 5px 13px;
												margin: 5px;
												background: burlywood;
												display: block;
											}
											ul.list_trang li a {
												color: #000;
												text-align: center;
												text-decoration: none;
											 
											}
										</style>
								<?php
								//
									$sql_trang = mysqli_query($mysqli,"SELECT * FROM HangHoa");
									$row_count = mysqli_num_rows($sql_trang);  // số sp // 
									$trang = ceil($row_count/3);	// chia 3 se được tổng số trang, 1 trang co 3 sp//
								?>
						<!-- Hiển trị định dạng trang -->
						<p>Trang hiện tại : <?php echo $page ?>/<?php echo $trang ?> </p>
										
								<ul class="list_trang">

											<?php
											
												for($i=1;$i<=$trang;$i++){ 
											?>
												<li <?php if($i==$page){echo 'style="background: red;"';}// định dạng màu ở số trang hiện tại//
															else{ echo ''; }  ?>><a href="index.php?trang=<?php echo $i ?>"><?php echo $i ?></a></li><!-- link đi đến trang khác -->
											<?php
												} 
											?>
											
								</ul>				
			<?php			
					}
			?>	
			</div>

		</div>