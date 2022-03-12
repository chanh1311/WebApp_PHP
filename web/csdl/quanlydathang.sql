-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 08, 2021 lúc 09:27 AM
-- Phiên bản máy phục vụ: 10.4.18-MariaDB
-- Phiên bản PHP: 8.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `quanlydathang`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietdathang`
--

CREATE TABLE `chitietdathang` (
  `SoDonDH` varchar(10) NOT NULL,
  `MSHH` varchar(10) NOT NULL,
  `SoLuongMua` int(11) NOT NULL,
  `GiaDatHang` bigint(20) DEFAULT NULL,
  `GiamGia` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `chitietdathang`
--

INSERT INTO `chitietdathang` (`SoDonDH`, `MSHH`, `SoLuongMua`, `GiaDatHang`, `GiamGia`) VALUES
('6291', 'TN11', 2, 380000, 0.05);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dathang`
--

CREATE TABLE `dathang` (
  `SoDonDH` varchar(10) NOT NULL,
  `MSNV` varchar(10) DEFAULT NULL,
  `NgayDH` date DEFAULT NULL,
  `NgayGH` date DEFAULT NULL,
  `TrangThai` int(11) NOT NULL,
  `MSKH` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `dathang`
--

INSERT INTO `dathang` (`SoDonDH`, `MSNV`, `NgayDH`, `NgayGH`, `TrangThai`, `MSKH`) VALUES
('6291', 'NV123', '2021-06-08', '2021-06-13', 0, 61);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `diachikh`
--

CREATE TABLE `diachikh` (
  `MaDC` int(10) NOT NULL,
  `DiaChi` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `MSKH` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `diachikh`
--

INSERT INTO `diachikh` (`MaDC`, `DiaChi`, `MSKH`) VALUES
(45, 'cần thơ', 61);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hanghoa`
--

CREATE TABLE `hanghoa` (
  `MSHH` varchar(10) NOT NULL,
  `TenHH` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `QuyCach` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Gia` bigint(20) DEFAULT NULL,
  `MaLoaiHang` int(10) DEFAULT NULL,
  `Ghichu` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `hinhanh` varchar(50) DEFAULT NULL,
  `TinhTrang` int(11) NOT NULL,
  `SoLuong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `hanghoa`
--

INSERT INTO `hanghoa` (`MSHH`, `TenHH`, `QuyCach`, `Gia`, `MaLoaiHang`, `Ghichu`, `hinhanh`, `TinhTrang`, `SoLuong`) VALUES
('06', 'tai nghe', 'Tai Nghe Có Dây, Âm ', 100000, 3, 'Bán Chạy Số 1', '1622855079_tainghe1.jpg', 1, 20),
('21', 'Dây Ngọc + Ốp Lưng', 'Dây ngọc trang trí tuyệt đẹp cho điện thoại', 100000, 6, 'Bán chạy số 1 cửa hàng', '1622861308_1610015549_dayngoc.jpg', 1, 50),
('CS01', 'Cục sạc 1', 'Cục sạc pin chất lượng cao, sạc nhanh', 50000, 1, 'Bán chạy số 1', '', 1, 50),
('CS010', 'Cục sạc 10', 'Cục sạc pin chất lượng cao, sạc nhanh', 55000, 1, 'Bán chạy số 1', '', 1, 50),
('CS04', 'Cục sạc 4', 'Cục sạc pin chất lượng cao, sạc nhanh', 80000, 1, 'Bán chạy số 1', '1622863881_images(57).jpg', 1, 50),
('CS05', 'Cục sạc 5', 'Cục sạc pin chất lượng cao, sạc nhanh', 90000, 1, 'Bán chạy số 1', '1622863856_images(64).jpg', 1, 50),
('CS06', 'Cục sạc 6', 'Cục sạc pin chất lượng cao, sạc nhanh', 110000, 1, 'Bán chạy số 1', '1622863829_images(58).jpg', 1, 50),
('CS07', 'Cục sạc 7', 'Cục sạc pin chất lượng cao, sạc nhanh', 100000, 1, 'Bán chạy số 1', '1622863817_images(63).jpg', 1, 50),
('CS08', 'Cục sạc 8', 'Cục sạc pin chất lượng cao, sạc nhanh', 60000, 1, 'Bán chạy số 1', '1622863806_images(57).jpg', 1, 50),
('CS09', 'Cục sạc 9', 'Cục sạc pin chất lượng cao, sạc nhanh', 12000, 1, 'Bán chạy số 1', '1622863796_images(59).jpg', 1, 50),
('KCL03', 'Kính cường lực 1', 'Bảo vệ tốt màn hình điện thoại', 100000, 4, 'Bán chạy số 1', '1622863779_images(47).jpg', 1, 70),
('KCL04', 'Kính cường lực 1', 'Bảo vệ tốt màn hình điện thoại', 90000, 4, 'Bán chạy số 1', '1622863755_images(53).jpg', 1, 70),
('KCL05', 'Kính cường lực 1', 'Bảo vệ tốt màn hình điện thoại', 80000, 4, 'Bán chạy số 1', '1622863717_images(55).jpg', 1, 70),
('KCL06', 'Kính cường lực 1', 'Bảo vệ tốt màn hình điện thoại', 70000, 4, 'Bán chạy số 1', '1622863698_images(54).jpg', 1, 70),
('KCL07', 'Kính cường lực 10', 'Bảo vệ tốt màn hình điện thoại', 60000, 4, 'Bán chạy số 1', '1622863680_images(51).jpg', 1, 100),
('OL01', 'Ốp Lưng Đẹp1', 'Trang trí điện thoại đẹp mắt', 70000, 2, 'bán chạy số 1', '1622863654_images(42).jpg', 1, 100),
('OL010', 'Ốp Lưng Đẹp10', 'Trang trí điện thoại đẹp mắt', 55000, 2, 'bán chạy số 1', '1622863634_images(44).jpg', 1, 100),
('OL02', 'Ốp Lưng Đẹp2', 'Trang trí điện thoại đẹp mắt', 50000, 2, 'bán chạy số 1', '1622863618_images(49).jpg', 1, 100),
('OL03', 'Ốp Lưng Đẹp3', 'Trang trí điện thoại đẹp mắt', 60000, 2, 'bán chạy số 1', '1622863600_images(46).jpg', 1, 100),
('OL04', 'Ốp Lưng Đẹp4', 'Trang trí điện thoại đẹp mắt', 100000, 2, 'bán chạy số 1', '1622863586_images(45).jpg', 1, 100),
('OL05', 'Ốp Lưng Đẹp5', 'Trang trí điện thoại đẹp mắt', 40000, 2, 'bán chạy số 1', '1622863332_images(50).jpg', 1, 100),
('OL06', 'Ốp Lưng Đẹp6', 'Trang trí điện thoại đẹp mắt', 30000, 2, 'bán chạy số 1', '1622863312_images(43).jpg', 1, 100),
('OL07', 'Ốp Lưng Đẹp7', 'Trang trí điện thoại đẹp mắt', 90000, 2, 'bán chạy số 1', '1622863302_images(40).jpg', 1, 100),
('OL08', 'Ốp Lưng Đẹp8', 'Trang trí điện thoại đẹp mắt', 80000, 2, 'bán chạy số 1', '1622863276_images(49).jpg', 1, 100),
('OL09', 'Ốp Lưng Đẹp9', 'Trang trí điện thoại đẹp mắt', 110000, 2, 'bán chạy số 1', '1622863264_images(41).jpg', 1, 100),
('S01', 'Sim 4g chất lượng cao 1', 'Sim tốc độ cực nhanh', 250000, 5, 'bán chạy số 1', '1622861864_1622861798_images(29).jpg', 1, 100),
('S02', 'Sim 4g chất lượng cao 2', 'Sim tốc độ cực nhanh', 260000, 5, 'bán chạy số 1', '1622861821_images(36).jpg', 1, 110),
('S03', 'Sim 4g chất lượng cao 3', 'Sim tốc độ cực nhanh', 270000, 5, 'bán chạy số 1', '1622861808_images(35).jpg', 1, 120),
('S04', 'Sim 4g chất lượng cao 4', 'Sim tốc độ cực nhanh', 280000, 5, 'bán chạy số 1', '1622861798_images(29).jpg', 1, 150),
('S05', 'Sim 4g chất lượng cao 5', 'Sim tốc độ cực nhanh', 300000, 5, 'bán chạy số 1', '1622861772_images(2).png', 1, 10),
('TN01', 'Tai Nghe Đẹp 1', 'Tai Nghe âm thanh chất lượng cao', 100000, 3, 'Là dòng tai nghe giá rẻ, bền bỉ âm thanh chất lượn', '1622861204_images(4).jpg', 1, 50),
('TN010', 'Tai Nghe Bluetooth 10', 'Tai Nghe âm thanh không dây chất lượng cao', 220000, 3, 'Là dòng tai nghe không dây, bền bỉ âm thanh chất l', '1622859541_images(27).jpg', 1, 15),
('TN02', 'Tai Nghe Đẹp 2', 'Tai Nghe âm thanh chất lượng cao', 110000, 3, 'Là dòng tai nghe giá rẻ, bền bỉ âm thanh chất lượn', '1622859515_images(7).jpg', 1, 30),
('TN03', 'Tai Nghe Đẹp 3', 'Tai Nghe âm thanh chất lượng cao', 120000, 3, 'Là dòng tai nghe giá rẻ, bền bỉ âm thanh chất lượn', '1622859490_images(3).jpg', 1, 40),
('TN04', 'Tai Nghe Đẹp 4', 'Tai Nghe âm thanh chất lượng cao', 130000, 3, 'Là dòng tai nghe giá rẻ, bền bỉ âm thanh chất lượn', '1622859470_images(11).jpg', 1, 60),
('TN05', 'Tai Nghe Đẹp 5', 'Tai Nghe âm thanh chất lượng cao', 135000, 3, 'Là dòng tai nghe giá rẻ, bền bỉ âm thanh chất lượn', '1622859451_images(24).jpg', 1, 70),
('TN06', 'Tai Nghe Đẹp 6', 'Tai Nghe âm thanh chất lượng cao', 140000, 3, 'Là dòng tai nghe giá rẻ, bền bỉ âm thanh chất lượn', '1622859435_images(28).jpg', 1, 70),
('TN07', 'Tai Nghe Bluetooth 7', 'Tai Nghe âm thanh không dây chất lượng cao', 200000, 3, 'Là dòng tai nghe không dây, bền bỉ âm thanh chất l', '1622859420_images(17).jpg', 1, 200),
('TN08', 'Tai Nghe Bluetooth 8', 'Tai Nghe âm thanh không dây chất lượng cao', 250000, 3, 'Là dòng tai nghe không dây, bền bỉ âm thanh chất l', '1622859401_images(2).jpg', 1, 99),
('TN09', 'Tai Nghe Bluetooth 9', 'Tai Nghe âm thanh không dây chất lượng cao', 200000, 3, 'Là dòng tai nghe không dây, bền bỉ âm thanh chất l', '1622859385_images(21).jpg', 1, 7),
('TN11', 'Tai Nghe Bluetooth 11', 'Tai Nghe âm thanh không dây chất lượng cao', 190000, 3, 'Là dòng tai nghe không dây, bền bỉ âm thanh chất l', '1623126751_images(13).jpg', 1, 1),
('TT01', 'Dây trang trí ốp lưng đẹp 1', 'Trang trí cho ốp lưng', 20000, 6, 'Phụ kiện trang trí ốp lưng bán chạy', '1622861161_1622257261_dayngoc.jpg', 1, 50),
('TT02', 'Dây trang trí ốp lưng đẹp 2', 'Trang trí cho ốp lưng', 30000, 6, 'Phụ kiện trang trí ốp lưng bán chạy', '1622861149_TT3.jpg', 1, 60),
('TT03', 'Dây trang trí ốp lưng đẹp 3', 'Trang trí cho ốp lưng', 10000, 6, 'Phụ kiện trang trí ốp lưng bán chạy', '1622861141_TT2.jpg', 1, 70);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `MSKH` int(11) NOT NULL,
  `HoTenKH` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `SoDienThoai` varchar(12) DEFAULT NULL,
  `Email` varchar(30) DEFAULT NULL,
  `TenCongTy` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `matkhau` varchar(100) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`MSKH`, `HoTenKH`, `SoDienThoai`, `Email`, `TenCongTy`, `matkhau`) VALUES
(61, 'Nguyễn VĂn Chánh', '0912312313', 'chanh123@gmail.com', 'TTC', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaihanghoa`
--

CREATE TABLE `loaihanghoa` (
  `MaLoaiHang` int(11) NOT NULL,
  `TenLoaiHang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `loaihanghoa`
--

INSERT INTO `loaihanghoa` (`MaLoaiHang`, `TenLoaiHang`) VALUES
(1, 'Cục Sạc'),
(2, 'Ốp Lưng'),
(3, 'Tai Nghe'),
(4, 'Kính cường lực'),
(5, 'Sim'),
(6, 'Trang Trí');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
--

CREATE TABLE `nhanvien` (
  `MSNV` varchar(10) NOT NULL,
  `HoTenNV` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `ChucVu` varchar(30) DEFAULT NULL,
  `DiaChi` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `SoDienThoai` varchar(12) DEFAULT NULL,
  `matkhaunv` varchar(100) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `nhanvien`
--

INSERT INTO `nhanvien` (`MSNV`, `HoTenNV`, `ChucVu`, `DiaChi`, `SoDienThoai`, `matkhaunv`) VALUES
('NV123', 'Nguyễn Văn A', 'ADMIN', 'Cần Thơ', '0123456789', '59dd913ab5fbd5a13f36c4d40168fb8f');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chitietdathang`
--
ALTER TABLE `chitietdathang`
  ADD PRIMARY KEY (`SoDonDH`,`MSHH`),
  ADD KEY `MSHH` (`MSHH`);

--
-- Chỉ mục cho bảng `dathang`
--
ALTER TABLE `dathang`
  ADD PRIMARY KEY (`SoDonDH`),
  ADD KEY `MSNV` (`MSNV`),
  ADD KEY `MSKH` (`MSKH`);

--
-- Chỉ mục cho bảng `diachikh`
--
ALTER TABLE `diachikh`
  ADD PRIMARY KEY (`MaDC`),
  ADD KEY `MSKH` (`MSKH`);

--
-- Chỉ mục cho bảng `hanghoa`
--
ALTER TABLE `hanghoa`
  ADD PRIMARY KEY (`MSHH`),
  ADD KEY `fk_hanghoa_loaihanghoa` (`MaLoaiHang`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`MSKH`);

--
-- Chỉ mục cho bảng `loaihanghoa`
--
ALTER TABLE `loaihanghoa`
  ADD PRIMARY KEY (`MaLoaiHang`);

--
-- Chỉ mục cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`MSNV`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `diachikh`
--
ALTER TABLE `diachikh`
  MODIFY `MaDC` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `MSKH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitietdathang`
--
ALTER TABLE `chitietdathang`
  ADD CONSTRAINT `chitietdathang_ibfk_1` FOREIGN KEY (`SoDonDH`) REFERENCES `dathang` (`SoDonDH`),
  ADD CONSTRAINT `chitietdathang_ibfk_2` FOREIGN KEY (`MSHH`) REFERENCES `hanghoa` (`MSHH`);

--
-- Các ràng buộc cho bảng `dathang`
--
ALTER TABLE `dathang`
  ADD CONSTRAINT `dathang_ibfk_1` FOREIGN KEY (`MSNV`) REFERENCES `nhanvien` (`MSNV`),
  ADD CONSTRAINT `dathang_ibfk_2` FOREIGN KEY (`MSKH`) REFERENCES `khachhang` (`MSKH`);

--
-- Các ràng buộc cho bảng `diachikh`
--
ALTER TABLE `diachikh`
  ADD CONSTRAINT `diachikh_ibfk_1` FOREIGN KEY (`MSKH`) REFERENCES `khachhang` (`MSKH`);

--
-- Các ràng buộc cho bảng `hanghoa`
--
ALTER TABLE `hanghoa`
  ADD CONSTRAINT `fk_hanghoa_loaihanghoa` FOREIGN KEY (`MaLoaiHang`) REFERENCES `loaihanghoa` (`MaLoaiHang`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
