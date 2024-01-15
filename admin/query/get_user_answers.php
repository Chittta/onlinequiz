<?php

session_start(); 
include("../conn2.php");
$exmne_id = $_SESSION['examineeSession']['exmne_id'];
// print_r($exmne_id);die;

$sql = "SELECT id,user_answared FROM exam_questions_atp WHERE exmne_id = '$exmne_id' "; // Adjust your query based on your schema

$result = $conn->query($sql);

$userAnswers = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $userAnswers[] = $row;
    }
}

// Return user's answers as JSON

// print_r($userAnswers);die;
header('Content-Type: application/json');
echo json_encode($userAnswers);

$conn->close();
?>
