<?php

session_start(); 
include("../conn2.php");
$exmne_id = $_SESSION['examineeSession']['exmne_id'];

$questionId = $_POST['questionId'];
$userAnswer = $_POST['userAnswer'];

$sql = "UPDATE exam_questions_atp SET user_answared = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $userAnswer, $questionId);

if ($stmt->execute()) {
    $sql2 = "SELECT exam_answer, user_answared FROM exam_questions_atp WHERE id = ? AND exmne_id = ? ";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param("ii", $questionId, $exmne_id);
    $stmt2->execute();
    $result = $stmt2->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $correctAnswer = $row['exam_answer'];
        $userSelectedAnswer = $row['user_answared'];

        if ($userSelectedAnswer == $correctAnswer) {
            echo "right";
        } else if($userSelectedAnswer != $correctAnswer) {
            echo "wrong";
        }else if($userSelectedAnswer == NULL){
            echo "noapt";
        }
    }
} else {
    echo "Error updating user's answer: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
