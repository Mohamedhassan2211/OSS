







<?php
include 'config.php';

if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
    $cpass =mysqli_real_escape_string($conn, md5($_POST['cpassword']));
    $image=$_FILES['image']['name'];
    $image_size=$_FILES['image']['size'];
    $image_tmp_name=$_FILES['image']['tmp_name'];
    $image_folder='uploaded_img/'.$image;

    $select =mysqli_query($conn, "SELECT * FROM user_form WHERE email = '$email' And password ='$pass'")or die('query fialed');
    
    if(mysqli_num_rows($select) > 0){
        $message[] = 'user aleardy exist';
    }else{
        if($pass !=$cpass){
            $message[] ='confirm password not matched!';
        }elseif($image_size >2000000){
            $message[] = 'image size is too large!';
        }else{
            $insert = mysqli_query($conn,"INSERT INTO user_form(name, email, password,image) VALUES('$name','$email','$pass','$image')")or die ('query failed');
            
            if($insert){
                move_uploaded_file($image_tmp_name,$image_folder);
                $message[] = 'register successfully!';
                header('location:login.php');
            }else{
                $message[] = 'register failed!';
            }
        }
    }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS1/style2.css">
    <link rel="icon" href="Images1/code icon .png" type="image/x-icon">
    <title>Register | .Code</title>
</head>
<body>
    <div class="login-box">
        <form action="" method="post" enctype="multipart/form-data">
        <div class="login-header">
             <img class="logo-box" src="Images1/logo.png" alt="logo">
            <header>Sign Up Now!</header>
        </p>  Sign up to access to all our courses </p>
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
            <input type="text" name="name" class="input-field" placeholder="Full Name" autocomplete="off" required>
        </div>
        <div class="input-box">
            <input type="email" name="email" class="input-field" placeholder="Email" autocomplete="off" required>
        </div>
        <div class="input-box">
            <input type="password" name="password" class="input-field" placeholder="Password" autocomplete="off" required minlength="4">
        </div>
        <div class="input-box">
            <input type="password" name ="cpassword" class="input-field" placeholder="Confirm Password" autocomplete="off" required>
        </div>
        <div class="input-box">
            <input type="file" name="image"  accept="image/jpg, image/jpeg, image/png">
        </div>
        
        <br>
        <div class="input-submit">
            <input type="submit" name="submit" class="submit-btn" id="submit">
            <label for="submit">register now</label>
        </div>
        <div class="sign-up-link">
            <p>Already have account? <a href="login.php">login now</a></p>
        </div>
        </form>
    </div>
</body>
</html>