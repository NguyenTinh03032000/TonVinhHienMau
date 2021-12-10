<?php
include "bocuc/Connect.php";

$thongtin = unserialize(urldecode($_GET['nguoihienmau']));
if ($thongtin['soLanHienMau_excel'] > $thongtin['soLanHienMau_database']) {
    // $sql4 = "UPDATE nguoihienmau SET SoLanHienMau= '" . $row['SoLanHienMau'] . "' WHERE HoTen='" . $row['HoTen'] . "' and NgaySinh='" . $row['NgaySinh'] . "' and NhomMau='" . $row['NhomMau'] . "'";
    // $sql5 = "INSERT INTO danhsachtonvinh(MaTonVinh, ID_NguoiHienMau, MucTonVinh, MaDonVi) VALUES ('" . $matonvinh . "','" . $row1['ID_NguoiHienMau'] . "','" . $cboMucTonVinh . "','" . $madonvi . "')";
    // $kq4 = mysqli_query($kn, $sql4) or die("Lỗi truy vấn1");
    // $kq5 = mysqli_query($kn, $sql5) or die("Lỗi truy vấn2");
    // } else {
    echo "MUC TV: " . $thongtin['muctonvinh'];
}
