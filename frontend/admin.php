<?php
include '../backend/db.php';

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_sql = "DELETE FROM user WHERE roll_no = '$delete_id'"; 
    if ($connect->query($delete_sql) === TRUE) {
        echo "<script>alert('User deleted successfully'); window.location.href='admin_dashboard.php';</script>";
        header("Location: admin.php");
        
    } else {
        echo "Error deleting record: " . $connect->error;
    }
}

$sql = "SELECT * FROM user";
$result = $connect->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #00aaff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .delete-btn {
            padding: 5px 10px;
            background-color: red;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .delete-btn:hover {
            background-color: darkred;
        }
    </style>
</head>
<body>

    <h1>Admin Dashboard</h1>
    <table>
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Roll No/ID</th>
                <th>Contact Number</th>
                <th>User Type</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['first_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['last_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['roll_no']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['contact_no']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['usertype']) . "</td>";
                    echo "<td><a href='admin.php?delete_id=" . htmlspecialchars($row['roll_no']) . "'><button class='delete-btn'>Delete</button></a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No users found</td></tr>";
            }

            mysqli_close($connect);
            ?>
        </tbody>
    </table>

</body>
</html>
