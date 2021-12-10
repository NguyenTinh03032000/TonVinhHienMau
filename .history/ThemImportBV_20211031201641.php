<?php

$thongtin = unserialize(urldecode($_GET['nguoihienmau']));

echo $thongtin['hoten'];
echo $thongtin['ngaysinh'];
