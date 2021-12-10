<?php
include "bocuc/Connect.php";

$id = $_GET['id'];
$madonvi = $_GET['madonvi'];
$matonvinh = $_GET['matonvinh'];

$sqlDS = "select * from excel_tonvinh where ID = '" . $id . "'";
$kqDS = mysqli_query($kn, $sqlDS) or die("Lỗi truy vấn");
$rowDS = mysqli_fetch_array($kqDS);

$hoten1 = $rowDS['HoTen'];
$ngaysinh1 = $rowDS['NgaySinh'];
$nghenghiep1 = $rowDS['NgheNghiep'];
$sdt1 = $rowDS['SDT'];
$diachi1 = $rowDS['DiaChi'];
$nhommau1 = $rowDS['NhomMau'];
$muctonvinh1 = $rowDS['MucTonVinh'];
$SLHM = $rowDS['SoLanHienMau'];

$sqlDS1 = "insert into danhsachxulyrieng(ID, HoTen, NgaySinh, NgheNghiep, SDT, DiaChi, NhomMau, MucTonVinh, MaDonVi, MaTonVinh, SoLanHienMau)
        values ('', '" . $hoten1 . "', '" . $ngaysinh1 . "', '" . $nghenghiep1 . "', '" . $sdt1 . "', '" . $diachi1 . "', '" . $nhommau1 . "', '" . $muctonvinh1 . "', '" . $madonvi . "', '" . $matonvinh . "', '" . $SLHM . "')";
$kqDS1 = mysqli_query($kn, $sqlDS1) or die("Lỗi truy vấn");


// if ($kqDS1) {

echo '<script type="text/javascript">';
echo 'alert("Đã thêm vào danh sách xử lý riêng");';
echo '</script>';
header('Location: ' . $_SERVER['HTTP_REFERER']);


// } else {
//     header('Location: ' . $_SERVER['HTTP_REFERER']);
//     echo '<script> alert("Lỗi! Không thể thêm vào danh sách xử lý riêng");</script>';
// }

$sqlDS2 = "delete from excel_tonvinh where ID = '" . $id . "'";
$kqDS2 = mysqli_query($kn, $sqlDS2) or die("Lỗi truy vấn xóa");
