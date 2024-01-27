
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
        header("location:index.html");
    }
    else{
        $result="<p style='margin:20px;color:red;text-align:center;'>invalid email or password</p>";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>

        .main-bar{
            
            display: flex;
            align-items: center;
            justify-content: center;
        }
        form{
          margin-top: 200px;
 
        }
        form label{
        
            display: flex;
            flex-direction: column;
        }
        form input{
            padding: 5px;
        }
        form button{
  margin: 10px;
  width: 100%;
  background: blue;
  border-radius: 5px;
  padding: 5px;
  color: white;
        }
    </style>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="aside" style="background: transparent;">
            <div class="logo"><a href="">Muhinzi <i class="fa fa-seedling"></i></a>
            </div>
        
            <div class="nav-toggler">
                <span></span>
            </div>
        <!-- <ul class="nav">
            <li><a href="#" class="active"><i class="fa fa-home"></i>Home</a></li>
            <li><a href="#about"><i class="fa fa-user"></i>User</a></li>
            <li><a href="#protofolio"><i class="fa fa-briefcase"></i>Investors</a></li>
            <li><a href=""><i class="fa fa-comments"></i>Report</a></li>
            <li><a href=""><i class="fa fa-message"></i>Message</a></li>
        </ul> -->
        
        </div>
        <h3 style="text-align: center;">login form</h3>
<div class="main-bar">


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
<button type="button " name="loginBtn">login</button><br>
<a href="reset.php">forgot password</a><br>
not yet a member ? <a href="signup.php">signup</a>
</form>
</div>
<!-- <p><a href="index.php">back</a></p> -->
</body>
</html>
