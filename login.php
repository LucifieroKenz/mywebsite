<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php 
    session_start();
    require "user.php";
    $user =new User();
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $username=$_POST["username"];
        $password=$_POST["password"];

        $message=$user->login($username,$password);

        if($message=="Login Successful"){
            $_SESSION["username"]=$username;
            header("Location: dashboard.php");
        }
        else{
            echo $message;
        }
    }
    
    ?>
    <h1>Login</h1>
    <hr>

    <form method="POST" action="login.php">
Username: <input type="text" placeholder="Username" name="username"> <br>
Password: <input type="password" placeholder="Password" name="password"> <br>
<button type="submit">
    Login
</button>

    </form>
    <br>
    <h4>No account?</h4> <a href="register.php">Register</a>
</body>
</html>