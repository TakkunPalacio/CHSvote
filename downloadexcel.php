<?php
require 'C:\Users\John Isa\vendor\autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$conn = new mysqli("localhost","root","","chs_voting");
$sql = "SELECT * from v_acc inner join v_info on v_acc.S_id = v_info.S_id";
$result = mysqli_query($conn,$sql);

$spreadsheet = new Spreadsheet();

$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', 'Student ID');
$sheet->setCellValue('B1', 'Name');
$sheet->setCellValue('C1', 'Year');
$sheet->setCellValue('D1', 'Course');
$sheet->setCellValue('E1', 'Password');
$i =2;
while($row = mysqli_fetch_assoc($result)){
    $sheet->setCellValue('A'.$i, "{$row['S_id']}");
    $sheet->setCellValue('B'.$i, "{$row['S_name']}");
    $sheet->setCellValue('C'.$i, "{$row['S_year']}");
    $sheet->setCellValue('D'.$i, "{$row['course']}");
    $sheet->setCellValue('E'.$i, "{$row['pass']}");
    $i++;
}
foreach (range('A', $sheet->getHighestColumn()) as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
 }
$fileName = "voter_info.xlsx";
// Write a new .xlsx file
$writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
        $writer->save('php://output');
?>