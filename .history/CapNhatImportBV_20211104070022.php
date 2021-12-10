<?php
include "bocuc/Connect.php";

$thongtin = unserialize(urldecode($_POST['rbMa']));

// echo $thongtin['id_nguoihienmau'];
// echo $thongtin['id_excel'];

$sql_Xoa = "update nguoihienmau set SoLanHienMau = '" . $thongtin['solanhienmau'] . "'
                            where ID_NguoiHienMau = '" . $thongtin['id_Xoa'] . "'";
$kq_Xoa = mysqli_query($kn, $sql_Xoa) or die("Lỗi truy vấn");

echo '<script type="text/javascript">';
echo 'alert("Xóa thành công");';
echo 'window.location.href = "KetQuaImportBV.php?soluongnguoi_excel=' . $thongtin['soluongnguoi_excel'] . '&soluongnguoi_capnhat=' . $thongtin['soluongnguoi_capnhat'] . '";';
echo '</script>';
