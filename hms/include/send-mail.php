<?php
$roles = ['admin', 'doctor'];
$linkSubPath = '';
foreach ($roles as $role) {
    if (str_contains($_SERVER['REQUEST_URI'], $role)) {
        $linkSubPath = '../../';
        break;
    }
}
if(str_contains($_SERVER['REQUEST_URI'], 'hms')) {
    $linkSubPath = '../';
}

// $getReqUri = (str_contains($_SERVER['REQUEST_URI'], 'admin') || str_contains($_SERVER['REQUEST_URI'], 'admin')) ? true : false;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require $linkSubPath.'phpmailer/src/PHPMailer.php';
require $linkSubPath.'phpmailer/src/SMTP.php';
require $linkSubPath.'phpmailer/src/Exception.php';

function sendEmail($from, $to, $subject, $body) {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $server_ip = $_SERVER['SERVER_ADDR'];

        // Sender and recipient
        $mail->setFrom($from, 'SatSpandana Wellness');
        $mail->addAddress($to);

        // Email content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;

        if ($server_ip === '127.0.0.1' || $server_ip === '::1') {

            $mail->Host       = 'smtp.gmail.com';         // SMTP server
            $mail->SMTPAuth   = true;
            $mail->Username   = 'athul.mhn@gmail.com';   // Your SMTP username
            $mail->Password   = 'ueup qowu wplu ypzj';      // App password (not your Gmail password)
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;
        } else {

            $mail->Host       = 'localhost';         // SMTP server
            $mail->SMTPAuth   = false;
            $mail->Username   = 'admin@satspandana.com';   // Your SMTP username
            $mail->Password   = '*Mac*^=@Q+V?';      // App password (not your Gmail password)
            $mail->SMTPSecure = false;
            $mail->Port       = 25;
        }

        $mail->send();
        return true;

    } catch (Exception $e) {
        print_r($e);
        error_log("Email failed. Error: {$mail->ErrorInfo}");
        return false;
    }
}
?>