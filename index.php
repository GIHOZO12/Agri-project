<?php 

include_once 'session.php';?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>user AUthetication system</h1>
    <hr>
<?php if(!isset($_SESSION['email'])):?>
<P>you are currently not sign in <a href="login.php">Login</a> not yet a member ? <a href="signup.php">signup</a></P>
<?php else:?>
<p> you are logged in as <?php if(isset($_SESSION['email'])) echo $_SESSION ['email'];?> <a href="logout.php">log out</a></p>
    <?php endif 
    ?>
</body>
</html>


