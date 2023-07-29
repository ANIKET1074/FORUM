<?php
session_start();
echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<a class="navbar-brand" href="#">iDiscuss</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav mr-auto">
    <li class="nav-item active">
      <a class="nav-link" href="/forum">Home <span class="sr-only">(current)</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="about.php">About</a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Categories
      </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdown">';

//here we use limit 3 for showing only 3 entries in the drop-down
$sql = "SELECT category_name,category_id from `categories` LIMIT 3";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
  echo '<a class="dropdown-item" href="threadlist.php?cat_id=' . $row['category_id'] . '">' . $row['category_name'] . '</a>';
}

echo '</div>
    </li>
    <li class="nav-item">
      <a class="nav-link " href="contact.php">Contact</a>
    </li>
  </ul>
  <div class="row mx-2">';
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  echo '<form class="form-inline my-2 my-lg-0" action="search.php" method="GET">
  <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
  <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
<p class = "text-light mb-0 mx-2">Welcome ' . $_SESSION['useremail'] . '</p>
  </form>
<a href="/forum/partials/logOut.php" class="btn btn-outline-success" >LogOut</a>';
} else {
  echo '<form class="form-inline my-2 my-lg-0 action="search.php" method="GET">
        <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
      </form>
      <button class="btn btn-outline-success mx-2" data-toggle="modal" data-target="#loginModal">Login</button>
      <button class="btn btn-outline-success" data-toggle="modal" data-target="#signupModal">Signup</button>';
}

echo '</div>
  </div>
  </nav>';

include 'loginModal.php';
include 'partials/signupModal.php';
