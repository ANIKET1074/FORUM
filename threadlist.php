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
    $id = $_GET['cat_id'];

    $sql = "SELECT * from `categories` WHERE `category_id` = $id";
    $result = mysqli_query($conn, $sql);
    while ($rows = mysqli_fetch_assoc($result)) {
        $cat_name = $rows['category_name'];
        $cat_desc = $rows['category_description'];
    }
    ?>
    <?php
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == "POST") {
        //Inserting data into the database
        $th_title = $_POST['title'];
        $th_desc = $_POST['desc'];
        $sno = $_POST['sno'];
        // print_r($_POST);


        // $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '0', current_timestamp());"/;
        $sql = "INSERT INTO `threads` ( `thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ( '$th_title', '$th_desc ', '$id', '$sno', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $showAlert = true;
        }

        if ($showAlert) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success</strong> Your thread has been added successfully
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        }
    }
    ?>
    <div class="container my-4 w-40">

        <div class="jumbotron">
            <h1 class="display-4">Welcome to the <?php echo $cat_name ?> Forums</h1>
            <p class="lead"><?php echo $cat_desc ?></p>
            <hr class="my-4">
            <p>It uses utility classes for typography and spacing to space content out within the larger
                container.
            </p>
            <p class="lead">
                <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
            </p>
        </div>
    </div>
    <?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        echo '<div class="container">
            <h2 py-2>Start a discussion</h2>
            <form action=' . $_SERVER["REQUEST_URI"] . ' method="POST">
                <div class="form-group">
                    <label for="exampleInputEmail1">Problem Title</label>
                    <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                    <small id="emailHelp" class="form-text text-muted">Keep Your title as short and krisp as
                        possible</small>
                </div>
                <div class="form-group">
                    <input type="hidden" name="sno" value="' . $_SESSION['sno'] . '">
                    <label for="exampleFormControlTextarea1">Elaborate your Concern</label>
                    <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
    
            </form>
            <br>
        </div>';
    } else {
        echo '<div class="container">
        <h2 py-2>Start a discussion</h2>
        <p class="lead">You are not Signed in . Please login to be able to Start the discussion</p>
    </div>';
    }

    ?>


    <div class="container mb-5">
        <h2>Browse Questions</h2>
        <?php
        $sql = "SELECT * from `threads` WHERE `thread_cat_id` = $id";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while ($rows = mysqli_fetch_assoc($result)) {
            $id = $rows['thread_id'];
            $title = $rows['thread_title'];
            $desc = $rows['thread_desc'];

            $title = str_replace("<", "&lt", $title);
            $title = str_replace(">", "&gt", $title);
            $desc = str_replace("<", "&lt", $desc);
            $desc = str_replace(">", "&gt", $desc);

            $thread_time = $rows['timestamp'];
            $thread_user_id = $rows['thread_user_id'];
            $sql2 = "SELECT `user_email` from `users` WHERE `sno` = '$thread_user_id'";
            $result2 = mysqli_query($conn, $sql2);
            $rows2 = mysqli_fetch_assoc($result2);


            // date_default_timezone_set("Asia/Kolkata");
            // $d3 = date("j-m-y h:i:sa");
            $noResult = false;
            echo '<div class="media my-4">
                <img src="images/download.png" width="45px" class="mr-3" alt="...">
                <div class="media-body">
                    <h5 class="mt-0"><a class = "text-dark" href = "thread.php?thread_id=' . $id . '&&cat_id=' . $id . '">' . $title . '</a> </h5>' . $desc . '
                </div><p class="font-weight-bold my-0">Asked by: ' . $rows2['user_email'] . ' at ' . $thread_time . '</p>
            </div>';
        }
        if ($noResult) {
            echo '<div class="jumbotron jumbotron-fluid">
            <div class="container">
              <h1 class="display-5">No Threads Found</h1>
              <p class="lead">Be the first person to ask the question</p>
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