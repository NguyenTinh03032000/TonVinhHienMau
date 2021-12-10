<?php
include "bocuc/Connect.php";
require_once 'vendor/autoload.php';
session_start();

defined('BASEPATH') or exit('No direct script access allowed');
/* Spreadsheet */

use PhpOffice\PhpSpreadsheet\Spreadsheet;

date_default_timezone_set("Asia/Ho_Chi_Minh");
$extension = $this->input->post('export_type');
if (!empty($extension)) {
    $extension = $extension;
} else {
    $extension = 'xlsx';
}
$this->load->helper('download');
$data = array();
$data['title'] = 'Export Excel Sheet | Coders Mag';
/* get employee list */
$empInfo = $this->site->employeeList();

$fileName = 'employee-' . time();
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', 'First_Name');
$sheet->setCellValue('B1', 'Last_Name');
$sheet->setCellValue('C1', 'Email');
$sheet->setCellValue('D1', 'DOB');
$sheet->setCellValue('E1', 'Contact_No');

$rowCount = 2;
foreach ($empInfo as $element) {
    $sheet->setCellValue('A' . $rowCount, $element['first_name']);
    $sheet->setCellValue('B' . $rowCount, $element['last_name']);
    $sheet->setCellValue('C' . $rowCount, $element['email']);
    $sheet->setCellValue('D' . $rowCount, $element['dob']);
    $sheet->setCellValue('E' . $rowCount, $element['contact_no']);
    $rowCount++;
}

if ($extension == 'csv') {
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
    $fileName = $fileName . '.csv';
} elseif ($extension == 'xlsx') {
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    $fileName = $fileName . '.xlsx';
} else {
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xls($spreadsheet);
    $fileName = $fileName . '.xls';
}

$this->output->set_header('Content-Type: application/vnd.ms-excel');
$this->output->set_header("Content-type: application/csv");
$this->output->set_header('Cache-Control: max-age=0');
$writer->save($fileName);
/*redirect(HTTP_UPLOAD_PATH.$fileName); */
$filepath = file_get_contents($fileName);
force_download($fileName, $filepath);

use PhpOffice\PhpSpreadsheet\Spreadsheet;


$connect = new PDO("mysql:host=localhost;dbname=testing", "root", "");


$query = "SELECT * FROM sample_datas ORDER BY id DESC";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

if (isset($_POST["export"])) {
    $file = new Spreadsheet();

    $active_sheet = $file->getActiveSheet();

    $active_sheet->setCellValue('A1', 'First Name');
    $active_sheet->setCellValue('B1', 'Last Name');
    $active_sheet->setCellValue('C1', 'Created At');
    $active_sheet->setCellValue('D1', 'Updated At');

    $count = 2;

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
}
