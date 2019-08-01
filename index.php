<?php

header('Access-Control-Allow-Origin: *');
$response = (object)array("status"=> "", "message"=>"");

require('phpmailer/class.phpmailer.php');


$mail = new PHPMailer(true);
$mail->SMTPSecure = "tls";
$mail->Port     = 587;  
$mail->Username = "infotestguident077@gmail.com";
$mail->Password = "GreatIndia@123";
$mail->Host     = "smtp.gmail.com";
$mail->Mailer   = "smtp";
$mail->IsSMTP();
$mail->SMTPDebug = 0;
$mail->SMTPAuth = true;
$mail->SMTPKeepAlive = true;  
$mail->CharSet = 'utf-8'; 
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
$mail->SetFrom($_POST['email'],$_POST['firstname']);
$mail->AddReplyTo($_POST['email'], $_POST['firstname']);
$mail->AddAddress("husainakhter@gmail.com");	
$mail->Subject = $_POST['subject'];
$mail->WordWrap   = 80;
$mail->MsgHTML($_POST['category']);



foreach ($_FILES["file"]["name"] as $k => $v) {
    $mail->AddAttachment( $_FILES["file"]["tmp_name"][$k], $_FILES["file"]["name"][$k] );
}

$mail->IsHTML(true);

if(!$mail->Send()) {
    
    $response->status = "error";
	$response->message= "Problem sending email";
} else {
    
     $response->status = "success";
	 $response->message= "Mail Sent Successfully." ;
}	


echo json_encode($response);

die();
?>