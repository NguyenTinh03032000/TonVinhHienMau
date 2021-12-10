<?php
include "bocuc/Connect.php";

$id = $_GET['id'];

$sql2 = "delete from danhsachxulyrieng where ID = '" . $id . "'";
$kq2 = mysqli_query($kn, $sql2) or die("Lỗi truy vấn delete");

echo '<script type="text/javascript">';
echo 'alert("Xóa thành công");';
echo '</script>';
header('Location: ' . $_SERVER['HTTP_REFERER']);
