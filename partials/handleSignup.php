<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "./dbconnect.php";
    $user_email = $_POST['signUpemail'];
    $user_password = $_POST['password'];
    $user_cpassword = $_POST['cpassword'];
    $showAlert = false;
    //Check whether the user exists or not
    $existsql = "SELECT * FROM `users` WHERE user_email = '$user_email'";
    $result = mysqli_query($conn, $existsql);
    $numRows = mysqli_num_rows($result);
    // echo var_dump($numRows);
    if ($numRows > 0) {
        $showError = "Email already exists";
    } else {
        if ($user_password == $user_cpassword) {
            $hash = password_hash($user_password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`user_email`,`user_password`,`timestamp`) VALUES ('$user_email','$hash',current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $showAlert = true;
                header("Location: /FORUM/index.php?signupsuccess=true");
                exit();
            }
        } else {
            $showError = "Passwords do not match";
        }
        header("Location:/FORUM/index.php?signupsuccess=false");
    }
}
