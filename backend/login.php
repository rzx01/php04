<?php
include './db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password1"];

    $stmt = $connect->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if ($password== $row['password1']) {
            $_SESSION['email'] = $email;
            if ($row['usertype'] == 1) {
                header("Location: ../frontend/admin.php");
                exit();
            } else {
                header("Location: ../frontend/user.php");
                exit();
            }
        } else {
            echo "INVALID CREDENTIALS";
            echo $password;
            echo $row['password1'];
            exit();
        }
    } else {
        echo "INVALID CREDENTIALS";
        exit();
    }

    $stmt->close();
}

$connect->close();
?>
