<?php
include 'db_connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_otp = $_POST['otp'];
    echo "OTP has beed send to your Email ...";

    // Validate OTP
    if (time() > $_SESSION['otp_expiry']) {
        echo "OTP has expired. Please request a new one.";
    } elseif ($user_otp == $_SESSION['otp']) {
        echo "OTP verified successfully!";
        unset($_SESSION['otp']);
        unset($_SESSION['otp_expiry']);
    } else {
        echo "Invalid OTP! ,( Bhag ja bsdk )";
    }
}
?>

<form method="POST">
    <label>Enter OTP:</label>
    <input type="text" name="otp" required><br>
    <button type="submit">Verify OTP</button>
</form>
