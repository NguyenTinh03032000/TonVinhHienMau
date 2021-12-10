<?php
include "bocuc/Connect.php";

$thongtin = unserialize(urldecode($_GET['nguoihienmau']));

// echo $thongtin['id_Xoa'];

$sql_Xoa = "delete from excel_benhvien where ID = '" . $thongtin['id_excel'] . "'";
$kq_Xoa = mysqli_query($kn, $sql_Xoa) or die("Lỗi truy vấn");

echo '<script type="text/javascript">';
echo 'alert("Xóa thành công");';
echo 'window.location.href = "KetQuaImportBV.php?soluongnguoi_excel=' . $thongtin['soluongnguoi_excel'] . '&soluongnguoi_capnhat=' . $thongtin['soluongnguoi_capnhat'] . '";';
echo '</script>';
