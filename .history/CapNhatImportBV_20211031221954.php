<?php
include "bocuc/Connect.php";

$thongtin = $_POST['rbMa'];

// echo $thongtin['id_nguoihienmau'];

foreach ($thongtin as $v) {
    print $v['id_nguoihienmau'];
}
