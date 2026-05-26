<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function send_verification($fullname, $email, $otp){
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'andrejustin.valenzuela.cics@ust.edu.ph'; 
        $mail->Password   = 'utxd oqnk seqv mpfc'; 
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('andrejustin.valenzuela.cics@ust.edu.ph', 'Movie Booker');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = "OTP Verification";
        $mail->Body    = '<h3 style="color: #004aad; margin-bottom: 20px;">What is up bro, '.$fullname.'</h3>
                          <p>Thank you for signing up at <strong>Movie Booker</strong>.</p>
                          <p style="margin-top: 20px;">To complete your registration, please proceed to the OTP verification page and enter the code below to verify your email address.</p>
                          <p>Verification code:</p>
                          <div style="background-color: #f8f9fa; padding: 15px; border-radius: 5px; text-align: center; font-size: 24px; color: #004aad; font-weight: bold;">'.$otp.'</div>
                          <p style="margin-top:10px;font-size: 14px; color: #6c757d;">— Movie Booker Team</p>';

        $mail->send();
    } catch (Exception $e) {
        echo "<script>console.log('Mailer Error: " . $mail->ErrorInfo . "');</script>";
    }
}
?>