<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include './dbconnect.php';
    $user = $_POST['loginEmail'];
    $pass = $_POST['lpassword'];
    $sql = "SELECT * FROM `users` WHERE user_email = '$user'";
    $result = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($result);
    if ($numRows == 1) {
        $rows = mysqli_fetch_assoc($result);
        if (password_verify($pass, $rows['user_password'])) {
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['sno'] = $rows['sno'];
            $_SESSION['useremail'] = $user;

            // echo "logged in";
        }
        header("Location: /forum/index.php");
    } else {
        header("Location: /forum/index.php");
    }
}
