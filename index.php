<?php
session_start();
include("../include/connection.php");

// Handle report submission
if (isset($_POST['send'])) {
    $title = mysqli_real_escape_string($connect, $_POST['title']);
    $message = mysqli_real_escape_string($connect, $_POST['message']);

    if (empty($title) || empty($message)) {
        echo "<script>alert('Please fill in all fields.');</script>";
    } else {
        $user = $_SESSION['patient'];
        $query = "INSERT INTO report(title, message, username, data_send) 
                  VALUES('$title', '$message', '$user', NOW())";
        $res = mysqli_query($connect, $query);

        if ($res) {
            echo "<script>alert('You have sent your report successfully.');</script>";
        } else {
            echo "<script>alert('Error in sending report.');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Patient Dashboard</title>

  <!-- Bootstrap CDN -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <!-- Font Awesome CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    body {
      background-color: #f8f9fa;
    }
    .card-box {
      height: 150px;
      border-radius: 15px;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
      padding: 15px;
      color: white;
      transition: transform 0.2s ease;
    }
    .card-box:hover {
      transform: scale(1.05);
    }
    .send-report-form {
      border-radius: 10px;
      padding: 20px;
    }
    .stretched-link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

<?php 
 include("../include/header.php"); 
?>

<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
    <div class="col-md-2 px-0">
      <?php include("sidenav.php"); ?>
    </div>

    <!-- Main Content -->
    <div class="col-md-10">
      <h4 class="my-4 font-weight-bold">Patient Dashboard</h4>

      <!-- Dashboard Cards -->
      <div class="row mb-4">
        <!-- My Profile -->
        <div class="col-md-3 mx-2 card-box bg-info">
          <div class="d-flex justify-content-between align-items-center h-100">
            <div>
              <h5>My Profile</h5>
              <a href="profile.php" class="text-white stretched-link">View</a>
            </div>
            <i class="fas fa-user-circle fa-3x"></i>
          </div>
        </div>

        <!-- Book Appointment -->
        <div class="col-md-3 mx-2 card-box bg-warning">
          <div class="d-flex justify-content-between align-items-center h-100">
            <div>
              <h5>Book Appointment</h5>
              <a href="book.php" class="text-white stretched-link">Book</a>
            </div>
            <i class="fas fa-calendar-check fa-3x"></i>
          </div>
        </div>

        <!-- My Invoice -->
        <div class="col-md-3 mx-2 card-box bg-success">
          <div class="d-flex justify-content-between align-items-center h-100">
            <div>
              <h5>My Invoice</h5>
              <a href="invoice.php" class="text-white stretched-link">Check</a>
            </div>
            <i class="fas fa-file-invoice-dollar fa-3x"></i>
          </div>
        </div>
      </div>

      <!-- Send a Report Form -->
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="bg-info text-white send-report-form">
            <h5 class="text-center mb-4">Send A Report</h5>
            <form method="post">
              <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" class="form-control" placeholder="Enter title of the report" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" name="message" rows="4" class="form-control" placeholder="Enter message" autocomplete="off" required></textarea>
              </div>
              <button type="submit" name="send" class="btn btn-light btn-block">Send Report</button>
            </form>
          </div>
        </div>
      </div>

    </div> <!-- End of col-md-10 -->
  </div> <!-- End of row -->
</div> <!-- End of container-fluid -->

</body>
</html>
