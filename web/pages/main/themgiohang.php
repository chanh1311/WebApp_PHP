<?php
	session_start();
	include('../../admincp/config/config.php');
	//them so luong
	if(isset($_GET['cong'])){
		$id=$_GET['cong'];
		$sql ="SELECT * FROM hanghoa WHERE MSHH='".$id."' LIMIT 1";
		$query = mysqli_query($mysqli,$sql);
		$row = mysqli_fetch_array($query);
		$SoLuongKho = $row['SoLuong']; //lấy số lượng trong bảng hàng hóa(số lượng kho)//
		foreach($_SESSION['cart'] as $cart_item){
			if($cart_item['id']!=$id){
				$product[]= array('TenHH'=>$cart_item['TenHH'],'id'=>$cart_item['id'],'SoLuong'=>$cart_item['SoLuong'],'Gia'=>$cart_item['Gia'],'hinhanh'=>$cart_item['hinhanh'],'MSHH'=>$cart_item['MSHH']);
				$_SESSION['cart'] = $product;
			}else{
				$tangsoluong = $cart_item['SoLuong'] + 1;
				if($cart_item['SoLuong']< $SoLuongKho){ //số lượng đặt hàng phải nhỏ hơn hoặc bằng số lượng kho//
					
					$product[]= array('TenHH'=>$cart_item['TenHH'],'id'=>$cart_item['id'],'SoLuong'=>$tangsoluong,'Gia'=>$cart_item['Gia'],'hinhanh'=>$cart_item['hinhanh'],'MSHH'=>$cart_item['MSHH']);
				}else{ //ngược lại không tăng lên được//

					$product[]= array('TenHH'=>$cart_item['TenHH'],'id'=>$cart_item['id'],'SoLuong'=>$cart_item['SoLuong'],'Gia'=>$cart_item['Gia'],'hinhanh'=>$cart_item['hinhanh'],'MSHH'=>$cart_item['MSHH']);
				}
				$_SESSION['cart'] = $product;
			}
			
		}
		header('Location:../../index.php?quanly=giohang');
	}
	//tru so luong
	if(isset($_GET['tru'])){
		$id=$_GET['tru'];
		foreach($_SESSION['cart'] as $cart_item){
			if($cart_item['id']!=$id){
				$product[]= array('TenHH'=>$cart_item['TenHH'],'id'=>$cart_item['id'],'SoLuong'=>$cart_item['SoLuong'],'Gia'=>$cart_item['Gia'],'hinhanh'=>$cart_item['hinhanh'],'MSHH'=>$cart_item['MSHH']);
				$_SESSION['cart'] = $product;
			}else{
				$tangsoluong = $cart_item['SoLuong'] - 1;
				if($cart_item['SoLuong']>1){
					
					$product[]= array('TenHH'=>$cart_item['TenHH'],'id'=>$cart_item['id'],'SoLuong'=>$tangsoluong,'Gia'=>$cart_item['Gia'],'hinhanh'=>$cart_item['hinhanh'],'MSHH'=>$cart_item['MSHH']);
				}else{
					$product[]= array('TenHH'=>$cart_item['TenHH'],'id'=>$cart_item['id'],'SoLuong'=>$cart_item['SoLuong'],'Gia'=>$cart_item['Gia'],'hinhanh'=>$cart_item['hinhanh'],'MSHH'=>$cart_item['MSHH']);
				}
				$_SESSION['cart'] = $product;
			}
			
		}
		header('Location:../../index.php?quanly=giohang');
	}
	//xoa san pham
	if(isset($_SESSION['cart'])&&isset($_GET['xoa'])){
		$id=$_GET['xoa'];
		foreach($_SESSION['cart'] as $cart_item){

			if($cart_item['id']!=$id){
				$product[]= array('TenHH'=>$cart_item['TenHH'],'id'=>$cart_item['id'],'SoLuong'=>$cart_item['SoLuong'],'Gia'=>$cart_item['Gia'],'hinhanh'=>$cart_item['hinhanh'],'MSHH'=>$cart_item['MSHH']);
			}

		$_SESSION['cart'] = $product;
		header('Location:../../index.php?quanly=giohang');
		}
	}
	//xoa tat ca
	if(isset($_GET['xoatatca'])&&$_GET['xoatatca']==1){
		unset($_SESSION['cart']);
		header('Location:../../index.php?quanly=giohang');
	}
	//them sanpham vao gio hang
	if(isset($_POST['themgiohang'])){
		//session_destroy();
		$id=$_GET['idsanpham'];
		$soluong=1;
		$sql ="SELECT * FROM hanghoa WHERE MSHH='".$id."' LIMIT 1";
		$query = mysqli_query($mysqli,$sql);
		$row = mysqli_fetch_array($query);
		
		if($row){
			$new_product=array(array('TenHH'=>$row['TenHH'],'id'=>$id,'SoLuong'=>$soluong,'Gia'=>$row['Gia'],'hinhanh'=>$row['hinhanh'],'MSHH'=>$row['MSHH']));
			//kiem tra session gio hang ton tai
			if(isset($_SESSION['cart'])){
				$found = false;
				foreach($_SESSION['cart'] as $cart_item){
					//neu du lieu trung
					if($cart_item['id']==$id){
						$product[]= array('TenHH'=>$cart_item['TenHH'],'id'=>$cart_item['id'],'SoLuong'=>$soluong+1,'Gia'=>$cart_item['Gia'],'hinhanh'=>$cart_item['hinhanh'],'MSHH'=>$cart_item['MSHH']);
						$found = true;
					}else{
						//neu du lieu khong trung
						$product[]= array('TenHH'=>$cart_item['TenHH'],'id'=>$cart_item['id'],'SoLuong'=>$cart_item['SoLuong'],'Gia'=>$cart_item['Gia'],'hinhanh'=>$cart_item['hinhanh'],'MSHH'=>$cart_item['MSHH']);
					}
				}
				if($found == false){
					//lien ket du lieu new_product voi product
					$_SESSION['cart']=array_merge($product,$new_product);
				}else{
					$_SESSION['cart']=$product;
				}
			}else{
				$_SESSION['cart'] = $new_product;
			}

		}
		header('Location:../../index.php?quanly=giohang');
		
	}
	
	
	
?>