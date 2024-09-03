<?php
include './db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$first_name = $_POST['first_name'];
	$email = $_POST['email'];
	$last_name = $_POST['last_name'];
	$roll_no = $_POST['roll_no'];
	$password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];
	$contact_number = $_POST['contact_number'];

	if ($password !== $confirm_password) {
		echo "<p>Passwords do not match. Please try again.</p>";
		exit();
	}

	$sql = "INSERT INTO user (first_name, last_name, roll_no, password1, contact_no, email) VALUES ('$first_name', '$last_name', '$roll_no', '$password', '$contact_number', '$email')";
	if (mysqli_query($connect, $sql)) {
		echo "<p>Registered Successfully</p>";
		header("Location: ../frontend/login.html");
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($connect);
	}
}
mysqli_close($connect);
?>
