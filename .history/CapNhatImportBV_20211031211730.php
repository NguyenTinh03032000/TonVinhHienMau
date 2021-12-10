<?php
include "bocuc/Connect.php";

$thongtin = unserialize(urldecode($_GET['thongtin_update']));

echo $thongtin['id_Xoa'];
