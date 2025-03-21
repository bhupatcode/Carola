<?php
@include "include/config.php";
$email = $password = $pass = $em = "";
session_start();

if (isset($_POST["login"])) {
    $count = 0;
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email == "") {
        $em = "Enter Email ID !";
        $count++;
    } else {
        $ex1 = '/^[a-zA-Z0-9]+@[a-zA-Z]+\.[a-zA-z]/';
        if (!preg_match($ex1, $email)) {
            $em = "Enter Valid Email Address !";
            $count++;
        }
    }

    if ($password == "") {
        $pass = "Enter The Password";
        $count++;
    } else {
        if (strlen($password) < 8) {
            $pass = "Enter At least 8 characters!";
            $count++;
        }
    }

    if($count==0)
    {

    // first check user exist
    $query = "SELECT * FROM reguser WHERE email='$email'";
    $exquery = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($exquery);

    if ($user) {
        // user exist but not verified
        if ($user['is_verified'] != 1) {
            echo "<script>alert('⚠️ Your account is not verified!');</script>";
        }
        //  password wrong 
        elseif ($user['password'] != $password) {
            echo "<script>alert('⚠️ User Not Found!');</script>";
        }
        // all right 
        else {
            $_SESSION["alogin"] = $user["email"];
            $_SESSION["uname"] = $user["name"];
            $_SESSION["userid"] = $user["uid"];

            header("location: index.php");
            exit();
        }
    } else {
        // user not exist
        echo "<script>alert('⚠️ User Not Found!');</script>";
    }
}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <style>
          @font-face {
            font-family: 'pop-regular';
            src: url('font/Poppins-Regular.ttf');
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family:'pop-regular';
            font-size: 20px;
        }

        body {
            display: flex;
            /*justify-content: center;*/
            align-items: center;
            min-height: 100vh;
            background: url("image/login_bg.jpg") no-repeat;
            background-size: cover;

        }

        .container {
            /* background:green;*/
            margin-left: 50px;
            width: 355px;
            border: 2px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            color: #fff;
            border-radius: 10px;
            padding: 30px 40px;
            backdrop-filter: blur(6px);

        }

        .container h1 {
            font-size: 36px;
            text-align: center;
        }

        .container .input-box {
            position: relative;
            width: 100%;
            margin: 30px 0;
        }

        .input-box input {
            width: 100%;
            height: 6vh;
            background: transparent;
            border: none;
            outline: none;
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 5px;
            font-size: 16px;
            color: #fff;
            padding: 20px 45px 20px 20px;
        }

        .input-box input::placeholder {
            color: #fff;
        }

        .container .remember-forgot {
            display: flex;
            justify-content: space-between;
            margin: -15px 0px 15px;
        }

        .remember-forgot label input {
            color: #fff;
            margin-right: 5px;
        }

        .remember-forgot a {
            color: #fff;
            text-decoration: none;
            margin-left: 40px;
            margin-right: -40px;
        }

        .remember-forgot a:hover {
            text-decoration: underline;
        }

        .container .btn {
            width: 100%;
            height: 45px;
            background: white;
            border: none;
            outline: none;
            border-radius: 5px;
            box-decoration-break: 0px 0px 10px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            font-size: 16px;
            font-weight: 400;
            color: #333;
        }

        .container .register-link {
            font-size: 14.5px;
            text-align: center;
            margin: 20px 0px 20px;
        }

        .register-link p a {
            color: #fff;
            text-decoration: none;

        }

        .register-link p a:hover {
            text-decoration: underline;
        }

        .content {
            margin-left: 50px;
            color: #fff;
            height: 100%;
            width: 50%;
            display: flex;
            justify-content: center;
            flex-direction: column;
            font-size: 45px;
            font-family: 'pop-regular';
            font-weight: bold;
        }

        .social-links {
            margin-bottom: 20px;
        }

        .social-links a {
            display: inline-block;
            width: 40px;
            height: 40px;
            line-height: 40px;
            text-align: center;
            border-radius: 50%;
            margin-right: 10px;
            color: black;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            transition: all 0.4s ease;

        }

        .social-links a:hover {
            transform: translateY(-3px);
        }

        hr {
            width: 370px;
            border: 3px solid white;
            margin-bottom: 10px;
        }

        /* FOR BUTTON  */
        @import url("https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap");

        * {
            box-sizing: border-box;
        }



        button {
            background-color: purple;
            color: #fff;
            border: 1px purple solid;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 2px;
            padding: 20px 30px;
            overflow: hidden;
            margin: 10px 0;
            position: relative;
            cursor: pointer;
        }

        button:focus {
            outline: none;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color:rgb(88, 82, 82);
        }

        button .circle {
            position: absolute;
            background-color: red;
            width: 140px;
            height: 100px;
            border-radius: 50%;
            transform: translate(-50%, -50%) scale(0);
            animation: ripple 0.5s ease-out;
        }

        @keyframes ripple {
            to {
                transform: translate(-50%, -50%) scale(3);
                opacity: 0;
            }
        }
    </style>
</head>
<script>
    function togglePassword(event) {
    event.stopPropagation();
    var passwordInput = document.getElementById('password');
    var toggleIcon = document.getElementById('toggle-icon');
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    }
}

</script>

<body>
    <div class="container">
        <form action="#" method="post">
            <h1>Login</h1>

            <div class="input-box">
                <input type="text" placeholder="Email" name="email" value="<?php echo $email; ?>" />
                <p style="color: red;"><?php echo $em; ?></p>


            </div>

            <div class="input-box">
                <input type="password" id="password" placeholder="Password" name="password" value="<?php echo $password; ?>" />
                <span onclick="togglePassword(event)">
                    <i class="fa fa-eye-slash                toggle-password" id="toggle-icon"></i>
                </span>
                <p style="color: red;"><?php echo $pass; ?></p>
            </div>


            <div class="remember-forgot">
                <label><input type="checkbox" required /> Remember me</label>
                <a href="forgot/forgot_password.php"> Forgot Password?</a>
            </div>
            <!-- <button type="submit" class="btn" name="login">Log in</button> -->
            <button type="submit" name="login" class="ripple btn">Login <span class="circle"></span></button>

            <div class="register-link">
                <p>Don't have an account?<a href="register.php">Register Here!</a></p>
            </div>
        </form>
    </div>
    <div class="content">
        UNLOCK UNFORGETTABLE MEMORIES
        ON THE ROAD.
        <p>
            <hr>
            </hr>
        </p>
        <div class="social-links">
            <a href=""><i style="margin-top:10px;" class="fa-brands fa-facebook"></i></a>
            <a href=""><i style="margin-top:10px;" class="fa-brands fa-twitter"></i></a>
            <a href=""><i style="margin-top:10px;" class="fa-brands fa-instagram"></i></a>


        </div>
    </div>
</body>

</html>