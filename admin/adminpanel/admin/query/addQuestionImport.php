<?php
include("../../../conn2.php");
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$res = array(); // Initialize the response array

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['import_file'])) {
    $file_ext = pathinfo($_FILES['import_file']['name'], PATHINFO_EXTENSION);
    $allowed_ext = ['xls', 'csv', 'xlsx'];
    $exam_id = $_POST['examIdImport'];
    if (in_array($file_ext, $allowed_ext)) {
        $inputFileNamePath = $_FILES['import_file']['tmp_name'];
        $exam_status = "active";
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
        $data = $spreadsheet->getActiveSheet()->toArray();
        $count = 0;
        foreach ($data as $row) {
            if ($count > 0) {
                $exam_question = $row[1];
                $exam_ch1 = $row[2];
                $exam_ch2 = $row[3];
                $exam_ch3 = $row[4];
                $exam_ch4 = $row[5];
                $exam_answer = $row[6];
                $exam_status = $row[7];

                // Prepare the statement
                $studentQuery = "INSERT INTO exam_question_tbl (exam_id,exam_question,exam_ch1,exam_ch2,exam_ch3,exam_ch4,exam_answer,exam_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($conn, $studentQuery);

                // Bind parameters
                mysqli_stmt_bind_param($stmt, 'ssssssss', $exam_id, $exam_question, $exam_ch1, $exam_ch2, $exam_ch3, $exam_ch4, $exam_answer, $exam_status);

                // Execute the statement
                $result = mysqli_stmt_execute($stmt);

                if (!$result) {
                    $res = array("res" => "failed");
                    echo json_encode($res);
                    exit(0);
                }
            } else {
                $count = 1;
            }
        }

        $res = array("res" => "success", "msg" => $_FILES['import_file']['name']);
    } else {
        $res = array("res" => "error", "msg" => "Invalid request or file not found");
    }

    
} else {
    $res = array("res" => "error", "msg" => "Invalid request or file not found");
}
echo json_encode($res);
