<?php
include "bocuc/Connect.php";
require_once 'vendor/autoload.php';
session_start();

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

$spreadsheet = new Spreadsheet();
$Excel_writer = new Xlsx($spreadsheet);

$spreadsheet->setActiveSheetIndex(0);
$activeSheet = $spreadsheet->getActiveSheet();

$matonvinh = $_POST['btnMaTonVinh'];

$sql = "SELECT nguoihienmau.HoTen, nguoihienmau.NgaySinh, nguoihienmau.NhomMau, nguoihienmau.SDT, nguoihienmau.NgheNghiep, nguoihienmau.DiaChi, nguoihienmau.SoLanHienMau,
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

$activeSheet->mergeCells('A1:T1');

$activeSheet->getStyle('A1')->getAlignment()->setWrapText(true);

$activeSheet->getStyle('S' . $count)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$activeSheet->getStyle('A' . $count)->getAlignment()->setVertical(Alignment::HORIZONTAL_CENTER);

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

    $muc5 = "";
    $muc10 = "";
    $muc15 = "";
    $muc20 = "";
    $muc30 = "";
    $muc40 = "";
    $muc50 = "";
    $muc60 = "";
    $muc70 = "";
    $muc80 = "";
    $muc90 = "";
    $muc100 = "";

    if ($row['Muc5'] == "null") {
        $muc5 = "";
    } elseif ($row['Muc5'] == "1") {
        $muc5 = $row['SoLanHienMau'];
    }

    if ($row['Muc10'] == "null") {
        $muc10 = "";
    } elseif ($row['Muc10'] == "1") {
        $muc10 = $row['SoLanHienMau'];
    }

    if ($row['Muc15'] == "null") {
        $muc15 = "";
    } elseif ($row['Muc15'] == "1") {
        $muc15 = $row['SoLanHienMau'];
    }

    if ($row['Muc20'] == "null") {
        $muc20 = "";
    } elseif ($row['Muc20'] == "1") {
        $muc20 = $row['SoLanHienMau'];
    }

    if ($row['Muc30'] == "null") {
        $muc30 = "";
    } elseif ($row['Muc30'] == "1") {
        $muc30 = $row['SoLanHienMau'];
    }

    if ($row['Muc40'] == "null") {
        $muc40 = "";
    } elseif ($row['Muc40'] == "1") {
        $muc40 = $row['SoLanHienMau'];
    }

    if ($row['Muc50'] == "null") {
        $muc50 = "";
    } elseif ($row['Muc50'] == "1") {
        $muc50 = $row['SoLanHienMau'];
    }

    if ($row['Muc60'] == "null") {
        $muc60 = "";
    } elseif ($row['Muc60'] == "1") {
        $muc60 = $row['SoLanHienMau'];
    }

    if ($row['Muc70'] == "null") {
        $muc70 = "";
    } elseif ($row['Muc70'] == "1") {
        $muc70 = $row['SoLanHienMau'];
    }

    if ($row['Muc80'] == "null") {
        $muc80 = "";
    } elseif ($row['Muc80'] == "1") {
        $muc80 = $row['SoLanHienMau'];
    }

    if ($row['Muc90'] == "null") {
        $muc90 = "";
    } elseif ($row['Muc90'] == "1") {
        $muc90 = $row['SoLanHienMau'];
    }

    if ($row['Muc100'] == "null") {
        $muc100 = "";
    } elseif ($row['Muc100'] == "1") {
        $muc100 = $row['SoLanHienMau'];
    }

    $activeSheet->setCellValue('A' . $count, $stt);
    $activeSheet->setCellValue('B' . $count, $row["HoTen"]);
    $activeSheet->setCellValue('C' . $count, $ngaysinh);
    $activeSheet->setCellValue('D' . $count, $row["NhomMau"]);
    $activeSheet->setCellValue('E' . $count, $row["SDT"]);
    $activeSheet->setCellValue('F' . $count, $row["NgheNghiep"]);
    $activeSheet->setCellValue('G' . $count, $row["DiaChi"]);
    $activeSheet->setCellValue('H' . $count, $muc5);
    $activeSheet->setCellValue('I' . $count, $muc10);
    $activeSheet->setCellValue('J' . $count, $muc15);
    $activeSheet->setCellValue('K' . $count, $muc20);
    $activeSheet->setCellValue('L' . $count, $muc30);
    $activeSheet->setCellValue('M' . $count, $muc40);
    $activeSheet->setCellValue('N' . $count, $muc50);
    $activeSheet->setCellValue('O' . $count, $muc60);
    $activeSheet->setCellValue('P' . $count, $muc70);
    $activeSheet->setCellValue('Q' . $count, $muc80);
    $activeSheet->setCellValue('R' . $count, $muc90);
    $activeSheet->setCellValue('S' . $count, $muc100);
    $activeSheet->setCellValue('T' . $count, "");

    $activeSheet->getStyle('A' . $count)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $activeSheet->getStyle('C' . $count)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $activeSheet->getStyle('D' . $count)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $activeSheet->getStyle('E' . $count)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $activeSheet->getStyle('H' . $count)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $activeSheet->getStyle('I' . $count)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $activeSheet->getStyle('J' . $count)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $activeSheet->getStyle('K' . $count)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $activeSheet->getStyle('L' . $count)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $activeSheet->getStyle('M' . $count)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $activeSheet->getStyle('N' . $count)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $activeSheet->getStyle('O' . $count)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $activeSheet->getStyle('P' . $count)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $activeSheet->getStyle('Q' . $count)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $activeSheet->getStyle('R' . $count)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $activeSheet->getStyle('S' . $count)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

    $activeSheet->getStyle('A' . $count)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
    $activeSheet->getStyle('C' . $count)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
    $activeSheet->getStyle('D' . $count)->getAlignment()->setVertical(Alignment::HORIZONTAL_CENTER);
    $activeSheet->getStyle('E' . $count)->getAlignment()->setVertical(Alignment::HORIZONTAL_CENTER);
    $activeSheet->getStyle('H' . $count)->getAlignment()->setVertical(Alignment::HORIZONTAL_CENTER);
    $activeSheet->getStyle('I' . $count)->getAlignment()->setVertical(Alignment::HORIZONTAL_CENTER);
    $activeSheet->getStyle('J' . $count)->getAlignment()->setVertical(Alignment::HORIZONTAL_CENTER);
    $activeSheet->getStyle('K' . $count)->getAlignment()->setVertical(Alignment::HORIZONTAL_CENTER);
    $activeSheet->getStyle('L' . $count)->getAlignment()->setVertical(Alignment::HORIZONTAL_CENTER);
    $activeSheet->getStyle('M' . $count)->getAlignment()->setVertical(Alignment::HORIZONTAL_CENTER);
    $activeSheet->getStyle('N' . $count)->getAlignment()->setVertical(Alignment::HORIZONTAL_CENTER);
    $activeSheet->getStyle('O' . $count)->getAlignment()->setVertical(Alignment::HORIZONTAL_CENTER);
    $activeSheet->getStyle('P' . $count)->getAlignment()->setVertical(Alignment::HORIZONTAL_CENTER);
    $activeSheet->getStyle('Q' . $count)->getAlignment()->setVertical(Alignment::HORIZONTAL_CENTER);
    $activeSheet->getStyle('R' . $count)->getAlignment()->setVertical(Alignment::HORIZONTAL_CENTER);
    $activeSheet->getStyle('S' . $count)->getAlignment()->setVertical(Alignment::HORIZONTAL_CENTER);

    $count++;
}

$SUMRANGE_H = 'H4:H' . $count;
$SUMRANGE_I = 'I4:I' . $count;
$SUMRANGE_J = 'J4:J' . $count;
$SUMRANGE_K = 'K4:K' . $count;
$SUMRANGE_L = 'L4:L' . $count;
$SUMRANGE_M = 'M4:M' . $count;
$SUMRANGE_N = 'N4:N' . $count;
$SUMRANGE_O = 'O4:O' . $count;
$SUMRANGE_P = 'P4:P' . $count;
$SUMRANGE_Q = 'Q4:Q' . $count;
$SUMRANGE_R = 'R4:R' . $count;
$SUMRANGE_S = 'S4:S' . $count;

$activeSheet->setCellValue('A' . $count, "Tổng");

$activeSheet->mergeCells('A' . $count . ':G' . $count);

$activeSheet->setCellValue('H' . $count, '=COUNTIF(' . $SUMRANGE_H . ',">0")');
$activeSheet->setCellValue('I' . $count, '=COUNTIF(' . $SUMRANGE_I . ',">0")');
$activeSheet->setCellValue('J' . $count, '=COUNTIF(' . $SUMRANGE_J . ',">0")');
$activeSheet->setCellValue('K' . $count, '=COUNTIF(' . $SUMRANGE_K . ',">0")');
$activeSheet->setCellValue('L' . $count, '=COUNTIF(' . $SUMRANGE_L . ',">0")');
$activeSheet->setCellValue('M' . $count, '=COUNTIF(' . $SUMRANGE_M . ',">0")');
$activeSheet->setCellValue('N' . $count, '=COUNTIF(' . $SUMRANGE_N . ',">0")');
$activeSheet->setCellValue('O' . $count, '=COUNTIF(' . $SUMRANGE_O . ',">0")');
$activeSheet->setCellValue('P' . $count, '=COUNTIF(' . $SUMRANGE_P . ',">0")');
$activeSheet->setCellValue('Q' . $count, '=COUNTIF(' . $SUMRANGE_Q . ',">0")');
$activeSheet->setCellValue('R' . $count, '=COUNTIF(' . $SUMRANGE_R . ',">0")');
$activeSheet->setCellValue('S' . $count, '=COUNTIF(' . $SUMRANGE_S . ',">0")');

$activeSheet->getStyle('A' . $count)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$activeSheet->getStyle('H' . $count)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$activeSheet->getStyle('I' . $count)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$activeSheet->getStyle('J' . $count)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$activeSheet->getStyle('K' . $count)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$activeSheet->getStyle('L' . $count)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$activeSheet->getStyle('M' . $count)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$activeSheet->getStyle('N' . $count)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$activeSheet->getStyle('O' . $count)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$activeSheet->getStyle('P' . $count)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$activeSheet->getStyle('Q' . $count)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$activeSheet->getStyle('R' . $count)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$activeSheet->getStyle('S' . $count)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$activeSheet->getStyle('A' . $count)->getAlignment()->setVertical(Alignment::HORIZONTAL_CENTER);
$activeSheet->getStyle('H' . $count)->getAlignment()->setVertical(Alignment::HORIZONTAL_CENTER);
$activeSheet->getStyle('I' . $count)->getAlignment()->setVertical(Alignment::HORIZONTAL_CENTER);
$activeSheet->getStyle('J' . $count)->getAlignment()->setVertical(Alignment::HORIZONTAL_CENTER);
$activeSheet->getStyle('K' . $count)->getAlignment()->setVertical(Alignment::HORIZONTAL_CENTER);
$activeSheet->getStyle('L' . $count)->getAlignment()->setVertical(Alignment::HORIZONTAL_CENTER);
$activeSheet->getStyle('M' . $count)->getAlignment()->setVertical(Alignment::HORIZONTAL_CENTER);
$activeSheet->getStyle('N' . $count)->getAlignment()->setVertical(Alignment::HORIZONTAL_CENTER);
$activeSheet->getStyle('O' . $count)->getAlignment()->setVertical(Alignment::HORIZONTAL_CENTER);
$activeSheet->getStyle('P' . $count)->getAlignment()->setVertical(Alignment::HORIZONTAL_CENTER);
$activeSheet->getStyle('Q' . $count)->getAlignment()->setVertical(Alignment::HORIZONTAL_CENTER);
$activeSheet->getStyle('R' . $count)->getAlignment()->setVertical(Alignment::HORIZONTAL_CENTER);
$activeSheet->getStyle('S' . $count)->getAlignment()->setVertical(Alignment::HORIZONTAL_CENTER);

// Tạo viền
$styleArray = array(
    'borders' => [
        'top' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
        'bottom' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
        'left' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
        'right' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ]
    ],
);

$activeSheet->getStyle('A3:T' . $count)->applyFromArray($styleArray);

for ($i = 'B'; $i !=  $spreadsheet->getActiveSheet()->getHighestColumn(); $i++) {
    $spreadsheet->getActiveSheet()->getColumnDimension($i)->setAutoSize(TRUE);
}

$filename = 'Danh sách tôn vinh đợt ' . $matonvinh . '.xlsx';

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename=' . $filename);
header('Cache-Control: max-age=0');
$Excel_writer->save('php://output');
