<?php
include_once 'database.php';
include_once 'utility.php';

if(isset($_POST['ResetBtn'])){

    $form_errors=array();
    $required_fields=array('email','new_password','confirm_password');

    $form_errors=array_merge($form_errors,check_empty_fields($required_fields));
   $fields_to_check_length=array('new_password'=>6,'confirm_password'=>6);
   
   $form_errors= array_merge($form_errors,check_min_length($fields_to_check_length));

   $form_errors=array_merge($form_errors,check_email($_POST));

   if(empty($form_errors)){
    $email=$_POST['email'];
    $password1=$_POST['new_password'];
    $password2=$_POST['confirm_password'];

if($password1 !=$password2){
    $result="<p style='padding:20px;border:1px solid gray;color:red;'>new password and confirm password does not match</p>";

}
else{
    try{
        $sqlQuery="SELECT email FROM User WHERE email=:email";
        $statement = $db->prepare($sqlQuery);
        $statement->execute(array(':email'=>$email));

        if($statement->rowCount() ==1){
            $hashed_password=password_hash($password1,PASSWORD_DEFAULT);

            $sqlUpdate="UPDATE user SET password =:password  WHERE email =:email";
            $statement =$db->prepare($sqlUpdate);
            $statement->execute(array(':password'=>$hashed_password,'email'=>$email));
            $result="<p style='padding:20px';border:1px solid gray;color:green> password reset successfuly</p>";
        }
        else{
            $result="<p style='padding:20px;border:1px solid gray;color:red;'> the email address provided 
            does not exist in our database. please try again</p>";
        }
    }catch(PDOException $ex){
        $result="<p style='padding:20px;border:1px solid gray;color:red'>an error occured:".$ex->getMessage()."</p>";
    }
 } 
}
else{
  if(count($form_errors) ==1){
    $result="<p style='color:red;'>there was 1 error in the form<br>";

  }
  else{
    $result="<p style='color:red'> there were " . count($form_errors) ."errors in the form <br>";
  }
}
   }
?>

























<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2> user Authentication system</h2>
    <h3>password reset page</h3>

    <?php   if(isset($result)) echo $result; ?>
    <?php if(!empty($form_errors)) echo show_errors($form_errors); ?>


    <form action="" method="POST">

    <label for=""> email</label><br>
    <input type="text" name="email"><br>
    <label for="">New password</label><br>
    <input type="password" name="new_password"><br>
    <label for="">confirm password</label><br>
    <input type="password" name="confirm_password"><br>
    <button type="button" name="ResetBtn"> Reset password</button><br>
    </form>
    <p><a href="index.php">back</a></p>
</body>
</html>