<?php
include "bocuc/Connect.php";

$id_tonvinh = $_GET['id_tonvinh'];
$muctonvinh = $_GET['muctonvinh'];
$sql = "update danhsachtonvinh set MucTonVinh='" . $muctonvinh . "' where ID='" . $id_tonvinh . "'";
$kq = mysqli_query($kn, $sql);
if ($kq) {
    echo '<script type="text/javascript">';
    echo 'alert("Cập nhật thành công");';
    echo 'window.location.href = "DuyetTonVinh.php";';
    echo '</script>';
} else {
    echo '<script type="text/javascript">';
    echo 'alert("Cập nhật thất bại");';
    echo 'window.location.href = "DuyetTonVinh.php";';
    echo '</script>';
}
