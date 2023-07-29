<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Welcome to iDiscuss - Coding Forums</title>
</head>

<body>
    <?php include "partials/dbconnect.php"; ?>
    <?php require "partials/header.php"; ?>
    <?php
    $id = $_GET['thread_id'];
    $sql = "SELECT * from `threads` WHERE `thread_id` = '$id'";
    $result = mysqli_query($conn, $sql);
    while ($rows = mysqli_fetch_assoc($result)) {
        $title = $rows['thread_title'];
        $desc = $rows['thread_desc'];

        $thread_user_id = $rows['thread_user_id'];
        $sql2 = "SELECT `user_email` from `users` WHERE `sno` = '$thread_user_id'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $posted_by = $row2['user_email'];
    }
    ?>
    <?php
    $method = $_SERVER['REQUEST_METHOD'];
    $showAlert = false;
    if ($method == "POST") {
        $cmt_content = $_POST['comment'];
        $sno = $_POST['sno'];
        $sql = "INSERT INTO `comments` (`comment_content`,`thread_id`,`comment_by`,`date_post`) VALUES ('$cmt_content','$id','$sno',current_timestamp())";
        $result = mysqli_query($conn, $sql);


        if ($result) {
            $showAlert = true;
        }
        if ($showAlert) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success</strong> Your Comment has been added !
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        }
    }
    ?>

    <div class="container my-4 w-40">

        <div class="jumbotron">
            <h1 class="display-4"><?php echo $title ?></h1>
            <p class="lead"><?php echo $desc ?></p>
            <hr class="my-4">
            <p>
                Post by: <b><?php echo $posted_by; ?></b>
            </p>

        </div>
    </div>
    <?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        echo '<div class="container">
            <h2 class="py-2">Post a Comment</h2>
            <form action=' . $_SERVER['REQUEST_URI'] . ' method="POST">
                <div class=" form-group">
                 <label for="exampleFormControlTextarea1">Type your Comment</label>
                 <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                 <input type="hidden" name="sno" value="' . $_SESSION['sno'] . '">
                </div>
                <button type="submit" class="btn btn-success">Post Comment</button>
            </form>
            </div>';
    } else {
        echo '<div class="container">
        <h2 clss="py-2">Post a Comment</h2>
        <p class="lead">You are not Signed in . Please login to be able to Start the discussion</p>
    </div>';
    }
    ?>
    <br>
    <div class="container mb-5">
        <h2>Discussions</h2>
        <?php

        $sql = "SELECT * from `comments` WHERE `thread_id` = $id";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while ($rows = mysqli_fetch_assoc($result)) {
            $id = $rows['comment_id'];
            $content = $rows['comment_content'];

            $content = str_replace("<", "&lt", $content);
            $content = str_replace(">", "&gt", $content);
            $comment_time = $rows['date_post'];
            $thread_user_id = $rows['comment_by'];
            $sql2 = "SELECT `user_email` from `users` WHERE `sno` = '$thread_user_id'";
            $result2 = mysqli_query($conn, $sql2);

            $rows2 = mysqli_fetch_assoc($result2);
            // date_default_timezone_set("Asia/Kolkata");
            // $d3 = date("j-m-y h:i:sa");

            $noResult = false;

            echo '<div class="media my-4">
                    <img src="images/download.png" width="45px" class="mr-3" alt="...">
                    <div class="media-body">
                         <p class="font-weight-bold my-0">' . $rows2['user_email'] . 'at' . $comment_time . '</p><p>' . $content . '<p>
                     </div>
                 </div>';
        }
        if ($noResult) {
            echo '<div class="jumbotron jumbotron-fluid">
                <div class="container">
                  <h1 class="display-5">No Comments Found</h1>
                  <p class="lead">Be the first person to comment</p>
                </div>
              </div>';
        }
        ?>
    </div>


    <?php require "partials/footer.php"; ?>

</body>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous">
</script>

</html>