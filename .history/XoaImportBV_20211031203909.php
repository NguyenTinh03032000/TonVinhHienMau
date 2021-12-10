<?php
include "bocuc/Connect.php";

$id_Xoa = $_GET['id_Xoa'];

$sql_Xoa = "delete from nguoihienmau where ID_NguoiHienMau = '" . $id_Xoa . "'";
$kq_Xoa = mysqli_query($kn, $sqlXoa) or die("Lỗi truy vấn");

echo '<script type="text/javascript">';
echo 'alert("Xóa thành công");';
echo 'window.location.href = "KetQuaImportBV.php?soluongnguoi_excel=' . $thongtin['soluongnguoi_excel'] . '&soluongnguoi_capnhat=' . $thongtin['soluongnguoi_capnhat'] . '";';
echo '</script>';
