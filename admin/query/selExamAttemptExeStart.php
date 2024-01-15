<?php 
 session_start();
 include("../conn.php");
// $host = 'localhost';
// $dbname = 'judicial';
// $username = 'root'; 
// $password = ''; 

// try {
//     $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
//     die("Connection failed: " . $e->getMessage());
// }

$exmneId = $_SESSION['examineeSession']['exmne_id'];
extract($_POST);
foreach ($thisData as $data) {
    $sql = "INSERT INTO exam_questions_atp 
            (eqt_id, exam_id, exam_question, exam_ch1, exam_ch2, exam_ch3, exam_ch4, exam_answer, exam_status, exmne_id) 
            VALUES 
            (:eqt_id, :exam_id, :exam_question, :exam_ch1, :exam_ch2, :exam_ch3, :exam_ch4, :exam_answer, :exam_status, :exmne_id)";
    
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':eqt_id' => $data['eqt_id'],
            ':exam_id' => $data['exam_id'],
            ':exam_question' => $data['exam_question'],
            ':exam_ch1' => $data['exam_ch1'],
            ':exam_ch2' => $data['exam_ch2'],
            ':exam_ch3' => $data['exam_ch3'],
            ':exam_ch4' => $data['exam_ch4'],
            ':exam_answer' => $data['exam_answer'],
            ':exam_status' => $data['exam_status'],
            ':exmne_id' => $exmneId
        ]);
        $res = array("res" => "startExam");
 


    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

$conn = null; 
echo json_encode($res);
 ?>

