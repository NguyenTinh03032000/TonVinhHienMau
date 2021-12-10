<?php
include "bocuc/Connect.php";
require_once 'vendor/autoload.php';
// require_once 'config.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

$file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

if (isset($_FILES['fileThemDV']['name']) && in_array($_FILES['fileThemDV']['type'], $file_mimes)) {
    $arr_file = explode('.', $_FILES['fileThemDV']['name']);
    $extension = end($arr_file);
    $txtMDV = $_POST['txtMDV'];
    $txtMTV = $_POST['txtMTV'];

    if ('csv' == $extension) {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
    } else if ('xlsx' == $extension) {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    }

    $spreadsheet = $reader->load($_FILES['fileThemDV']['tmp_name']);

    $sheetData = $spreadsheet->getActiveSheet(0)->toArray();

    // $tenfile = $_FILES['fileBenhVien']['name'];

    // echo $tenfile;

    if (!empty($sheetData)) {
        for ($i = 1; $i < count($sheetData); $i++) {
            $hoten = $sheetData[$i][1];
            $ngaysinh1 = $sheetData[$i][5];
            $nghenghiep = $sheetData[$i][6];
            $sdt = $sheetData[$i][10];
            $diachi = $sheetData[$i][11];
            $nhommau = $sheetData[$i][20];

            $maDV = $txtMDV;
            $maTV = $txtMTV;
            $file = $_FILES['fileThemDV']['name'];
            $solanHM = $sheetData[$i][15];

            if ($solanHM < 5) {
                $muctonvinh = 0;
            }
            if ($solanHM >= 5 && $solanHM < 10) {
                $muctonvinh = 5;
            }
            if ($solanHM >= 10 && $solanHM < 15) {
                $muctonvinh = 10;
            }
            if ($solanHM >= 15 && $solanHM < 20) {
                $muctonvinh = 20;
            }
            $ngaysinh = explode("/", $ngaysinh1);
            $ngay = array_shift($ngaysinh);
            $nam = array_pop($ngaysinh);
            $thang = implode("/", $ngaysinh);

            $date = $nam . "-" . $thang . "-" . $ngay;

            if ($sheetData[$i][0] != "" and $sheetData[$i][0] != "STT") {
                // echo $cot1 . " - " . $cot2 . " - " . $date . " - " . $cot7 . " - " . $cot9 . " - " . $cot11 . " - " . $cot12 . " - " . $cot16 . " - " .
                //     $cot17 . " - " . $cot19 . " - " . $cot20 . " - " . $cot21 . " - " . $cot22 . " - " . $tenfile . "<br>";

                $sql = "insert into excel_tonvinh (ID, HoTen, NgaySinh, NgheNghiep, SDT, DiaChi, NhomMau, MucTonVinh, MaDonVi, MaTonVinh, TenFile, SoLanHienMau, create_at, update_at)
                values ('', '" . $hoten . "', '" . $date . "', '" . $nghenghiep . "', '" . $sdt . "', '" . $diachi . "', '" . $nhommau . "', '" . $muctonvinh . "', '" . $maDV . "', '" . $maTV . "', '" . $file . "', '" . $solanHM . "', '','')";
                $kq = mysqli_query($kn, $sql);
            }
        }

        if ($kq) {
            echo '<script type="text/javascript">';
            echo 'alert("Thêm thành công");';
            echo 'window.location.href = "quanlynhapxuat.php";';
            echo '</script>';
        } else {
            echo '<script type="text/javascript">';
            echo 'alert("Không thể thêm thông tin. Vui lòng thử lại sau!!!");';
            echo 'window.location.href = "quanlynhapxuat.php";';
            echo '</script>';
        }
    }
} else {
    echo '<script type="text/javascript">';
    echo 'alert("Upload only CSV or Excel file");';
    echo 'window.location.href = "quanlynhapxuat.php";';
    echo '</script>';
}
