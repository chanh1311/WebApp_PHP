<?php

			$sql_danhmuc = "SELECT * FROM loaihanghoa ORDER BY MaLoaiHang DESC";
			$query_danhmuc = mysqli_query($mysqli,$sql_danhmuc);
			// lấy loại hàng hóa //
	    		
?>
		<?php
			if(isset($_GET['dangxuat'])&&$_GET['dangxuat']==1){
				unset($_SESSION['dangky']);
				// Nếu tồn tại session dangxuat và bằng 1 thì xóa session đăng kí //
			} 
		?>
		<div class="menu">
					<ul class="list_menu">
						<li><a href="index.php">Trang chủ</a></li>
						<?php
						if(isset($_SESSION['dangky'])){ 
						// Nếu tồn tại session đăng ký thì có đăng xuất và đổi mật khẩu //
						?>
						<li><a href="index.php?dangxuat=1">Đăng xuất</a></li>
						<li><a href="index.php?quanly=thaydoimatkhau">Thay đổi mật khẩu</a></li>
						<?php
						}else{  //ngược lại có đăng nhập và đăng ký//
						?>
						<li><a href="index.php?quanly=dangnhap">Đăng nhập</a></li>
						<li><a href="index.php?quanly=dangky">Đăng ký</a></li>
						<?php
						} 
						?>
						<li><a href="index.php?quanly=giohang">Giỏ hàng</a></li>

						<li><a href="index.php?quanly=tintuc">Tin tức</a></li>
						<li><a href="index.php?quanly=lienhe">Liên hệ</a></li>
						
							
						
					</ul>
					<p>
						<form action="index.php?quanly=timkiem" method="POST">
							<input type="text" placeholder="Tìm kiếm sản phẩm..." name="tukhoa">
							<input type="submit" name="timkiem" value="Tìm kiếm">
						</form>
					</p>
		</div>