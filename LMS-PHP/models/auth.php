<?php
include_once("./config/config.php");
include_once("./config/database.php");


// login function  
function login($conn, $param)
{
    extract($param);

    // echo '<pre>';
    // print_r($param);
    // exit;

    $sql = "SELECT * FROM users where email = '$email'";
    $res = $conn->query($sql);
    if ($res->num_rows > 0) {
        $user = mysqli_fetch_assoc($res);
        $hash = $user['password'];


        if (password_verify($password, $hash)) {
            $result = array('status' => true, 'user' => $user);
        } else {
            $result = array('status' => false);
        }
    } else {
        $result = array('status' => false);
    }
    return $result;
}


// Forget password functionality 
function forgotPassword($conn, $param)
{
    extract($param);
    $sql = "SELECT * FROM users where email = '$email'";
    $res = $conn->query($sql);
    if ($res->num_rows > 0) {
        $user = mysqli_fetch_assoc($res);
        $user_id = $user['id'];
        $datetime  = date("Y-m-d H:i:s");

        // send reset email password with otp 

        $otp = rand(1111, 9999);
        $message = "Pleaes useed this OTP <b>$otp</b> to reset your password";

        // send reset password email
        $to = $email;
        $subject = "Forget password Request";
        $headers = "FROM: prajapatideepak10943@gmail.com" . "\r\n";

        $res  = mail($to, $subject, $message, $headers);
        echo '<pre>';
        print_r($res);
        exit;
        if ($res) {
            $sql = "INSERT INTO reset_password (user_id, reset_code, created_at) VALUES ($user_id, '$otp', '$$datetime)";
            $conn->query($sql);
            $result = array('status' => true);
        } else {
            $result = array('status' => false);
        }
    } else {
        $result = array('status' => false);
    }
    return $result;
}
