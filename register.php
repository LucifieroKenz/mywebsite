<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <?php 
    require "user.php";
    $user=new User();
    if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username=$_POST["username"];
    $password=$_POST["password"];
    
    $message= $user->register($username,$password);
    echo $message;
    }
    ?>

    <h1>Register</h1>
    <hr>

    <form method="POST" action="register.php">
Username: <input type="text" placeholder="Username" name="username" required> <br>
Password: <input type="password" placeholder="Password" name="password" required> <br>
<button type="submit">
    Register
</button>

    </form>
    <br>
    <h4>Already have an account?</h4> <a href="login.php">Login</a>
</body>
</html>