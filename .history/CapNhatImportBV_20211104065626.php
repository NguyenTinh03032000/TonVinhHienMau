<?php
include "bocuc/Connect.php";

$thongtin = $thongtin = unserialize(urldecode($_POST['rbMa']));

// echo $thongtin['id_nguoihienmau'];

foreach ($thongtin as $v) {
    print $v['id_nguoihienmau'];
}
