<?php
session_start();
if(!isset($_SESSION['username'])||$_SESSION['role']!='client'){
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CLIENT DASHBOARD</title>
</head>
<body>
    <h2>Welcome Client</h2>
    <?php
    echo $_SESSION['username'];
    ?>
    <br>
    <a href="logout.php">LOGOUT</a>
</body>
</html>