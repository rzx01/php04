<?php
include '../backend/db.php';

session_start();
// if (!isset($_SESSION['email'])) {
//     header("Location: login.html");
//     exit();
// }
$user_email = $_SESSION['email'];
$sql = "SELECT * FROM user WHERE email = '$user_email'";
$result = $connect->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "No user found.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $contact_no = $_POST['contact_no'];
    $password = $_POST['password'];
    
    $update_sql = "UPDATE user SET 
        first_name = '$first_name', 
        last_name = '$last_name', 
        contact_no = '$contact_no', 
        password1 = '$password' 
        WHERE email = '$user_email'";
    
    if ($connect->query($update_sql) === TRUE) {
        echo "<script>alert('Details updated successfully'); window.location.href='user.php';</script>";
    } else {
        echo "Error updating record: " . $connect->error;
    }
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
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

        form {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            max-width: 500px;
            margin: auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        input[type="text"], input[type="email"], input[type="password"], input[type="number"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #00aaff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0088cc;
        }
    </style>
</head>
<body>

    <h1>User Dashboard</h1>

    <form method="POST" action="">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" required>
        
        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" required>
        
        <label for="contact_number">Contact Number:</label>
        <input type="text" id="contact_number" name="contact_number" value="<?php echo htmlspecialchars($user['contact_no']); ?>" required>
        
        <label for="password">Password:</label>
        <input type="text" id="password" name="password" value="<?php echo htmlspecialchars($user['password1']); ?>" required>
        
        <button type="submit">Update Details</button>
    </form>

</body>
</html>
