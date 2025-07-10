<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start a new session only if none exists
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.scss">
</head>
<body>
<?php

include 'dbconnect.php'; // Include database connection

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $inputUsername = $_POST['username']; // Retrieve username from form
        $inputPassword = $_POST['password']; // Retrieve password from form

        try {
            // Database connection
            $conn = new PDO("mysql:host=$sName;dbname=$db_name", 
            $uName, $pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Query to validate username and password
            $stmt = $conn->prepare("SELECT * FROM user WHERE username = :username AND password = :password");
            $stmt->bindParam(':username', $inputUsername);
            $stmt->bindParam(':password', $inputPassword);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $_SESSION['admin'] = $inputUsername; // Store session data
                echo "Login successful! Redirecting to admin page...";
                header("Location: admin_menu.php"); // Redirect to admin page
                exit();
            } else {
                echo "Invalid username or password.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Invalid request.";
    }
    ?>


</body>
</html>