<?php
include "bocuc/Connect.php";

$thongtin_apply = unserialize(urldecode($_POST['muctonvinh']));

echo $thongtin_apply['id_nguoihienmau'];
echo $thongtin['muctonvinh'];
