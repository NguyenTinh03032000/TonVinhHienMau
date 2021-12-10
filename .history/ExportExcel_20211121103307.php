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

$matonvinh = $_POST['btnMaTonVinh'];

$sql = "SELECT nguoihienmau.HoTen, nguoihienmau.NgaySinh, nguoihienmau.NhomMau, nguoihienmau.SDT, nguoihienmau.NgheNghiep, nguoihienmau.DiaChi, 
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
                                    WHERE tonvinh.matonvinh = '" . $matonvinh . "'";
$kq = mysqli_query($kn, $sql) or die("lỗi truy vấn");

$tieude = "DANH SÁCH CÁ NHÂN HIẾN MÁU TÌNH NGUYỆN 5 LẦN TRỞ LÊN 
CHƯA ĐƯỢC TÔN VINH TỈNH BÌNH ĐỊNH NĂM 2021
(Căn cứ theo Quy chế Tôn vinh, khen thưởng cá nhân, tập thể có thành tích Hiến máu tình nguyện và vận động hiến máu tình nguyện tại Quyết định số 139/QĐ-BCĐQG ngày 29 tháng 9 năm 2009 của Ban Chỉ đạo quốc gia vận động hiến máu tình nguyện)";

$activeSheet->setCellValue('A1', $tieude);


$activeSheet->setCellValue('A3', 'STT');
$activeSheet->setCellValue('B3', 'Họ tên');
$activeSheet->setCellValue('C3', 'Ngày sinh');
$activeSheet->setCellValue('D3', 'Nhóm máu');
$activeSheet->setCellValue('E3', 'SĐT');
$activeSheet->setCellValue('F3', 'Nghề nghiệp');
$activeSheet->setCellValue('G3', 'Địa chỉ');
$activeSheet->setCellValue('H3', 'Mức 5');
$activeSheet->setCellValue('I3', 'Mức 10');
$activeSheet->setCellValue('J3', 'Mức 15');
$activeSheet->setCellValue('K3', 'Mức 20');
$activeSheet->setCellValue('L3', 'Mức 30');
$activeSheet->setCellValue('M3', 'Mức 40');
$activeSheet->setCellValue('N3', 'Mức 50');
$activeSheet->setCellValue('O3', 'Mức 60');
$activeSheet->setCellValue('P3', 'Mức 70');
$activeSheet->setCellValue('Q3', 'Mức 80');
$activeSheet->setCellValue('R3', 'Mức 90');
$activeSheet->setCellValue('S3', 'Mức 100');
$activeSheet->setCellValue('T3', 'Ghi chú');

$count = 4;
$stt = 0;
while ($row = mysqli_fetch_array($kq)) {
    $stt += 1;

    $ngaysinh = htmlspecialchars(date_format(date_create($row['NgaySinh']), "d/m/Y"));

    $muc5 = $row['SoLanHienMau'];

    $activeSheet->setCellValue('A' . $count, $stt);
    $activeSheet->setCellValue('B' . $count, $row["HoTen"]);
    $activeSheet->setCellValue('C' . $count, $ngaysinh);
    $activeSheet->setCellValue('D' . $count, $row["NhomMau"]);
    $activeSheet->setCellValue('E' . $count, $row["SDT"]);
    $activeSheet->setCellValue('F' . $count, $row["NgheNghiep"]);
    $activeSheet->setCellValue('G' . $count, $row["DiaChi"]);
    $activeSheet->setCellValue('H' . $count, $muc5);
    $activeSheet->setCellValue('I' . $count, $row["Muc10"]);
    $activeSheet->setCellValue('J' . $count, $row["Muc15"]);
    $activeSheet->setCellValue('K' . $count, $row["Muc20"]);
    $activeSheet->setCellValue('L' . $count, $row["Muc30"]);
    $activeSheet->setCellValue('M' . $count, $row["Muc40"]);
    $activeSheet->setCellValue('N' . $count, $row["Muc50"]);
    $activeSheet->setCellValue('O' . $count, $row["Muc60"]);
    $activeSheet->setCellValue('P' . $count, $row["Muc70"]);
    $activeSheet->setCellValue('Q' . $count, $row["Muc80"]);
    $activeSheet->setCellValue('R' . $count, $row["Muc90"]);
    $activeSheet->setCellValue('S' . $count, $row["Muc100"]);
    $activeSheet->setCellValue('T' . $count, "");

    $count++;

    $SUMRANGE = 'H4:H' . $count;
    $activeSheet->setCellValue('H' . $count, '=SUM(' . $SUMRANGE . ')');
}

for ($i = 'B'; $i !=  $spreadsheet->getActiveSheet()->getHighestColumn(); $i++) {
    $spreadsheet->getActiveSheet()->getColumnDimension($i)->setAutoSize(TRUE);
}

$filename = 'Danh sách tôn vinh đợt ' . $matonvinh . '.xlsx';

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename=' . $filename);
header('Cache-Control: max-age=0');
$Excel_writer->save('php://output');
