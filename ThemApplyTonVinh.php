<?php
include "bocuc/Connect.php";


$id_nguoihienmau = $_GET['id_nguoihienmau'];
$muctonvinh = $_GET['muctonvinh'];
$matonvinh = $_GET['matonvinh'];
$madonvi = $_GET['madonvi'];
$hoten = $_GET['hoten'];
$ngaysinh = $_GET['ngaysinh'];
$nhommau = $_GET['nhommau'];
$solanhienmau_excel = $_GET['solanhienmau_excel'];
$solanhienmau = $_GET['solanhienmau'];

$sql = "insert into danhsachtonvinh (ID, MaTonVinh, ID_NguoiHienMau, MucTonVinh, MaDonVi) 
        values ('', '" . $matonvinh . "', '" . $id_nguoihienmau . "', '" . $muctonvinh . "', '" . $madonvi . "')";
$kq = mysqli_query($kn, $sql) or die("Lỗi truy vấn");

if ($solanhienmau_excel > $solanhienmau) {
    $sql1 = "update nguoihienmau set SoLanHienMau = '" . $solanhienmau_excel . "' where ID_NguoiHienMau = '" . $id_nguoihienmau . "'";
    $kq1 = mysqli_query($kn, $sql1) or die("Lỗi truy vấn");
}

$sql2 = "delete from excel_tonvinh where HoTen = '" . $hoten . "' and NgaySinh = '" . $ngaysinh . "' and NhomMau = '" . $nhommau . "'";
$kq2 = mysqli_query($kn, $sql2) or die("Lỗi truy vấn ");



echo '<script type="text/javascript">';
echo 'alert("Đã đưa vào danh sách tôn vinh");';
echo '</script>';
header('Location: ' . $_SERVER['HTTP_REFERER']);
