<?php
session_start();
include("../include/connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Doctors</title>
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
                <h5 class="text-center mt-3">Total Doctors</h5>

                <?php
                $query = "SELECT id, firstname, surname, username, gender, phone, country, salary, date_reg FROM doctors WHERE status='Approved' ORDER BY date_reg ASC";
                $stmt = $connect->prepare($query);
                $stmt->execute();
                $res = $stmt->get_result();

                echo "<table class='table table-bordered'>
                        <thead class='table-dark'>
                            <tr>
                                <th>ID</th>
                                <th>Firstname</th>
                                <th>Surname</th>
                                <th>Username</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Country</th>
                                <th>Salary</th>
                                <th>Date Registered</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>";

                if ($res->num_rows < 1) {
                    echo "<tr><td colspan='10' class='text-center'>No doctor found.</td></tr>";
                } else {
                    while ($row = $res->fetch_assoc()) {
                        echo "<tr>
                                <td>" . htmlspecialchars($row['id']) . "</td>
                                <td>" . htmlspecialchars($row['firstname']) . "</td>
                                <td>" . htmlspecialchars($row['surname']) . "</td>
                                <td>" . htmlspecialchars($row['username']) . "</td>
                                <td>" . htmlspecialchars($row['gender']) . "</td>
                                <td>" . htmlspecialchars($row['phone']) . "</td>
                                <td>" . htmlspecialchars($row['country']) . "</td>
                                <td>" . (isset($row['salary']) ? htmlspecialchars($row['salary']) : 'N/A') . "</td>
                                <td>" . htmlspecialchars($row['date_reg']) . "</td>
                                <td>
                                    <a href='edit.php?id=" . urlencode($row['id']) . "' class='btn btn-info'>Edit</a>
                                </td>
                              </tr>";
                    }
                }

                echo "</tbody></table>";
                $stmt->close();
                ?>
            </div>
        </div>
    </div>
</body>
</html>
