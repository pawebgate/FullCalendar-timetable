<?php

$address ='panagiotisargy77@gmail.com';

require_once('class.phpmailer.php');

$mail = new PHPMailer(); 

$mail->CharSet = 'UTF-8';

$mail->SetFrom($address);

$mail->AddAddress('pan_cy1@unipi.gr');

$mail->Subject = 'Booking Request';

$mail->Body ='<!DOCTYPE html><head><meta charset="UTF-8"></head><body><p>There is problem with </p></body></html>';

$mail->IsHTML(true);  

$mail->Send();

    
?>  