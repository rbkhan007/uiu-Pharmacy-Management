<?php
  require "php/db_connection.php";

  // Optionally log out logic can go here, e.g. clearing session
  session_start();
  session_destroy(); // End the session for the user

  // No need to update IS_LOGGED_IN if you are not keeping track of it
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Logout</title>
    <script src="js/restrict.js"></script>
</head>
<body>
    <h1>You have been logged out.</h1>
    <a href="login.php">Login Again</a> <!-- Provide a way to log back in -->
</body>
</html>
