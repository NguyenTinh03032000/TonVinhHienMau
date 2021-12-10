<?php
require_once 'vendor/autoload.php';
// require_once 'config.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

$file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

if (isset($_FILES['fileThemDV']['name']) && in_array($_FILES['fileThemDV']['type'], $file_mimes)) {
    $arr_file = explode('.', $_FILES['fileThemDV']['name']);
    $extension = end($arr_file);

    if ('csv' == $extension) {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
    } else if ('xlsx' == $extension) {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    }

    $spreadsheet = $reader->load($_FILES['fileThemDV']['tmp_name']);

    $sheetData = $spreadsheet->getActiveSheet()->toArray();

    // $tenfile = $_FILES['fileBenhVien']['name'];

    // echo $tenfile;

    if (!empty($sheetData)) {
        for ($i = 1; $i < count($sheetData); $i++) {
            $cot1 = $sheetData[$i][0];
            $cot2 = $sheetData[$i][1];
            $cot3 = $sheetData[$i][2];
            $cot4 = $sheetData[$i][3];
            $cot5 = $sheetData[$i][4];
            $cot6 = $sheetData[$i][5];
            $cot7 = $sheetData[$i][6];
            $cot8 = $sheetData[$i][7];
            $cot9 = $sheetData[$i][8];
            $cot10 = $sheetData[$i][9];
            $cot11 = $sheetData[$i][10];
            $cot12 = $sheetData[$i][11];
            $cot13 = $sheetData[$i][12];
            $cot14 = $sheetData[$i][13];
            $cot15 = $sheetData[$i][14];
            $cot16 = $sheetData[$i][15];
            $cot17 = $sheetData[$i][16];
            $cot18 = $sheetData[$i][17];
            $cot19 = $sheetData[$i][18];
            $cot20 = $sheetData[$i][19];
            $cot21 = $sheetData[$i][20];
            $cot22 = $sheetData[$i][21];
            $cot23 = $sheetData[$i][22];


            // $sql = "INSERT INTO USERS(name, email) VALUES('$name', '$email')";

            // if (mysqli_query($conn, $sql)) {
            //     echo "New record created successfully";
            // } else {
            //     echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            // }
            if ($cot1 != "") {
                echo $cot1 . " - " . $cot2 . " - " . $cot3 . " - " . $cot4 . " - " . $cot5 . " - " . $cot6 . " - " . $cot7 . " - " .
                    $cot8 . " - " . $cot9 . " - " . $cot10 . " - " . $cot11 . " - " . $cot12 . " - " . $cot13 . " - " . $cot14 . " - " . $cot15 . " - " .
                    $cot15 . " - " . $cot17 . " - " . $cot18 . " - " . $cot19 . " - " . $cot20 . " - " . $cot21 . " - " . $cot22 . " - " . $cot23 . "<br>";
            }
        }
    }
} else {
    echo "Upload only CSV or Excel file.";
}
