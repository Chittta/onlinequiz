<?php
 session_start(); 
 include("../conn.php");
 extract($_POST);

 $exmne_id = $_SESSION['examineeSession']['exmne_id'];



$selExAttempt = $conn->query("SELECT * FROM exam_attempt WHERE exmne_id='$exmne_id' AND exam_id='$exam_id'  ");

// $selAns = $conn->query("SELECT * FROM exam_answers WHERE axmne_id='$exmne_id' AND exam_id='$exam_id' ");


if($selExAttempt->rowCount() > 0)
{
	$res = array("res" => "alreadyTaken");
}
else
{


			 $insAttempt = $conn->query("INSERT INTO exam_attempt(exmne_id,exam_id)  VALUES('$exmne_id','$exam_id') ");
			 if($insAttempt)
			 {
				 $res = array("res" => "success");
			 }
			 else
			 {
				 $res = array("res" => "failed");
			 }
	


}


// print_r($res);die;
 
 

 echo json_encode($res);
 ?>


 