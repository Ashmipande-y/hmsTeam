<?php
include("include/connection.php");
if(isset($_POST['apply'])){
    $firstname=$_POST['fname'];
    $surname=$_POST['sname'];
    $username=$_POST['uname'];
    $email=$_POST['email'];
    $gender=$_POST['gender'];
    $phone=$_POST['phone'];
    $country=$_POST['country'];
    $password=$_POST['pass'];
    $confirm_password=$_POST['con_pass'];

    $error=array();

$error = array();

if (empty($firstname)) {
    $error['apply'] = "Enter Firstname";
} else if (empty($surname)) {
    $error['apply'] = "Enter Surname";
} else if (empty($username)) {
    $error['apply'] = "Enter Username";
} else if (empty($email)) {
    $error['apply'] = "Enter Email Address";
} else if (empty($gender)) {
    $error['apply'] = "Select Your Gender";
} else if (empty($phone)) {
    $error['apply'] = "Enter Phone Number";
} else if (empty($country)) {
    $error['apply'] = "Select Country";
} else if (empty($password)) {
    $error['apply'] = "Enter Password";
} else if ($confirm_password != $password) {
    $error['apply'] = "Both Passwords do not match";
}

if(count($error)==0){
    $query = "INSERT INTO doctors(firstname, surname, username, email, gender, phone, country, password, salary, data_reg, status, profile)
    VALUES('$firstname', '$surname', '$username', '$email', '$gender', '$phone', '$country', '$password', '0', NOW(), 'Pending', 'doctor.jpg')";


    $result = mysqli_query($connect,$query);
    if($result){
        echo "<script>alert('You have Successfully Applies')</script>";
        header("Location:doctorlogin.php");
    }else{
        echo "<script>alert('Failed')</script>";
    }
}

    
}
$show="";
if(isset($error['apply'])){
    $s = $error['apply'];
    $show="<h5 class='text-center alert alert-danger'>$s</h5>";
}else{
    $show="";
}




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply Now!!!</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body style="background-image: url(img/back.png); background-size: cover; background-repeat: no-repeat;">
    <?php
        include("include/header.php");
    ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-4 shadow-lg">
                    <h5 class="text-center">Apply Now!!!</h5>
                    <div>
                       <?php echo $show; ?>
                    </div>
                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label">Firstname</label>
                            <input type="text" name="fname" class="form-control" placeholder="Enter Firstname" value="<?php if(isset($_POST['fname'])) echo $_POST['fname']; ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Surname</label>
                            <input type="text" name="sname" class="form-control" placeholder="Enter Surname" value="<?php if(isset($_POST['sname'])) echo $_POST['sname']; ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="uname" class="form-control" placeholder="Enter Username" value="<?php if(isset($_POST['uname'])) echo $_POST['uname']; ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter Email address" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Select Gender</label>
                            <select name="gender" class="form-control" value="<?php if(isset($_POST['gender'])) echo $_POST['gender']; ?>">
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="number" name="phone" class="form-control" placeholder="Enter Phone Number" value="<?php if(isset($_POST['phone'])) echo $_POST['phone']; ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Select Country</label>
                            <select name="country" class="form-control">
                                <option value="">Select Country</option>
                                <option value="Russia">Russia</option>
                                <option value="India">India</option>
                                <option value="Ghana">Ghana</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="pass" class="form-control" placeholder="Enter Password">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" name="con_pass" class="form-control" placeholder="Enter Confirm Password">
                        </div>
                        <button type="submit" name="apply" class="btn btn-success w-100">Apply Now</button>
                        <p class="mt-3 text-center">I already have an account <a href="doctorlogin.php">Click here</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
