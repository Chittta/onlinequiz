<?php
 include("../../../conn.php");
extract($_POST);
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require 'src/PHPMailer.php';
    require 'src/SMTP.php';
    require 'src/Exception.php';
    // if(isset($_POST['send'])){
        $mail= new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host='smtp.gmail.com';
        $mail->SMTPAuth=true;
        $mail->Username='chittaranjanmohanta67@gmail.com';
        $mail->Password='Chinki@212';
        $mail->SMTPSecure='ssl';
        $mail->Port=465;
        $mail->setFrom('chittaranjanmohanta67@gmail.com');
        // $mail->addAddress($_POST["email"]);
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject= "Judicial Academy Exam";
        // $mail->Body= $_POST["message"];
        $mail->Body= '<div>
							<label>
								<span><strong>User Id : </strong>'.$email.'</span> <br>
								<span><strong>Password : </strong>'.$password.'</span> 
							</label>
					  </div>';
                      $mail->send();
        // if($mail->send()){
        //     echo "<script>alert('Email Send Successfully')</script>";
        // }else{
        //     echo $mail->ErrorInfo;
        // }
    // }
?>