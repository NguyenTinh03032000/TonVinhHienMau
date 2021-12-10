<?php
include "bocuc/Connect.php";

$thongtin_apply = unserialize(urldecode($_POST['cboMucTonVinh']));


echo $thongtin_apply['id_nguoihienmau'];
echo "<br>";
echo $thongtin_apply['muctonvinh'];
