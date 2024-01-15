<?php
 session_start(); 
 include("../conn2.php");
 $exmne_id = $_SESSION['examineeSession']['exmne_id'];

    $questionId = $_POST['questionIdStatus'];

    $sql2 = "SELECT exam_answer, user_answared FROM exam_questions_atp WHERE id = ? AND exmne_id = ?";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param("ii", $questionId, $exmne_id);
    $stmt2->execute();
    $result = $stmt2->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $correctAnswer = $row['exam_answer'];
        $userSelectedAnswer = $row['user_answared'];

        if($userSelectedAnswer != NULL){
            if ($userSelectedAnswer == $correctAnswer) {
                echo "You Select Correct Option";
            } else {
                echo "You Select Wrong Option";
            }
        }
    }
$stmt2->close();
$conn->close();
?>
