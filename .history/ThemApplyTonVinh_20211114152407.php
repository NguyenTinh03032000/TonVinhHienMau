<?php
include "bocuc/Connect.php";

$thongtin_apply = unserialize(urldecode($_POST['cboMucTonVinh']));

foreach ($thongtin_apply as $thongtin) {
    echo $thongtin['id_nguoihienmau'];
    echo "<br>";
    echo $thongtin['muctonvinh'];
}

// echo $thongtin_apply['id_nguoihienmau'];
// echo "<br>";
// echo $thongtin_apply['muctonvinh'];
