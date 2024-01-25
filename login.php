<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login page</title>
    <style>

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
    </style>
</head>
<body>
<h1>user AUthetication system</h1>

<div class="main-bar">

<h3>login form</h3>


<form action="" method="post">

<label for="">Email</label>
<input type="email" name="email"><br>
<label for="">password</label>
<input type="password" name="password"><br>
<button type="button " name="send">login</button>

</form>
</div>
<p><a href="index.php">back</a></p>
</body>
</html>