<?php
include 'db_connection.php'; // Include your database connection
session_start();
require 'vendor/autoload.php'; // PHPMailer autoload

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $otp = rand(100000, 999999); // Generate 6-digit OTP
    $_SESSION['otp'] = $otp;     // Store OTP in session
    $_SESSION['otp_expiry'] = time() + 300; // OTP valid for 5 minutes

    $mail = new PHPMailer(true);
    try {
        // SMTP server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'code.adarsh121@gmail.com'; // Your email
        $mail->Password = 'vpodcadfbsaqtqnc'; // App password or email password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Use SMTPS
        $mail->Port = 465; // SMTP port

        // Email content
        $mail->setFrom('code.adarsh121@gmail.com', 'Your Website'); // Set sender's email
        $mail->addAddress($email); // Add recipient's email
        $mail->isHTML(true);
        //$mail->Subject = 'Your OTP Code';
        $mail->Subject = 'OPT Likh mc ';
        $mail->Body = "<h3>Your OTP is <b>$otp</b>. It is valid for 5 minutes.</h3>";

        $mail->send();
        
        // Redirect to the validation page
        header("Location: validate_otp.php?email=" . urlencode($email));
        exit(); // Make sure to exit after the redirect
    } catch (Exception $e) {
        echo "Failed to send email. Error: " . $mail->ErrorInfo;
    }
}
?>

<form method="POST">
    <label>Enter Email:</label>
    <input type="email" name="email" required><br>
    <button type="submit">Send OTP</button>
</form>