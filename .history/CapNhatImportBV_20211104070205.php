<?php
include "bocuc/Connect.php";

$thongtin = unserialize(urldecode($_POST['rbMa']));

// echo $thongtin['id_nguoihienmau'];
// echo $thongtin['id_excel'];

$sql_Update = "update nguoihienmau set SoLanHienMau = '" . $thongtin['solanhienmau'] . "' where ID_NguoiHienMau = '" . $thongtin['id_nguoihienmau'] . "'";
$kq_Update = mysqli_query($kn, $sql_Update) or die("Lỗi truy vấn");

$sqldelete = "delete from excel_benhvien where ID = '" . $thongtin['id_excel'] . "'";
$kqdelete = mysqli_query($kn, $sqldelete) or die("Lỗi truy vấn");

echo '<script type="text/javascript">';
echo 'alert("Xóa thành công");';
echo 'window.location.href = "KetQuaImportBV.php?soluongnguoi_excel=' . $thongtin['soluongnguoi_excel'] . '&soluongnguoi_capnhat=' . $thongtin['soluongnguoi_capnhat'] . '";';
echo '</script>';
