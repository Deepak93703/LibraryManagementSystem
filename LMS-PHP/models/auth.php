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
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $res = $conn->query($sql);

    if ($res->num_rows > 0) {
        $user = mysqli_fetch_assoc($res);
        $user_id = $user['id'];
        $datetime = date("Y-m-d H:i:s");

        $otp = rand(1111, 9999);

        $message = "
        <html>
        <head>
            <title>Reset Password OTP</title>
        </head>
        <body>
            <p>Please use this OTP <b>$otp</b> to reset your password.</p>
        </body>
        </html>";

        $to = $email;
        $subject = "Forgot Password Request";

        $headers  = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: prajapatideepak10943@gmail.com" . "\r\n";

        $mailSent = mail($to, $subject, $message, $headers);

        if ($mailSent) {
            $sql = "INSERT INTO reset_password (user_id, reset_code, created_at)
                    VALUES ($user_id, '$otp', '$datetime')";
            $conn->query($sql);

            $result = array('status' => true);
        } else {
            $result = array('status' => false, 'message' => 'Failed to send email');
        }
    } else {
        $result = array('status' => false, 'message' => 'Email not found');
    }

    return $result;
}




// Reset password functionality 
function resetPassword($conn, $param)
{
    $var = extract($param);
    // echo '<pre>';print_r($var);exit;
    $sql = "SELECT * FROM reset_password where reset_code = '$reset_code'";
    $res = $conn->query($sql);
    if ($res->num_rows > 0) {
        $code = mysqli_fetch_assoc($res);


        if ($password == $cnf_password) {
            $hash = password_hash($password, PASSWORD_DEFAULT);


            // update password 
            $sql = "UPDATE users SET password = '$hash' WHERE id = " . $code['user_id'];

            $conn->query($sql);

            // Delete Reset password 
            $sql = "DELETE  FROM  reset_password where id =" . $code['id'];
            $conn->query($sql);

            $result = array("status"  => True, "message" => "Password has been Reset Successfully");
        } else {
            $result = array("status"  => false, "message" => "Confirm password doesn't match");
        }
    } else {
        $result = array('status' => false, 'message' => "Inavlid Reset Code");
        header("LOCATION: " . BASE_URL . 'reset-password.php');
        exit;
    }
    return $result;
}


// change password functionality 
function changePassword($conn, $data) {
    session_start();
    $userId = $_SESSION['user']['id'];
    $currentPass = $data['current_pass'];
    $newPass = $data['new_pass'];
    $confPass = $data['conf_pass'];

    if ($newPass !== $confPass) {
        return ['status' => false, 'message' => 'New password and confirm password do not match.'];
    }

    $sql = "SELECT password FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    if (!$result) return ['status' => false, 'message' => 'User not found.'];

    if (!password_verify($currentPass, $result['password'])) {
        return ['status' => false, 'message' => 'Current password is incorrect.'];
    }

    $hashedNewPass = password_hash($newPass, PASSWORD_BCRYPT);

    $update = "UPDATE users SET password = ? WHERE id = ?";
    $stmt = $conn->prepare($update);
    $stmt->bind_param("si", $hashedNewPass, $userId);
    $stmt->execute();

    return ['status' => true, 'message' => 'Password updated successfully.'];
}



// function to update profile functionality 
function updateProfile($conn, $param, $files)
{
    extract($param);
    // echo '<pre>';print_r($files);exit;

    $uploadTo = "assets/uploads/";
    $allowedFileTypes = array("jpg", "png", "jpeg", "gif");
    $fileName = $files['profile_pic']['name'] ?? '';
    $tempPath = $files['profile_pic']['tmp_name'] ?? '';
    $datetime = date("Y-m-d H:i:s");

    $sql = "UPDATE users SET 
                name = '$name',
                email = '$email',
                phone_no = '$phone_no',
                updated_at = '$datetime'";

    if (!empty($fileName)) {
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
        if (in_array(strtolower($fileType), $allowedFileTypes)) {
            $newFileName = time() . "_" . basename($fileName);
            $destination = $uploadTo . $newFileName;

            if (move_uploaded_file($tempPath, $destination)) {
                if (!empty($_SESSION['user']['profile_pic']) && file_exists($uploadTo . $_SESSION['user']['profile_pic'])) {
                    unlink($uploadTo . $_SESSION['user']['profile_pic']);
                }
                $sql .= ", profile_pic = '$newFileName'";
                $_SESSION['user']['profile_pic'] = $newFileName;
            } else {
                return ['status' => false, 'message' => 'Failed to upload file'];
            }
        } else {
            return ['status' => false, 'message' => 'Invalid file format'];
        }
    }

    $sql .= " WHERE id = '" . $_SESSION['user']['id'] . "'";


    if ($conn->query($sql)) {
        $_SESSION['user']['name'] = $name;
        $_SESSION['user']['email'] = $email;
        $_SESSION['user']['phone_no'] = $phone_no;
        return ['status' => true, 'message' => 'Profile has been updated successfully'];
    } else {
        return ['status' => false, 'message' => 'Database update failed: ' . $conn->error];
    }
}
