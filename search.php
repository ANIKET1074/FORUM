<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Welcome to iDiscuss - Coding Forums</title>
    <style>
        #maincontainer {
            min-height: 87vh;
        }
    </style>
</head>

<body>
    <?php include "partials/dbconnect.php"; ?>
    <?php require "partials/header.php"; ?>



    <!-- Search Results -->
    <div class="container my-3" id="maincontainer">
        <h1 class="text-py-3">Search results for <em>"<?php echo $_GET['search'] ?>"</em></h1>
        <?php
        $query = $_GET['search'];
        $sql =  "SELECT * FROM `threads` WHERE MATCH (`thread_title`,`thread_desc`) against ('$query')";
        $result = mysqli_query($conn, $sql);
        $noResults = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $thread_id = $row['thread_id'];
            $thread_cat_id = $row['thread_cat_id'];
            $noResults = false;
            $url = "thread.php?thread_id=" . $thread_id . "&&cat_id=" . $thread_cat_id;
            echo '<div class="result">
                    <h3><a href="' . $url . '" class="text-dark">' . $title . '</a></h3>
                    <p>' . $desc . '</p>
                    </div>';
        }
        if ($noResults) {
            echo '<div class="jumbotron jumbotron-fluid">
            <div class="container">
              <h1 class="display-5">No Results Found</h1>
              <p class="lead">Suggestions:<ul>

              <li>Make sure that all words are spelled correctly.</li>
              <li>Try different keywords.</li>
              <li>Try more general keywords.</li>
              <li>Try fewer keywords.</li></ul>
              </p>
            </div>
          </div>';
        }
        ?>
    </div>
    <?php require "partials/footer.php"; ?>

</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>

</html>