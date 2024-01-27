<?php

include_once 'database.php';
include_once 'utility.php';


if (isset($_POST['signupBtn'])) {
    $form_errors = array();
    $required_fields = array('username', 'email', 'password');

    $form_errors=array_merge($form_errors,check_empty_fields($required_fields));
    $fields_to_check_length=array('username'=>4,'password'=>6);

    $form_errors=array_merge($form_errors,check_min_length($fields_to_check_length));

    $form_errors=array_merge($form_errors,check_email($_POST));

    foreach ($required_fields as $name_of_field) {
        if (!isset($_POST[$name_of_field]) || $_POST[$name_of_field] == NULL) {
            $form_errors[] = $name_of_field ."  is a required field";
        }
    }

    if (empty($form_errors)) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

try {
    $sqlInsert = "INSERT INTO User (username, email, password, join_date)
                  VALUES (:username, :email, :password, NOW())";

    $statement = $db->prepare($sqlInsert);
    $statement->execute(array(':username' => $username, ':email' => $email, ':password' => $hashed_password));

    if ($statement->rowCount() == 1) {
        $result = "<p style='padding:20px; ;color:#11ff00; text-align:center'>Registration successful</p>";
      
    } else {
        $result = "<p style='padding:20px;border:1px solid gray;color:red;'>Registration failed</p>";
    }
} catch (PDOException $ex) {
    $result = "<p style='padding:20px;color:red;'>An error occurred: ".$ex->getMessage(). "</p>";
}
    }
else {
    if (count($form_errors) == 1) {
        $result = "<p style='color:red;'>There was an error in the form";
        $result .= "<ul style='color: red;'>";
        foreach ($form_errors as $error) {
            $result .= "<li>{$error}</li>";
        }
        $result .= "</ul></p>";
    }
     else {
        $result = "<p style='color:red;'>There were " . count($form_errors) . " errors in the form<br>";
        $result .= "<ul style='color:red;'>";
        foreach ($form_errors as $error) {
            $result .= "<li>{$error}</li>";
        }
        $result .= "</ul></p>";
    }
}
}

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>

.main-bar{
    
    display: flex;
    align-items: center;
    justify-content: center;
}
form{
  margin-top: 100px;

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

<?php
if(isset($result)) echo $result;
?>
<?php
if(!empty($form_errors)) echo show_errors($form_errors);
?> 

<div class="main-bar">
<!-- <h3 style="text-align: center;">signup page</h3> -->
<form action="" method="post">
    <label for="">username</label><br>
<input type="text" name="username"><br>
<label for="">Email</label><br>
<input type="text" name="email"><br>
<label for="">password</label><br>
<input type="password" name="password"></li><br>
<button type="button " name='signupBtn'>create account</button>
<a href="login.php">back to signin</a>

</form>
</div>
<!-- <p><a href="index.php">back</a></p> -->
</body>
</html>


