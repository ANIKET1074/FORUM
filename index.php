<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Welcome to iDiscuss - Coding Forums</title>
</head>

<body>
    <?php include "partials/dbconnect.php"; ?>
    <?php require "partials/header.php"; ?>

    <?php
    if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == true) {
        echo '<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
    <strong>Success!</strong> You can now login.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
    }
    ?>

    <!-- Slider starts from here  -->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="images/3-d-819a.jpg" height="600px" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="images/3-d-820a.jpg" height="600px" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="images/aqua_city-2560x1440.jpg" height="600px" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>


    <div class="container my-4">
        <h2 class="text-center">
            iDiscuss - Browse Categories
        </h2>
        <div class="container">
            <div class="cards my-3">
                <div class="row my-4">
                    <!-- fetch all the categories using while loop -->
                    <?php
                    $sql = "SELECT * from `categories`";
                    $result = mysqli_query($conn, $sql);
                    while ($rows = mysqli_fetch_assoc($result)) {
                        // echo $rows['category_id'];
                        $id = $rows['category_id'];
                        $cat_title = $rows['category_name'];
                        $cat_disc = $rows['category_description'];
                        echo '<div class="col-md-4 my-2">
                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top" src="images/3-d-795a.jpg" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="threadlist.php?cat_id=' . $id . '">' . $cat_title . '</a></h5>
                                    <p class="card-text">' . substr($cat_disc, 0, 55) . '...</p>
                                    <a href="threadlist.php?cat_id=' . $id . '" class="btn btn-primary">View Threads</a>
                                </div>
                            </div>
                        </div>';
                    }
                    ?>
                </div>
            </div>

        </div>
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