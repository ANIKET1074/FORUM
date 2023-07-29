<?php
session_start();
echo "Logged out... Please Wait...";
session_destroy();
header("Location: /forum");
exit;
