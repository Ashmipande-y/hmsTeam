<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-info bg-info">
        <h5 class="text-white">Hospital Management System </h5>

        <div class="me-auto"></div>

        <ul class="navbar-nav">
            <?php
               if(isset($_SESSION['admin'])){
                 $user=$_SESSION['admin'];
                 echo '
            <li class="nav-item"><a href="#" class="nav-link text-white">'.$user.'</a></li>
            <li class="nav-item"><a href="logout.php" class="nav-link text-white">logout</a></li>';
               }else if(isset($_SESSION['doctor'])){
                $user=$_SESSION['doctor'];
                 echo '
            <li class="nav-item"><a href="#" class="nav-link text-white">'.$user.'</a></li>
            <li class="nav-item"><a href="logout.php" class="nav-link text-white">logout</a></li>';
               }
               else if(isset($_SESSION['patient'])){
                $user=$_SESSION['patient'];
                 echo '
            <li class="nav-item"><a href="#" class="nav-link text-white">'.$user.'</a></li>
            <li class="nav-item"><a href="logout.php" class="nav-link text-white">logout</a></li>';
               }
               else{
                 echo '<li class="nav-item"><a href="index.php" class="nav-link text-white">Home</a></li>
                 
                 <li class="nav-item"><a href="adminlogin.php" class="nav-link text-white">Admin</a></li>
            <li class="nav-item"><a href="doctorlogin.php" class="nav-link text-white">Doctor</a></li>
            <li class="nav-item"><a href="patientlogin.php" class="nav-link text-white">Patient</a></li>';
               }
               ?>
            
        </ul>
    </nav>
</body>
</html>