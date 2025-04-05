<?php

session_start();
$show = ""; 
include("include/connection.php");
if(isset($_POST['login'])){
    $uname = $_POST['uname'];
    $password = $_POST['pass'];

    $error=array();

    if(empty($uname)){
        $error['login']="Enter Username";
    }else if(empty($password)){
        $error['login']="Enter Password";
    } else {
        $q = "SELECT * FROM doctors WHERE username='$uname' AND password='$password'";
        $qq = mysqli_query($connect,$q);
        
        if(mysqli_num_rows($qq) > 0) {
            $row = mysqli_fetch_array($qq);

            if($row['status'] == "Pending"){
                $error['login']="Please wait for the admin to confirm";
            } else if($row['status'] == "Rejected"){
                $error['login']="Try again later";
            } else {
                $_SESSION['doctor'] = $uname;
                echo "<script>alert('Login successful');</script>";
                // Redirect to the doctor's dashboard
                header("Location: doctor/index.php");
                exit();
            }
        } else {
            $error['login'] = "Invalid username or password";
        }
    }
    

    if(isset($error['login'])){
        $l = $error['login'];
        $show = "<h5 class='text-center alert alert-danger'>$l</h5>";
    }else{
        $show="";
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Login Page</title>
    
</head>
<body style="background-image: url(img/back.png); background-size: cover; background-repeat: no-repeat;">
    <?php
       include("include/header.php");
    ?>
    <div class="container d-flex justify-content-center " style="margin-top: 20px;">
        <div class="col-md-6 card p-4 shadow-lg">
            <h5 class="text-center my-2">Doctor Login</h5>
            <div>
                <?php echo $show; ?>
            </div>
            <form method="post">
                <div class="form-group mb-3">
                    <label>Username</label>
                    <input type="text" name="uname" class="form-control" autocomplete="off" placeholder="Enter Username">
                </div>
                <div class="form-group mb-3">
                    <label>Password</label>
                    <input type="password" name="pass" class="form-control" autocomplete="off" placeholder="Enter Password">
                </div>
                <input type="submit" name="login" class="btn btn-success btn-block" value="Login">
                <p class="text-center mt-2">I don’t have an account <a href="apply.php">Apply Now!!!</a></p>
            </form>
        </div>
    </div>
</body>
</html>
