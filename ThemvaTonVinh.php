<?php
include "bocuc/Connect.php";

$id = $_GET['id'];

$sql = "select * from danhsachxulyrieng where ID = '" . $id . "'";
$kq = mysqli_query($kn, $sql) or die("lỗi truy vấn");
$rowDS = mysqli_fetch_array($kq);

$hoten = $rowDS['HoTen'];
$ngaysinh = $rowDS['NgaySinh'];
$nghenghiep = $rowDS['NgheNghiep'];
$sdt = $rowDS['SDT'];
$diachi = $rowDS['DiaChi'];
$nhommau = $rowDS['NhomMau'];
$muctonvinh = $rowDS['MucTonVinh'];
$SLHM = $rowDS['SoLanHienMau'];
$madonvi = $rowDS['MaDonVi'];
$matonvinh = $rowDS['MaTonVinh'];

$sqlDS1 = "insert into nguoihienmau(ID_NguoiHienMau, HoTen, NgaySinh, NgheNghiep, NoiLamViec, SDT, DiaChi, SoLanHienMau, NhomMau, NhomRH)
values ('', '" . $hoten . "', '" . $ngaysinh . "', '" . $nghenghiep . "', '', '" . $sdt . "', '" . $diachi . "', '" . $SLHM . "', '" . $nhommau . "', '')";
$kqDS1 = mysqli_query($kn, $sqlDS1) or die("Lỗi truy vấn1");

$sqlDS2 = "select * from nguoihienmau where HoTen = '" . $hoten . "' and NgaySinh = '" . $ngaysinh . "' and NhomMau = '" . $nhommau . "'";
$kqDS2 = mysqli_query($kn, $sqlDS2) or die("Lỗi truy vấn2");
$rowDS2 = mysqli_fetch_array($kqDS2);
$id_nguoihienmau = $rowDS2['ID_NguoiHienMau'];
$muctonvinh1 = 5;

$sql1 = "insert into danhsachtonvinh (ID, MaTonVinh, ID_NguoiHienMau, MucTonVinh, MaDonVi) 
        values ('', '" . $matonvinh . "', '" . $id_nguoihienmau . "', '" . $muctonvinh1 . "', '" . $madonvi . "')";
$kq1 = mysqli_query($kn, $sql1) or die("Lỗi truy vấn3");

$sql2 = "delete from danhsachxulyrieng where ID = '" . $id . "'";
$kq2 = mysqli_query($kn, $sql2) or die("Lỗi truy vấn delete");

echo '<script type="text/javascript">';
echo 'alert("Đã thêm và tôn vinh thành công");';
echo '</script>';
header('Location: ' . $_SERVER['HTTP_REFERER']);
