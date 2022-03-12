<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<!-- sử dụng font để hiện dấu cộng trừ số lượng -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">

	
	<title>Web phụ kiện điện thoại</title>
	
</head>
<body>
	<div class="wrapper">
		<?php
			session_start();
			include("admincp/config/config.php");//kết nối database//
		?>
			<div class="header"></div>
		<?php	
			include("pages/menu.php"); //  Menu hiển thị //
			include("pages/main.php"); // Các xử lý chính //
			
		?>
		<div class="clear"></div>
			<div class="footer">
				<p class="footer_copyright">Chanh - B1809107</p>
		</div>
		
	</div>
</body>
</html>