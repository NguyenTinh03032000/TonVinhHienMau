-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 10, 2021 lúc 09:38 AM
-- Phiên bản máy phục vụ: 10.4.18-MariaDB
-- Phiên bản PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `tonvinhhienmau`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhsachtonvinh`
--

CREATE TABLE `danhsachtonvinh` (
  `ID` int(20) NOT NULL,
  `MaTonVinh` varchar(20) COLLATE utf8_vietnamese_ci NOT NULL,
  `ID_NguoiHienMau` int(20) NOT NULL,
  `MucTonVinh` int(3) NOT NULL,
  `MaDonVi` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `danhsachtonvinh`
--

INSERT INTO `danhsachtonvinh` (`ID`, `MaTonVinh`, `ID_NguoiHienMau`, `MucTonVinh`, `MaDonVi`) VALUES
(29, '10-2021', 1, 5, 1),
(31, '11-2021', 4, 5, 1),
(32, '11-2021', 55, 5, 1),
(33, '10-2021', 10, 5, 1),
(34, '11-2021', 10, 10, 1),
(39, '11-2021', 2, 5, 19),
(40, '10-2021', 7, 5, 6),
(41, '11-2021', 7, 10, 6),
(43, '11-2021', 63, 5, 1),
(44, '11-2021', 64, 5, 1),
(45, '11-2021', 65, 5, 1),
(46, '11-2021', 66, 5, 1),
(47, '11-2021', 67, 5, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhsachxulyrieng`
--

CREATE TABLE `danhsachxulyrieng` (
  `ID` int(20) NOT NULL,
  `HoTen` text COLLATE utf8_vietnamese_ci NOT NULL,
  `NgaySinh` date NOT NULL,
  `NgheNghiep` text COLLATE utf8_vietnamese_ci NOT NULL,
  `SDT` varchar(20) COLLATE utf8_vietnamese_ci NOT NULL,
  `DiaChi` text COLLATE utf8_vietnamese_ci NOT NULL,
  `NhomMau` varchar(20) COLLATE utf8_vietnamese_ci NOT NULL,
  `MucTonVinh` int(4) NOT NULL,
  `MaDonVi` varchar(20) COLLATE utf8_vietnamese_ci NOT NULL,
  `MaTonVinh` varchar(20) COLLATE utf8_vietnamese_ci NOT NULL,
  `SoLanHienMau` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `danhsachxulyrieng`
--

INSERT INTO `danhsachxulyrieng` (`ID`, `HoTen`, `NgaySinh`, `NgheNghiep`, `SDT`, `DiaChi`, `NhomMau`, `MucTonVinh`, `MaDonVi`, `MaTonVinh`, `SoLanHienMau`) VALUES
(49, 'Trần Xuân Lưu Ly', '1991-11-27', 'Lái xe', '', 'Thôn 2, Thị trấn An Lão, huyện An Lão', 'O', 5, '1', '11-2021', 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donvi`
--

CREATE TABLE `donvi` (
  `madonvi` int(20) NOT NULL,
  `tendonvi` text COLLATE utf8_vietnamese_ci NOT NULL,
  `create_at` datetime NOT NULL,
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `donvi`
--

INSERT INTO `donvi` (`madonvi`, `tendonvi`, `create_at`, `update_at`) VALUES
(1, 'Thành phố Quy Nhơn', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Thị xã An Nhơn', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Huyện Tuy Phước', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Huyện Phù Cát', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Huyện Phù Mỹ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Thị xã Hoài Nhơn', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Huyện Hoài Ân', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Huyện Tây Sơn', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'Huyện Vân Canh', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'Huyện Vĩnh Thạnh', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'Huyện An Lão', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'Liên đoàn Lao động tỉnh', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'Đoàn khối Các cơ quan tỉnh', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'Đoàn khối Doanh nghiệp tỉnh', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'Trường Đại học Quy Nhơn', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 'Trường Đại học Quang Trung', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 'Trường CĐ Kỹ thuật Công nghệ Quy Nhơn', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 'Trường CĐ Y tế Bình Định', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 'Trường Cao đẳng Bình Định', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 'Trường CĐ Nghề CĐ-XĐ &Nông Lâm Trung bộ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 'Câu lạc bộ 25 - Hội CTĐ tỉnh', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 'Trung đoàn KQ 925', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 'Công an tỉnh Bình Định', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 'BVĐK tỉnh, bệnh viện chuyên khoa & các BV TW trên địa bàn Quy Nhơn', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 'Trung đoàn Cảnh sát cơ động Nam Trung bộ  E23', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 'Hành trình đỏ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 'Các ĐV ngoài kế hoạch và HMTN đột xuất', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `excel_benhvien`
--

CREATE TABLE `excel_benhvien` (
  `ID` int(20) NOT NULL,
  `HoTen` text COLLATE utf8_vietnamese_ci NOT NULL,
  `NgaySinh` date NOT NULL,
  `NgheNghiep` text COLLATE utf8_vietnamese_ci NOT NULL,
  `NoiLamViec` text COLLATE utf8_vietnamese_ci NOT NULL,
  `SDT` varchar(20) COLLATE utf8_vietnamese_ci NOT NULL,
  `DiaChi` text COLLATE utf8_vietnamese_ci NOT NULL,
  `SoLanHienMau` int(2) NOT NULL,
  `NhomMau` varchar(20) COLLATE utf8_vietnamese_ci NOT NULL,
  `Nhom_RH` varchar(20) COLLATE utf8_vietnamese_ci NOT NULL,
  `TenFile` text COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `excel_tonvinh`
--

CREATE TABLE `excel_tonvinh` (
  `ID` int(20) NOT NULL,
  `HoTen` text COLLATE utf8_vietnamese_ci NOT NULL,
  `NgaySinh` date NOT NULL,
  `NgheNghiep` text COLLATE utf8_vietnamese_ci NOT NULL,
  `SDT` varchar(20) COLLATE utf8_vietnamese_ci NOT NULL,
  `DiaChi` text COLLATE utf8_vietnamese_ci NOT NULL,
  `NhomMau` varchar(20) COLLATE utf8_vietnamese_ci NOT NULL,
  `MucTonVinh` int(4) NOT NULL,
  `MaDonVi` varchar(20) COLLATE utf8_vietnamese_ci NOT NULL,
  `MaTonVinh` varchar(20) COLLATE utf8_vietnamese_ci NOT NULL,
  `TenFile` text COLLATE utf8_vietnamese_ci NOT NULL,
  `SoLanHienMau` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `excel_tonvinh`
--

INSERT INTO `excel_tonvinh` (`ID`, `HoTen`, `NgaySinh`, `NgheNghiep`, `SDT`, `DiaChi`, `NhomMau`, `MucTonVinh`, `MaDonVi`, `MaTonVinh`, `TenFile`, `SoLanHienMau`) VALUES
(114, 'Phạm Thị Chương', '2000-09-16', 'Nhân viên thư viện', '', 'Trường Tiểu học An Tân, huyện An Lão', 'B', 5, '1', '11-2021', 'Danh sách đề nghị tôn vinh HMTN 2021 (Từ cơ sở gửi lên) (Demo).xlsx', 5),
(116, 'Đinh Văn Hạnh', '1970-11-15', 'Công an', '', 'Công an huyện An Lão', 'O', 5, '1', '11-2021', 'Danh sách đề nghị tôn vinh HMTN 2021 (Từ cơ sở gửi lên) (Demo).xlsx', 7),
(118, 'Đinh Văn Hạnh', '1990-12-16', 'Công an', '', 'Công an huyện An Lão', 'A', 5, '1', '11-2021', 'Danh sách đề nghị tôn vinh HMTN 2021 (Từ cơ sở gửi lên) (Demo).xlsx', 6),
(121, 'Đinh Văn Lưu Ly', '1988-06-27', '', '', 'Thôn 1, xã An Dũng, huyện An Lão', 'O', 5, '1', '11-2021', 'Danh sách đề nghị tôn vinh HMTN 2021 (Từ cơ sở gửi lên) (Demo).xlsx', 5),
(122, 'Trần Văn Hải', '1997-10-27', 'Giáo viên', '', 'Trường PTDT Bán trú Đinh Ruối, huyện An Lão', 'O', 5, '1', '11-2021', 'Danh sách đề nghị tôn vinh HMTN 2021 (Từ cơ sở gửi lên) (Demo).xlsx', 5),
(124, 'Đinh Văn Hiệp', '1993-12-15', 'Giáo viên', '', 'Trường PTDT Bán trú An Lão, huyện An Lão', 'B', 5, '1', '11-2021', 'Danh sách đề nghị tôn vinh HMTN 2021 (Từ cơ sở gửi lên) (Demo).xlsx', 5),
(134, 'Đinh Thị Chiến', '1975-08-29', 'Nông', '', 'Thôn 7, Thị trấn An Lão, huyện An Lão', 'O', 5, '1', '11-2021', 'Danh sách đề nghị tôn vinh HMTN 2021 (Từ cơ sở gửi lên) (Demo).xlsx', 5),
(136, 'Đinh Thị Ngân', '1984-10-21', 'Nông', '', 'Thôn 2, An Vinh, huyện An Lão', 'A', 5, '1', '11-2021', 'Danh sách đề nghị tôn vinh HMTN 2021 (Từ cơ sở gửi lên) (Demo).xlsx', 5),
(137, 'Đinh Văn Trế', '1979-01-01', 'Cán bộ', '', 'Thôn 3, An Vinh, huyện An Lão', 'O', 5, '1', '11-2021', 'Danh sách đề nghị tôn vinh HMTN 2021 (Từ cơ sở gửi lên) (Demo).xlsx', 5),
(138, 'Đinh Văn Lĩnh', '1990-01-01', 'Cán bộ', '', 'Thôn 5, An Vinh, huyện An Lão', 'B', 10, '1', '11-2021', 'Danh sách đề nghị tôn vinh HMTN 2021 (Từ cơ sở gửi lên) (Demo).xlsx', 10),
(139, 'Huỳnh Văn Chương', '1981-01-01', 'Viên chức', '', 'Trung tâm Y tế huyện An Lão', 'O', 20, '1', '11-2021', 'Danh sách đề nghị tôn vinh HMTN 2021 (Từ cơ sở gửi lên) (Demo).xlsx', 21),
(140, 'Đinh Văn Dân', '1992-01-01', 'Viên chức', '', 'Trung tâm Y tế huyện An Lão', 'O', 5, '1', '11-2021', 'Danh sách đề nghị tôn vinh HMTN 2021 (Từ cơ sở gửi lên) (Demo).xlsx', 5),
(141, 'Trương Ngọc Lưu Ly', '1986-01-01', 'Nông', '', 'Xã An Tân, huyện An Lão', 'O', 10, '1', '11-2021', 'Danh sách đề nghị tôn vinh HMTN 2021 (Từ cơ sở gửi lên) (Demo).xlsx', 10),
(142, 'Đinh Văn Hồng', '1982-01-01', 'Cán bộ', '', 'Thôn 1, An Hưng, An Lão', 'B', 15, '1', '11-2021', 'Danh sách đề nghị tôn vinh HMTN 2021 (Từ cơ sở gửi lên) (Demo).xlsx', 15),
(143, 'Đinh Văn Dấp', '1992-01-01', 'Cán bộ', '', 'Thôn 1, An Hưng, An Lão', 'AB', 5, '1', '11-2021', 'Danh sách đề nghị tôn vinh HMTN 2021 (Từ cơ sở gửi lên) (Demo).xlsx', 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `muctonvinh`
--

CREATE TABLE `muctonvinh` (
  `ID` int(20) NOT NULL,
  `TenMuc` text COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `muctonvinh`
--

INSERT INTO `muctonvinh` (`ID`, `TenMuc`) VALUES
(0, 'Không tôn vinh'),
(5, 'Mức 5'),
(10, 'Mức 10'),
(15, 'Mức 15'),
(20, 'Mức 20'),
(30, 'Mức 30'),
(40, 'Mức 40'),
(50, 'Mức 50'),
(60, 'Mức 60'),
(70, 'Mức 70');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nguoihienmau`
--

CREATE TABLE `nguoihienmau` (
  `ID_NguoiHienMau` int(20) NOT NULL,
  `HoTen` text COLLATE utf8_vietnamese_ci NOT NULL,
  `NgaySinh` date NOT NULL,
  `NgheNghiep` text COLLATE utf8_vietnamese_ci NOT NULL,
  `NoiLamViec` text COLLATE utf8_vietnamese_ci NOT NULL,
  `SDT` varchar(20) COLLATE utf8_vietnamese_ci NOT NULL,
  `DiaChi` text COLLATE utf8_vietnamese_ci NOT NULL,
  `SoLanHienMau` int(3) NOT NULL,
  `NhomMau` varchar(10) COLLATE utf8_vietnamese_ci NOT NULL,
  `NhomRH` text COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `nguoihienmau`
--

INSERT INTO `nguoihienmau` (`ID_NguoiHienMau`, `HoTen`, `NgaySinh`, `NgheNghiep`, `NoiLamViec`, `SDT`, `DiaChi`, `SoLanHienMau`, `NhomMau`, `NhomRH`) VALUES
(1, 'Phạm Thị Chương', '2000-09-16', 'Cán bộ CNV nhà nước', 'PHÙ MỸ BÌNH ĐỊNH', '0387497333', 'Trường Tiểu học An Tân, huyện An Lão', 5, 'B', 'Rh(dương)'),
(2, 'Trần Đức Tấn', '1965-01-20', 'Giáo viên', 'THPT SỐ 1 PHÙ MỸ', '', 'Công an huyện An Lão', 5, 'AB', 'Rh(dương)'),
(3, 'Đinh Văn Hạnh', '1970-11-15', 'Khác', 'PHÙ MỸ - BÌNH ĐỊNH', '', 'Công an huyện An Lão', 10, 'O', 'Rh(dương)'),
(4, 'Trần Kim Thành ', '1985-05-07', 'Cán bộ CNV nhà nước', 'TRƯỜNG THPT BÌNH DƯƠNG PHÙ MỸ', '', 'Công an huyện An Lão', 6, 'O', 'Rh(dương)'),
(5, 'Đinh Văn Hạnh', '1990-12-16', 'Nông dân', 'PHÙ MỸ BÌNH ĐỊNH', '', 'Công an huyện An Lão', 7, 'A', 'Rh(dương)'),
(6, 'Trần Duy Tấn', '1990-12-16', 'Giáo viên', 'PHÙ MỸ BÌNH ĐỊNH', '', 'Công an huyện An Lão', 10, 'O', 'Rh(dương)'),
(7, 'Đoàn Nhật Lênh', '1995-07-06', 'Khác', 'PHÙ MỸ BÌNH ĐỊNH', '', 'Công an huyện An Lão', 12, 'B', 'Rh(dương)'),
(8, 'Đinh Văn Lưu Ly', '1988-06-27', 'Khác', 'PHÙ MỸ - BÌNH ĐỊNH', '', 'Thôn 1, xã An Dũng, huyện An Lão', 9, 'O', 'Rh(dương)'),
(9, 'Trần Văn Hải', '1997-10-27', 'Khác', 'PHÙ MỸ BÌNH ĐỊNH', '', 'Trường PTDT Bán trú Đinh Ruối, huyện An Lão', 7, 'O', 'Rh(dương)'),
(10, 'Trần Thị Tiềm', '1991-10-10', 'Công an', 'PHÙ MỸ BÌNH ĐỊNH', '', 'Trường PTDT Bán trú Đinh Ruối, huyện An Lão', 16, 'O', 'Rh(dương)'),
(11, 'Đinh Văn Hiệp', '1993-12-15', 'Cán bộ CNV nhà nước', 'PHÙ MỸ BÌNH ĐỊNH', '', 'Trường PTDT Bán trú An Lão, huyện An Lão', 7, 'B', 'Rh(dương)'),
(55, 'Đinh Văn Chiến', '1983-10-01', 'Giáo viên', '', '', 'Trường PTDT Bán trú An Lão, huyện An Lão', 5, 'B', ''),
(63, 'Đinh Văn Lộc', '1980-07-20', 'Bảo vệ', '', '', 'Trường Tiểu học An Trung, huyện An Lão', 5, 'O', ''),
(64, 'Nguyễn Thành Lĩnh', '1990-02-16', 'Nông', '', '', 'Thôn Thanh Sơn, An Tân, An Lão', 5, 'B', ''),
(65, 'Lê Thị Dấp', '1982-09-20', 'Nông', '', '', 'Thôn 9, Thị trấn An Lão, huyện An Lão', 5, 'B', ''),
(66, 'Đinh Thị Ếch', '1977-01-22', 'Giáo viên', '', '', 'Trường Mẫu giáo An Vinh, huyện An Lão', 7, 'O', ''),
(67, 'Trần Duy Tấn', '1999-08-25', 'Công an', '', '', 'Công an huyện An Lão', 9, 'O', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tk_canbo`
--

CREATE TABLE `tk_canbo` (
  `username` varchar(20) COLLATE utf8_vietnamese_ci NOT NULL,
  `hoten` text COLLATE utf8_vietnamese_ci NOT NULL,
  `ngaysinh` date NOT NULL,
  `diachi` text COLLATE utf8_vietnamese_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_vietnamese_ci NOT NULL,
  `email` varchar(1000) COLLATE utf8_vietnamese_ci NOT NULL,
  `sdt` varchar(20) COLLATE utf8_vietnamese_ci NOT NULL,
  `quyen` int(2) NOT NULL,
  `create_at` datetime NOT NULL,
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `tk_canbo`
--

INSERT INTO `tk_canbo` (`username`, `hoten`, `ngaysinh`, `diachi`, `password`, `email`, `sdt`, `quyen`, `create_at`, `update_at`) VALUES
('1', 'abc', '0000-00-00', '23', 'dCS3HXiRj6NsFc3bjVzK', 'abc@gmail.com', '147895', 1, '2030-10-21 11:39:48', '0000-00-00 00:00:00'),
('admin_hienmau', 'admin_hienmau', '2021-10-25', 'Phù Mỹ', 'admin_hienmau', 'admin_hienmau@gmail.com', '01647512558', 0, '2021-10-23 14:19:51', '2021-10-23 14:19:51');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tonvinh`
--

CREATE TABLE `tonvinh` (
  `matonvinh` varchar(20) COLLATE utf8_vietnamese_ci NOT NULL,
  `ngaytonvinh` date NOT NULL,
  `create_at` date NOT NULL,
  `update_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `tonvinh`
--

INSERT INTO `tonvinh` (`matonvinh`, `ngaytonvinh`, `create_at`, `update_at`) VALUES
('10-2021', '2021-10-24', '2021-10-24', '0000-00-00'),
('11-2021', '2021-11-17', '2021-11-17', '0000-00-00'),
('7-2021', '2021-07-07', '2021-11-03', '2021-11-17'),
('8-2021', '2021-08-11', '2021-11-17', '2021-11-11'),
('9-2021', '2021-09-16', '0000-00-00', '0000-00-00');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `danhsachtonvinh`
--
ALTER TABLE `danhsachtonvinh`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_matonvinh` (`MaTonVinh`),
  ADD KEY `fk+manguoihienmau` (`ID_NguoiHienMau`),
  ADD KEY `fk_madonvi` (`MaDonVi`);

--
-- Chỉ mục cho bảng `danhsachxulyrieng`
--
ALTER TABLE `danhsachxulyrieng`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `donvi`
--
ALTER TABLE `donvi`
  ADD PRIMARY KEY (`madonvi`);

--
-- Chỉ mục cho bảng `excel_benhvien`
--
ALTER TABLE `excel_benhvien`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `excel_tonvinh`
--
ALTER TABLE `excel_tonvinh`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_tonvinh` (`MaTonVinh`);

--
-- Chỉ mục cho bảng `muctonvinh`
--
ALTER TABLE `muctonvinh`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `nguoihienmau`
--
ALTER TABLE `nguoihienmau`
  ADD PRIMARY KEY (`ID_NguoiHienMau`);

--
-- Chỉ mục cho bảng `tk_canbo`
--
ALTER TABLE `tk_canbo`
  ADD PRIMARY KEY (`username`);

--
-- Chỉ mục cho bảng `tonvinh`
--
ALTER TABLE `tonvinh`
  ADD PRIMARY KEY (`matonvinh`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `danhsachtonvinh`
--
ALTER TABLE `danhsachtonvinh`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT cho bảng `danhsachxulyrieng`
--
ALTER TABLE `danhsachxulyrieng`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT cho bảng `donvi`
--
ALTER TABLE `donvi`
  MODIFY `madonvi` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT cho bảng `excel_benhvien`
--
ALTER TABLE `excel_benhvien`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT cho bảng `excel_tonvinh`
--
ALTER TABLE `excel_tonvinh`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT cho bảng `nguoihienmau`
--
ALTER TABLE `nguoihienmau`
  MODIFY `ID_NguoiHienMau` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `danhsachtonvinh`
--
ALTER TABLE `danhsachtonvinh`
  ADD CONSTRAINT `fk+manguoihienmau` FOREIGN KEY (`ID_NguoiHienMau`) REFERENCES `nguoihienmau` (`ID_NguoiHienMau`),
  ADD CONSTRAINT `fk_madonvi` FOREIGN KEY (`MaDonVi`) REFERENCES `donvi` (`madonvi`),
  ADD CONSTRAINT `fk_matonvinh` FOREIGN KEY (`MaTonVinh`) REFERENCES `tonvinh` (`matonvinh`) ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `excel_tonvinh`
--
ALTER TABLE `excel_tonvinh`
  ADD CONSTRAINT `fk_tonvinh` FOREIGN KEY (`MaTonVinh`) REFERENCES `tonvinh` (`matonvinh`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
