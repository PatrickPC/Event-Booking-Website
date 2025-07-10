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
    <title>Register your interest</title>
    <link rel="stylesheet" href="style.scss">
    <style>
        h1{
            padding-top: 25%;
        }

        a{
            color: black;
            text-align: center;
            align-items: center;
            padding: 10px;
            padding-left: 50%;
        }

   
        
        
    </style>
</head>
<body>
    
    
    <?php
    // Including connection variables
    include 'dbconnect.php';

    if (isset($_POST['submit'])) {
        // Retrieve form data
        $firstname = htmlspecialchars($_POST['firstname']);
        $surname = htmlspecialchars($_POST['surname']);
        $email = htmlspecialchars($_POST['email']);
        $terms = isset($_POST['terms']) ? 1 : 0; // Set to 1 if checked

        try {
            $conn = new PDO("mysql:host=$sName;dbname=$db_name", 
            $uName, $pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Prepare SQL and bind parameters
            $stmt = $conn->prepare("INSERT INTO interest (firstname, surname, email, terms) VALUES (:firstname, :surname, :email, :terms)");
            $stmt->bindParam(':firstname', $firstname);
            $stmt->bindParam(':surname', $surname);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':terms', $terms);

            // Execute the prepared statement
            $stmt->execute();

            echo "<h1>Thank you for registering your interest!</h1>";
           
        } catch (PDOException $e) {
            echo "<p>Error: " . $e->getMessage() . "</p>";
        }

        // Close the connection
        $conn = null;
    }
    ?>

</body>
</html>
