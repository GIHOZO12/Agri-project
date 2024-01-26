
<?php
include_once 'session.php';
include_once 'database.php';
include_once 'utility.php';

if( isset($_POST['loginBtn'])){
    $form_errors=array();

    $required_fields= array('email','password');

    $form_errors=array_merge($form_errors,check_empty_fields($required_fields));

    if(empty($form_errors)){
  $user=$_POST['email'];
  $password=$_POST['password'];

  $sqlQuery="SELECT * FROM User WHERE email=:email";
  $statement =$db->prepare($sqlQuery);
  $statement->execute(array(':email'=>$user));
   while ($row =$statement->fetch()){
    $id=$row['id'];
    $hashed_password=$row['password'];
    $email=$row['email'];

    if(password_verify($password,$hashed_password)){
        $_SESSION['id']=$id;
        $_SESSION['email']=$email;
        header("location:index.php");
    }
    else{
        $result="<p stlye='padding:20px;color:red;border:1px solid gray;'>invalid email or password</p>";
    }

   }
    }
    else{
        if(count($form_errors)==1){
            $result="<p style='color:red;'>there was one error in the form</p>";
        }
        else{
  $result="<p style='color:red;'>there were" .  count($form_errors)  . "errors in the form</p>";
        }
    }
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login page</title>
    <!-- <style>

        .main-bar{
            display: flex;
            align-items: center;
            justify-content: center;
        }
        form label{
            display: flex;
            flex-direction: column;
        }
        form button{
  margin: 10px;
  width: 50%;
  background: blue;
  color: white;
        }
    </style> -->
</head>
<body>
<h1>user AUthetication system</h1>

<div class="main-bar">

<h3>login form</h3>
<?php
if(isset($result)) echo $result;?>
<?php 
if(!empty($form_errors)) echo show_errors($form_errors); 
?>
<form action="" method="post">

<label for="">Email</label>
<input type="text" name="email"><br>
<label for="">password</label>
<input type="password" name="password"><br>
<button type="button " name="loginBtn">login</button>
<a href="reset.php">forgot password</a>
</form>
</div>
<p><a href="index.php">back</a></p>
</body>
</html>