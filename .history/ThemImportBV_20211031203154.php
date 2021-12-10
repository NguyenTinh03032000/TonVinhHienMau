<?php
include "bocuc/Connect.php";

$thongtin = unserialize(urldecode($_GET['nguoihienmau']));

// echo $thongtin['hoten'];
// echo $thongtin['ngaysinh'];

$sqlinsert = "insert into nguoihienmau (ID_NguoiHienMau, HoTen, NgaySinh, NgheNghiep, NoiLamViec, SDT, DiaChi, SoLanHienMau, NhomMau, NhomRH) 
            values('', '" . $thongtin['hoten'] . "', '" . $thongtin['ngaysinh'] . "', '" . $thongtin['nghenghiep'] . "', '" . $thongtin['noilamviec'] . "', '"
    . $thongtin['sdt'] . "', '" . $thongtin['diachi'] . "', '" . $thongtin['solanhienmau'] . "', '" . $thongtin['nhommau'] . "', '" . $thongtin['nhomRH'] . "')";
$kqinsert = mysqli_query($kn, $sqlinsert) or die("Lỗi truy vấn");

echo '<script type="text/javascript">';
echo 'alert("Thêm thành công");';
echo 'window.location.href = "KetQuaImportBV.php?soluongnguoi_excel=' . $thongtin['soluongnguoi_excel'] . '&soluongnguoi_capnhat=' . $thongtin['soluongnguoi_capnhat'] . '";';
echo '</script>';
