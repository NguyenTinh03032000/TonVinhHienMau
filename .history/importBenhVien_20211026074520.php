<?php
require_once 'vendor/autoload.php';

$file = $_FILES['fileBenhVien']['tmp_name'];

$objReader = PHPExcel_IOFactory::load($file);

echo $file;

$file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

if (isset($_FILES['fileBenhVien']['name']) && in_array($_FILES['fileBenhVien']['type'], $file_mimes)) {

    $arr_file = explode('.', $_FILES['file']['name']);
    $extension = end($arr_file);

    if ('csv' == $extension) {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
    } else {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    }

    $spreadsheet = $reader->load($_FILES['file']['tmp_name']);

    $sheetData = $spreadsheet->getActiveSheet()->toArray();

    if (!empty($sheetData)) {
        for ($i = 1; $i < count($sheetData); $i++) {
            $name = $sheetData[$i][0];
            $email = $sheetData[$i][1];
            $sql = "INSERT INTO USERS(name, email) VALUES('$name', '$email')";

            if (mysqli_query($conn, $sql)) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }
}

    // foreach ($objReader->getWorksheetIterator() as $workSheet) {
    //     $highestRow = $workSheet->getHighestRow();

    //     for ($row = 2; $row < $highestRow; $row++) {
    //         $masv = $workSheet->getCellByColumnAndRow(0, $row)->getValue();
    //         $hoten = $workSheet->getCellByColumnAndRow(1, $row)->getValue();
    //         $ngaysinh = $workSheet->getCellByColumnAndRow(2, $row)->getValue();
    //         $gioitinh = $workSheet->getCellByColumnAndRow(3, $row)->getValue();
    //         $sdt = $workSheet->getCellByColumnAndRow(4, $row)->getValue();
    //         $email = $workSheet->getCellByColumnAndRow(5, $row)->getValue();
    //         $chucvu = $workSheet->getCellByColumnAndRow(6, $row)->getValue();
    //         $tinhtranghoc = $workSheet->getCellByColumnAndRow(7, $row)->getValue();

    //         $unix_date = ($ngaysinh - 25569) * 86400;
    //         $excel_date = 25569 + ($unix_date / 86400);
    //         $unix_date = ($excel_date - 25569) * 86400;
    //         $date = gmdate("Y-m-d", $unix_date);

    //         if ($masv != '') {
    //             echo $masv . " - " . $hoten . "<br>";

    //             // $sqlThem = "insert into sinhvien (MaSinhVien, HoTen, NgaySinh, GioiTinh, SDT, Email, MaLop, ChucVu, TinhTrangHoc, MatKhau, Quyen)
    //             //             values ('$masv', '$hoten', '$date', '$gioitinh', '$sdt', '$email', '$malop', '$chucvu', '$tinhtranghoc', '$masv', '$quyen')";
    //             // $kq2 = mysqli_query($kn, $sqlThem) or die("lỗi truy vấn");
    //         }
    //     }
    // echo "<script>alert('Thêm thành công');</script>";
    // }
