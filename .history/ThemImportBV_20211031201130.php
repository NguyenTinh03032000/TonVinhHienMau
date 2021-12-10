<?php

$var = unserialize(urldecode($_GET['nguoihienmau']));

echo $var['hoten'];
