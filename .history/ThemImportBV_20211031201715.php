<?php
include "bocuc/Connect.php";

$thongtin = unserialize(urldecode($_GET['nguoihienmau']));

echo $thongtin['hoten'];
echo $thongtin['ngaysinh'];

$sqlinsert = "insert into nguoihienmau (ID_NguoiHienMau, HoTen, NgaySinh, NgheNghiep, NoiLamViec, SDT, DiaChi, SoLanHienMau, NhomMau, NhomRH) 
                        values('', '" . $cot2 . "', '" . $date . "', '" . $cot7 . "', '" . $cot9 . "', '" . $cot11 . "', '" . $cot12 . "', '" . $cot16 . "', '" . $cot21 . "', '" . $cot22 . "')";
$kqinsert = mysqli_query($kn, $sqlinsert) or die("Lỗi truy vấn 4");
