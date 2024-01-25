<?php

include_once 'database.php';
include_once 'utility.php';


if (isset($_POST['signBtn'])) {
    $form_error = array();
    $required_fields = array('username', 'email', 'password');

    foreach ($required_fields as $field) {
        if (!isset($_POST[$field]) || $_POST[$field] === '') {
            $form_error[] = $field;
        }
    }

    if (empty($form_error)) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    





// if (isset($_POST['username'], $_POST['email'], $_POST['password'])) {
//     $username = $_POST['username'];
//     $email = $_POST['email'];
//     $password = $_POST['password'];
//     $hashed_password=password_hash($password,PASSWORD_DEFAULT);
// }

try {
    $sqlInsert = "INSERT INTO User (username, email, password, join_date)
                  VALUES (:username, :email, :password, NOW())";

    $statement = $db->prepare($sqlInsert);
    $statement->execute(array('username' => $username, 'email' => $email, 'password' => $hashed_password));

    if ($statement->rowCount() == 1) {
        $result = "<p style='padding:20px;color:green;'>Registration successful</p>";
    } else {
        $result = "<p style='padding:20px;color:red;'>Registration failed</p>";
    }
} catch (PDOException $ex) {
    $result = "<p style='padding:20px;color:red;'>An error occurred: ".$ex->getMessage(). "</p>";
}
}
else {
    if (count($form_error) == 1) {
        $result = "<p style='color:red;'>There was an error in the form</p>";
        $result .= "<ul style='color: red;'>";
        foreach ($form_error as $error) {
            $result .= "<li>{$error}</li>";
        }
        $result .= "</ul>";
    }
     else {
        $result = "<p style='color:red;'>There were " . count($form_error) . " errors in the form<br>";
        $result .= "<ul style='color:red;'>";
        foreach ($form_error as $error) {
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
</head>
<body>
<h1>user AUthetication system</h1>

<div class="main-bar">

<h3>registration form</h3>

<?php
if(isset($result)) echo $result;
?>
<form action="" method="post">
    <label for="">username</label><br>
<input type="text" name="username"><br>
<label for="">Email</label><br>
<input type="email" name="email"><br>
<label for="">password</label><br>
<input type="password" name="password"></li><br>
<button type="button " name='signupBtn'>signup</button>

</form>
</div>
<p><a href="index.php">back</a></p>
</body>
</html>


