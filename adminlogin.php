<?php
session_start();
include("include/connection.php");

if(isset($_POST['login'])){
    $username=$_POST['uname'];
    $password=$_POST['pass'];

    $error=array();
    if(empty($username)){
        $error['admin']="Enter Username";
    }else if(empty($password)){
        $error['admin']="Enter Password";
    }

    if(count($error)==0){
        $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
        $result=mysqli_query($connect,$query);
        
        if(mysqli_num_rows($result)==1){
            echo "<script>alert('You have Login As an Admin')</script>";
            $_SESSION['admin']=$username;
            header("Location:admin/index.php");
            exit();
        }else{
            echo "<script>alert('Invalid username or Password')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Page</title>
</head>
<body style="background-image:url('img/back.png');background-size: cover;background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
 ">
    <?php include("include/header.php") ?>
    <div style="margin-top:20px;"></div>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow p-4">
                    <h3 class="text-center"><img src="img/admin.png" class="col-md-12"></h3>
                    <form method="post" >
                        <div >
                            <?php
                                if(isset($error['admin'])){
                                    $sh=$error['admin'];
                                    $show = "<h4 class='alert alert-danger'>$sh</h4>";
                                }else{
                                    $show="";
                                }
                                echo $show;
                            ?>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="uname" class="form-control" autocomplete="off" placeholder="Enter Username" >
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="pass" class="form-control" >
                        </div>
                        <input type="submit" name="login" class="btn btn-success w-100" value="Login"> 
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>