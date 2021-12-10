<?php
include "bocuc/Connect.php";
require_once 'vendor/autoload.php';
session_start();

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$Excel_writer = new Xlsx($spreadsheet);

$spreadsheet->setActiveSheetIndex(0);
$activeSheet = $spreadsheet->getActiveSheet();

$query = "SELECT nguoihienmau.HoTen, nguoihienmau.NgaySinh, nguoihienmau.NhomMau, nguoihienmau.SDT, nguoihienmau.NgheNghiep, nguoihienmau.DiaChi, 
            case when danhsachtonvinh.MucTonVinh = '5' then 1 else null end as Muc5, 
            case when danhsachtonvinh.MucTonVinh = '10' then 1 else null end as Muc10,
            case when danhsachtonvinh.MucTonVinh = '15' then 1 else null end as Muc15,
            case when danhsachtonvinh.MucTonVinh = '20' then 1 else null end as Muc20,
            case when danhsachtonvinh.MucTonVinh = '30' then 1 else null end as Muc30,
            case when danhsachtonvinh.MucTonVinh = '40' then 1 else null end as Muc40,
            case when danhsachtonvinh.MucTonVinh = '50' then 1 else null end as Muc50,
            case when danhsachtonvinh.MucTonVinh = '60' then 1 else null end as Muc60,
            case when danhsachtonvinh.MucTonVinh = '70' then 1 else null end as Muc70,
            case when danhsachtonvinh.MucTonVinh = '80' then 1 else null end as Muc80,
            case when danhsachtonvinh.MucTonVinh = '90' then 1 else null end as Muc90,
            case when danhsachtonvinh.MucTonVinh = '100' then 1 else null end as Muc100 
            FROM danhsachtonvinh INNER JOIN donvi ON donvi.madonvi = danhsachtonvinh.MaDonVi 
                                    INNER JOIN nguoihienmau ON nguoihienmau.ID_NguoiHienMau = danhsachtonvinh.ID_NguoiHienMau 
                                    INNER JOIN tonvinh on tonvinh.matonvinh = danhsachtonvinh.MaTonVinh 
                                    WHERE tonvinh.matonvinh = '10-2021'";
$kq = mysqli_query($kn, $sql) or die("lỗi truy vấn");


$active_sheet->setCellValue('A3', 'STT');
$active_sheet->setCellValue('B3', 'Họ tên');
$active_sheet->setCellValue('C3', 'Ngày sinh');
$active_sheet->setCellValue('D3', 'Nhóm máu');
$active_sheet->setCellValue('E3', 'SĐT');
$active_sheet->setCellValue('F3', 'Nghề nghiệp');
$active_sheet->setCellValue('G3', 'Địa chỉ');
$active_sheet->setCellValue('H3', 'Mức 5');
$active_sheet->setCellValue('I3', 'Mức 10');
$active_sheet->setCellValue('J3', 'Mức 15');
$active_sheet->setCellValue('K3', 'Mức 20');
$active_sheet->setCellValue('L3', 'Mức 30');
$active_sheet->setCellValue('M3', 'Mức 40');
$active_sheet->setCellValue('N3', 'Mức 50');
$active_sheet->setCellValue('O3', 'Mức 60');
$active_sheet->setCellValue('D3', 'Mức 70');
$active_sheet->setCellValue('P3', 'Mức 80');
$active_sheet->setCellValue('Q3', 'Mức 90');
$active_sheet->setCellValue('R3', 'Mức 100');

$count = 4;

foreach ($result as $row) {
    $active_sheet->setCellValue('A' . $count, $row["first_name"]);
    $active_sheet->setCellValue('B' . $count, $row["last_name"]);
    $active_sheet->setCellValue('C' . $count, $row["created_at"]);
    $active_sheet->setCellValue('D' . $count, $row["updated_at"]);

    $count = $count + 1;
}

$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($file, "Xlsx");

$file_name = time() . '.' . strtolower($_POST["file_type"]);

$writer->save($file_name);

header('Content-Type: application/x-www-form-urlencoded');

header('Content-Transfer-Encoding: Binary');

header("Content-disposition: attachment; filename=\"" . $file_name . "\"");

readfile($file_name);

unlink($file_name);

exit;
