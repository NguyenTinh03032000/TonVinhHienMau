<?php
include "bocuc/Connect.php";
require_once 'vendor/autoload.php';
// require_once 'config.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Xls;

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
    } elseif ('xls' == $extension) {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
    }

    $spreadsheet = $reader->load($_FILES['fileThemDV']['tmp_name']);

    $sheetData = $spreadsheet->getActiveSheet(1)->toArray();

    // $tenfile = $_FILES['fileBenhVien']['name'];

    // echo $tenfile;


    if (!empty($sheetData)) {
        for ($i = 1; $i < count($sheetData); $i++) {
            $cot0 = $sheetData[$i][0];
            $hoten = $sheetData[$i][1];
            $ngaysinh = $sheetData[$i][2];
            $thangsinh = $sheetData[$i][3];
            $namsinh = $sheetData[$i][4];
            $nghenghiep = $sheetData[$i][7];
            $sdt = $sheetData[$i][6];
            $diachi = $sheetData[$i][8];
            $nhommau = $sheetData[$i][5];

            $maDV = $txtMDV;
            $maTV = $txtMTV;
            $file = $_FILES['fileThemDV']['name'];

            $muc5 =  $sheetData[$i][9];
            $muc10 =  $sheetData[$i][10];
            $muc15 =  $sheetData[$i][11];
            $muc20 = $sheetData[$i][12];
            //$solanHM = $sheetData[$i][9];

            if ($muc5 == '') {
                $muctonvinh = 10;
                $solanHM = $muc10;
                if ($muc10 == '') {
                    $muctonvinh = 15;
                    $solanHM = $muc15;
                    if ($muc15 == '') {
                        $muctonvinh = 20;
                        $solanHM = $muc20;
                    }
                }
            } else {
                $muctonvinh = 5;
                $solanHM = $muc5;
            }

            if ($ngaysinh == '' or $thangsinh == '') {
                $ngaysinh = $thangsinh = 1;
                $date = $namsinh . "-" . $thangsinh . "-" . $ngaysinh;
            } else {
                $date = $namsinh . "-" . $thangsinh . "-" . $ngaysinh;
            }


            if ($sheetData[$i][0] != '' and $sheetData[$i][0] != "STT" and  $sheetData[$i][0] != "I" and $hoten != '') {

                $sql = "insert into excel_tonvinh (ID, HoTen, NgaySinh, NgheNghiep, SDT, DiaChi, NhomMau, MucTonVinh, MaDonVi, MaTonVinh, TenFile, SoLanHienMau)
                values ('', '" . $hoten . "', '" . $date . "', '" . $nghenghiep . "', '" . $sdt . "', '" . $diachi . "', '" . $nhommau . "', '" . $muctonvinh . "', '" . $maDV . "', '" . $maTV . "', '" . $file . "', '" . $solanHM . "')";
                $kq = mysqli_query($kn, $sql) or die("Lỗi truy vấn");

                //echo $cot0 . "', '" . $hoten . "', '" . $date . "', '" . $nghenghiep . "', '" . $sdt . "', '" . $diachi . "', '" . $nhommau . "',mức tôn vinh: '" . $muctonvinh . "', '" . $maDV . "', '" . $maTV . "', '" . $file . "',số lần hiến máu '" . $solanHM . "<br>";
            }
        }

        if ($kq) {
            echo '<script type="text/javascript">';
            echo 'alert("Thêm thành công");';
            echo 'window.location.href = "QuanLyNhapXuat.php";';
            echo '</script>';
        } else {
            echo '<script type="text/javascript">';
            echo 'alert("Không thể thêm thông tin. Vui lòng thử lại sau!!!");';
            echo 'window.location.href = "QuanLyNhapXuat.php";';
            echo '</script>';
        }
    }
} else {
    echo '<script type="text/javascript">';
    echo 'alert("Upload only CSV or Excel file");';
    echo 'window.location.href = "QuanLyNhapXuat.php";';
    echo '</script>';
}
