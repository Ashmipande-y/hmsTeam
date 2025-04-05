<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Profile</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .profile-card {
      background-color: #f8f9fa;
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      margin-top: 20px;
    }
    .btn-custom {
      border-radius: 20px;
      padding: 8px 20px;
      font-weight: 500;
    }
  </style>
</head>
<body>

<?php
include("../include/header.php");
include("../include/connection.php");
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-2">
      <?php include("sidenav.php"); ?>
    </div>

    <div class="col-md-10">
      <?php
      if (isset($_SESSION['patient'])) {
        $patient = $_SESSION['patient'];
        $query = "SELECT * FROM patient WHERE username='$patient'";
        $res = mysqli_query($connect, $query);

        if ($res && mysqli_num_rows($res) > 0) {
          $row = mysqli_fetch_array($res);

          if (isset($_POST['update_password'])) {
            $old_pass = $_POST['old_pass'];
            $new_pass = $_POST['new_pass'];

            if ($old_pass == $row['password']) {
              $updateQuery = "UPDATE patient SET password='$new_pass' WHERE username='$patient'";
              mysqli_query($connect, $updateQuery);
              echo "<script>alert('Password updated successfully!');</script>";
            } else {
              echo "<script>alert('Incorrect old password.');</script>";
            }
          }

          if (isset($_POST['update_username'])) {
            $new_username = $_POST['new_username'];
            $updateQuery = "UPDATE patient SET username='$new_username' WHERE username='$patient'";
            if (mysqli_query($connect, $updateQuery)) {
              $_SESSION['patient'] = $new_username;
              echo "<script>alert('Username updated successfully!'); window.location.href='profile.php';</script>";
            }
          }

          if (isset($_POST['upload'])) {
            $img = $_FILES['img']['name'];
            if (!empty($img)) {
              $updateQuery = "UPDATE patient SET profile='$img' WHERE username='$patient'";
              if (mysqli_query($connect, $updateQuery)) {
                move_uploaded_file($_FILES['img']['tmp_name'], "img/$img");
                echo "<script>alert('Profile image updated successfully!');</script>";
              }
            }
          }
        } else {
          echo "<p class='alert alert-warning'>No patient data found.</p>";
        }
      } else {
        echo "<p class='alert alert-danger'>Session expired. Please log in again.</p>";
      }
      ?>

      <?php if (!empty($row)) { ?>
      <div class="row">
        <div class="col-md-6">
          <div class="profile-card">
            <h5>Profile Image</h5>
            <form method="post" enctype="multipart/form-data">
              <img src="img/<?php echo $row['profile']; ?>" class="img-fluid mb-3" style="height:250px; border-radius: 10px;">
              <input type="file" name="img" class="form-control mb-2">
              <input type="submit" name="upload" value="Update Profile" class="btn btn-info btn-custom">
            </form>
          </div>
        </div>

        <div class="col-md-6">
          <div class="profile-card">
            <h5>Account Details</h5>
            <ul class="list-group mb-3">
              <li class="list-group-item"><strong>Username:</strong> <?php echo $row['username']; ?></li>
              <li class="list-group-item"><strong>Email:</strong> <?php echo $row['email']; ?></li>
              <li class="list-group-item"><strong>Gender:</strong> <?php echo $row['gender']; ?></li>
              <li class="list-group-item"><strong>Phone:</strong> <?php echo $row['phone']; ?></li>
              <li class="list-group-item"><strong>Country:</strong> <?php echo $row['country']; ?></li>
              <li class="list-group-item"><strong>Registration Date:</strong> <?php echo $row['date_reg']; ?></li>
            </ul>

            <h5>Update Username</h5>
            <form method="post">
              <input type="text" name="new_username" class="form-control mb-2" placeholder="New Username" required>
              <button type="submit" name="update_username" class="btn btn-primary btn-custom">Update Username</button>
            </form>

            <h5 class="mt-4">Change Password</h5>
            <form method="post">
              <input type="password" name="old_pass" class="form-control mb-2" placeholder="Old Password" required>
              <input type="password" name="new_pass" class="form-control mb-2" placeholder="New Password" required>
              <button type="submit" name="update_password" class="btn btn-warning btn-custom">Change Password</button>
            </form>
          </div>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
</div>

</body>
</html>
