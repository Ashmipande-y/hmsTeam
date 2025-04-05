<?php
session_start();
include("../include/connection.php");

if (!isset($_GET['id'])) {
    echo "<script>alert('Invalid access!'); window.location.href='doctor.php';</script>";
    exit();
}

$id = intval($_GET['id']); // Sanitize ID
$stmt = $connect->prepare("SELECT * FROM doctors WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows < 1) {
    echo "<script>alert('Doctor not found!'); window.location.href='doctor.php';</script>";
    exit();
}

$row = $res->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Doctor</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <?php include("../include/header.php"); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" style="margin-left:-30px;">
                <?php include("sidenav.php"); ?>
            </div>
            <div class="col-md-10">
                <h5 class="text-center mt-3">Edit Doctor</h5>

                <div class="row">
                    <div class="col-md-8">
                        <h5 class="text-center">Doctor Details</h5>
                        <p><strong>ID:</strong> <?= htmlspecialchars($row['id']); ?></p>
                        <p><strong>Firstname:</strong> <?= htmlspecialchars($row['firstname']); ?></p>
                        <p><strong>Surname:</strong> <?= htmlspecialchars($row['surname']); ?></p>
                        <p><strong>Username:</strong> <?= htmlspecialchars($row['username']); ?></p>
                        <p><strong>Email:</strong> <?= htmlspecialchars($row['email']); ?></p>
                        <p><strong>Phone:</strong> +<?= htmlspecialchars($row['phone']); ?></p>
                        <p><strong>Gender:</strong> <?= htmlspecialchars($row['gender']); ?></p>
                        <p><strong>Country:</strong> <?= htmlspecialchars($row['country']); ?></p>
                        <p><strong>Date Registered:</strong> <?= htmlspecialchars($row['date_reg']); ?></p>
                        <p><strong>Salary:</strong> <?= isset($row['salary']) ? htmlspecialchars($row['salary']) : 'N/A'; ?></p>
                    </div>

                    <div class="col-md-4">
                        <h5 class="text-center">Update Salary</h5>
                        <?php
                           if(isset($_POST['update'])){
                              $salary=$_POST['salary'];

                              $q="UPDATE doctors SET salary='$salary' WHERE id='$id'";
                              mysqli_query($connect,$q);
                           }
                        ?>
                        <form method="POST">
                            <label>Enter Doctor's Salary</label>
                            <input type="number" class="form-control" name="salary" placeholder="Enter salary" autocomplete="off"
                            value="<?= htmlspecialchars($row['salary']); ?>" required min="0">
                            <input type="submit" name="update_salary" class="btn btn-primary my-3" value="Update Salary">
                        </form>

                        <?php
                        if (isset($_POST['update_salary'])) {
                            $salary = trim($_POST['salary']);

                            if (!is_numeric($salary) || $salary < 0) {
                                echo "<script>alert('Invalid salary amount!');</script>";
                            } else {
                                $stmt = $connect->prepare("UPDATE doctors SET salary = ? WHERE id = ?");
                                $stmt->bind_param("di", $salary, $id);

                                if ($stmt->execute()) {
                                    echo "<script>alert('Salary updated successfully!'); window.location.href='doctor.php';</script>";
                                } else {
                                    echo "<script>alert('Error updating salary.');</script>";
                                }
                                $stmt->close();
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
