<?php
include "bocuc/Connect.php";

$thongtin = unserialize(urldecode($_GET['thongtin_Xoa']));

echo $thongtin['id_Xoa'];

// $sql_Xoa = "delete from nguoihienmau where ID_NguoiHienMau = '" . $thongtin['id_Xoa'] . "'";
// $kq_Xoa = mysqli_query($kn, $sqlXoa) or die("Lỗi truy vấn");

// echo '<script type="text/javascript">';
// echo 'alert("Xóa thành công");';
// echo 'window.location.href = "KetQuaImportBV.php?soluongnguoi_excel=' . $thongtin['soluongnguoi_excel'] . '&soluongnguoi_capnhat=' . $thongtin['soluongnguoi_capnhat'] . '";';
// echo '</script>';
