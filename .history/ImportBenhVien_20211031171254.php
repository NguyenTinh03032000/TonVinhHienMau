<?php
include "bocuc/Connect.php";
require_once 'vendor/autoload.php';
session_start();

date_default_timezone_set("Asia/Ho_Chi_Minh");

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

$file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

if (isset($_FILES['fileBenhVien']['name']) && in_array($_FILES['fileBenhVien']['type'], $file_mimes)) {

    $arr_file = explode('.', $_FILES['fileBenhVien']['name']);
    $extension = end($arr_file);

    if ('csv' == $extension) {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
    } else if ('xlsx' == $extension) {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    }

    $spreadsheet = $reader->load($_FILES['fileBenhVien']['tmp_name']);

    $sheetData = $spreadsheet->getActiveSheet()->toArray();

    $tenfile = $_FILES['fileBenhVien']['name'];

    // echo $tenfile;

    if (!empty($sheetData)) {

        $soluongnguoi_excel = 0;
        $soluongnguoi_capnhat = 0;

        for ($i = 1; $i < count($sheetData); $i++) {
            $cot1 = $sheetData[$i][0];
            $cot2 = $sheetData[$i][1];
            // $cot3 = $sheetData[$i][2];
            // $cot4 = $sheetData[$i][3];
            $cot5 = $sheetData[$i][4];
            // $cot6 = $sheetData[$i][5];
            $cot7 = $sheetData[$i][6];
            // $cot8 = $sheetData[$i][7];
            $cot9 = $sheetData[$i][8];
            // $cot10 = $sheetData[$i][9];
            $cot11 = $sheetData[$i][10];
            $cot12 = $sheetData[$i][11];
            // $cot13 = $sheetData[$i][12];
            // $cot14 = $sheetData[$i][13];
            // $cot15 = $sheetData[$i][14];
            $cot16 = $sheetData[$i][15];
            $cot17 = $sheetData[$i][16];
            $cot18 = $sheetData[$i][17];
            $cot19 = $sheetData[$i][18];
            $cot20 = $sheetData[$i][19];
            $cot21 = $sheetData[$i][20];
            $cot22 = $sheetData[$i][21];
            $cot23 = $sheetData[$i][22];

            // $unix_date = ($cot5 - 25569) * 86400;
            // $excel_date = 25569 + ($unix_date / 86400);
            // $unix_date = ($excel_date - 25569) * 86400;
            // $date = gmdate("Y-m-d", $unix_date);

            $ngaysinh = explode("/", $cot5);
            $ngay = array_shift($ngaysinh);
            $nam = array_pop($ngaysinh);
            $thang = implode("/", $ngaysinh);

            $date = $nam . "-" . $thang . "-" . $ngay;

            if ($cot1 != "" and $cot1 != "STT") {
                // echo $cot1 . " - " . $cot2 . " - " . $date . " - " . $cot7 . " - " . $cot9 . " - " . $cot11 . " - " . $cot12 . " - " . $cot16 . " - " .
                //     $cot17 . " - " . $cot19 . " - " . $cot20 . " - " . $cot21 . " - " . $cot22 . " - " . $tenfile . "<br>";

                $sqldem = "select *, count(*) as dem from nguoihienmau where HoTen = '" . $cot2 . "' and NgaySinh = '" . $date . "' and NhomMau = '" . $cot21 . "'";
                $kqdem = mysqli_query($kn, $sqldem) or die("Lỗi truy vấn 1");
                $rowdem = mysqli_fetch_array($kqdem);

                if ($rowdem['HoTen'] != null and $rowdem['NgaySinh'] != null and $rowdem['NhomMau'] != null) {

                    $sqldem1 = "select *, count(*) as dem from nguoihienmau where HoTen = '" . $cot2 . "' and NgaySinh = '" . $date . "' and NhomMau = '" . $cot21 . "' and SDT = '" . $cot11 . "'";
                    $kqdem1 = mysqli_query($kn, $sqldem1) or die("Lỗi truy vấn 1");
                    $rowdem1 = mysqli_fetch_array($kqdem1);

                    if ($rowdem1['HoTen'] != null and $rowdem1['NgaySinh'] != null and $rowdem1['NhomMau'] != null and $rowdem1['SDT'] != null) {
                        $sql = "insert into excel_benhvien (ID, HoTen, NgaySinh, NgheNghiep, NoiLamViec, SDT, DiaChi, SoLanHienMau, NhomMau, Nhom_RH, TenFile) 
                            values('', '" . $cot2 . "', '" . $date . "', '" . $cot7 . "', '" . $cot9 . "', '" . $cot11 . "', '" . $cot12 . "', '" . $cot16 . "', '" . $cot21 . "', '" . $cot22 . "', '" . $tenfile . "')";
                        $kq = mysqli_query($kn, $sql) or die("Lỗi truy vấn 2");
                    } else {
                        $sqlupdate = "update nguoihienmau set SoLanHienMau = '" . $cot16 . "' where HoTen = '" . $cot2 . "' and NgaySinh = '" . $date . "' and NhomMau = '" . $cot21 . "'";
                        $kqupdate = mysqli_query($kn, $sqlupdate) or die("Lỗi truy vấn 3");

                        $soluongnguoi_capnhat += 1;
                    }
                } else {
                    $sqlinsert = "insert into nguoihienmau (ID_NguoiHienMau, HoTen, NgaySinh, NgheNghiep, NoiLamViec, SDT, DiaChi, SoLanHienMau, NhomMau, NhomRH) 
                        values('', '" . $cot2 . "', '" . $date . "', '" . $cot7 . "', '" . $cot9 . "', '" . $cot11 . "', '" . $cot12 . "', '" . $cot16 . "', '" . $cot21 . "', '" . $cot22 . "')";
                    $kqinsert = mysqli_query($kn, $sqlinsert) or die("Lỗi truy vấn 4");
                }
                // }

                // $sql = "insert into excel_benhvien (ID, HoTen, NgaySinh, NgheNghiep, NoiLamViec, SDT, DiaChi, SoLanHienMau, NhomMau, Nhom_RH, TenFile) 
                //         values('', '" . $cot2 . "', '" . $date . "', '" . $cot7 . "', '" . $cot9 . "', '" . $cot11 . "', '" . $cot12 . "', '" . $cot16 . "', '" . $cot21 . "', '" . $cot22 . "', '" . $tenfile . "')";
                // $kq = mysqli_query($kn, $sql) or die("Lỗi truy vấn 2");
            }
            // }
            // $sql1 = "select * from excel_benhvien";
            // $kq1 = mysqli_query($kn, $sql1) or die("Lỗi truy vấn 5");
            // while ($row1 = mysqli_fetch_array($kq1)) {
            //     $sqldem = "select *, count(*) as dem from nguoihienmau where HoTen = '" . $row1['HoTen'] . "' and NgaySinh = '" . $row1['NgaySinh'] . "' and NhomMau = '" . $row1['NhomMau'] . "'";
            //     $kqdem = mysqli_query($kn, $sqldem) or die("Lỗi truy vấn 1");
            //     $rowdem = mysqli_fetch_array($kqdem);

            //     if ($rowdem['dem'] == 0) {
            //         $sqlinsert = "insert into nguoihienmau (ID_NguoiHienMau, HoTen, NgaySinh, NgheNghiep, NoiLamViec, SDT, DiaChi, SoLanHienMau, NhomMau, NhomRH) 
            //             values('', '" . $row1['HoTen'] . "', '" . $row1['NgaySinh'] . "', '" . $row1['NgheNghiep'] . "', '" . $row1['NoiLamViec'] . "', '" . $row1['SDT'] . "', '" . $row1['DiaChi'] . "', '" . $row1['SoLanHienMau'] . "', '" . $row1['NhomMau'] . "', '" . $row1['Nhom_RH'] . "')";
            //         $kqinsert = mysqli_query($kn, $sqlinsert) or die("Lỗi truy vấn 4");

            //         $sqldelete = "delete from excel_benhvien where ID = '" . $row1['ID'] . "'";
            //         $kqdelete = mysqli_query($kn, $sqldelete);
            //     } else {
            //         // $sqldem1 = "select count(*) as dem from nguoihienmau where HoTen = '" . $row1['HoTen'] . "' and NgaySinh = '" . $row1['NgaySinh'] . "' and NhomMau = '" . $row1['NhomMau'] . "' and SDT = '" . $row1['SDT'] . "'";
            //         // $kqdem1 = mysqli_query($kn, $sqldem1) or die("Lỗi truy vấn 1");
            //         // $rowdem1 = mysqli_fetch_array($kqdem1);

            //         // if ($rowdem1['dem'] == 0) {
            //         $sqlupdate = "update nguoihienmau set SoLanHienMau = '" . $cot16 . "' where HoTen = '" . $cot2 . "' and NgaySinh = '" . $date . "' and NhomMau = '" . $cot21 . "'";
            //         $kqupdate = mysqli_query($kn, $sqlupdate) or die("Lỗi truy vấn 3");

            //         $sqldelete1 = "delete from excel_benhvien where ID = '" . $row1['ID'] . "'";
            //         $kqdelete1 = mysqli_query($kn, $sqldelete1);
            //         // }
            //     }

            $soluongnguoi_excel += 1;
        }

        // echo '<script type="text/javascript">';
        // echo 'window.location.href = "ketQuaImportBV.php";';
        // echo '</script>';

        $_SESSION['soluongnguoi_excel'] = $soluongnguoi_excel;
        $_SESSION['soluongnguoi_capnhat'] = $soluongnguoi_capnhat;

        // if ($kq) {
        echo '<script type="text/javascript">';
        echo 'alert("Thêm thành công");';
        echo 'window.location.href = "KetQuaImportBV.php";';
        echo '</script>';
        // } else {
        //     echo '<script type="text/javascript">';
        //     echo 'alert("Không thể thêm thông tin. Vui lòng thử lại sau!!!");';
        //     echo 'window.location.href = "QuanLyNhapXuat.php";';
        //     echo '</script>';
        // }
    }
} else {
    echo '<script type="text/javascript">';
    echo 'alert("Upload only CSV or Excel file.");';
    echo 'window.location.href = "QuanLyNhapXuat.php";';
    echo '</script>';
}
