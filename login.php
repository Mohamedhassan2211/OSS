<?php
include 'config.php';
session_start();

if(isset($_POST['submit'])){

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

    $select =mysqli_query($conn, "SELECT * FROM user_form WHERE email = '$email' And password ='$pass'")or die('query fialed');
    
    if(mysqli_num_rows($select) > 0){
        $row = mysqli_fetch_assoc($select);
        $_SESSION['user_id'] = $row['id'] ;
        header('location:home.php');

    }else{
        $message[] = 'incorrect email or password';
    }

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS0/style1.css">
    <link rel="icon" href="Images0/code icon .png" type="image/x-icon">
    <title>Login | .Code</title>
</head>
<body>
    <div class="login-box">
        <form action=""  method="post" enctype="multipart/form-data">
        <div class="login-header">
             <img class="logo-box" src="Images0/logo.png" alt="logo">
            <header>Welcome back!</header>
        </p>  Sign in to access to all our courses </p>
        </div>
        <?php 
        if(isset($message)){
            foreach($message as $message){
                echo '<div class="message">'.$message.'</div>';
            }
        }
        
        ?>
    <br>    

        <div class="input-box">
            <input type="email" name ="email" class="input-field" placeholder="Email" autocomplete="off" required>
        </div>
        <div class="input-box">
            <input type="password" name="password" class="input-field" placeholder="Password" autocomplete="off" required>
        </div>
        <div class="forgot">
            <section>
                <input type="checkbox" id="check">
                <label for="check">Remember me</label>
            </section>
            <section>
                <a href="Forgot password.html">Forgot password</a>
            </section>
        </div>
        <div class="input-submit">
            <input type="submit" name="submit" class="submit-btn" id="submit" >
            <label for="submit">Sign In</label>
        </div>
        <div class="sign-up-link">
            <p>Don't have account? <a href="register.php">Sign Up</a></p>
        </div>
    </div>
    <script>
        function isvalid(){
            var user =document.form.user.value;
            var pass =document.form.pass.value;

            if(user.length=="" && pass.length==""){
                alert("Username and password failed is Empty!!!");
                return false
            }
            else{
                if(user.length==""){
                alert("Username is Empty!!!");
                return false
                }
                if(pass.length==""){
                alert("Password is Empty!!!");
                return false
                }
        }
    }
    </script> 
</body>
</html>