
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update participants score</title>
    <link rel="stylesheet" href="style.scss">

    <style>
        p{
            color:#251a5a;
            text-decoration: underline;
            font-weight: bold;
        }
        a{
            color: #251a5a;
        }
        
    </style>
</head>
<body>
<?php
// Include the database connection file
include 'dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Establish a database connection
        $conn = new PDO("mysql:host=$sName;dbname=$db_name", $uName, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Retrieve form data
        $id = $_POST['id'];
        $power_output = intval($_POST['power_output']);
        $distance_travelled = intval($_POST['distance_travelled']);

        // Prepare the SQL query to update the database
        $stmt = $conn->prepare("UPDATE participant SET power_output = :power_output, distance = :distance WHERE id = :id");

        // Bind the parameters
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':power_output', $power_output, PDO::PARAM_INT);
        $stmt->bindParam(':distance', $distance_travelled, PDO::PARAM_INT);

        // Execute the query
        $stmt->execute();

        // Confirm the update
        echo "<p>Participant data updated successfully.</p>";
        echo '<a href="index.php" class="back_btn">Go back to the participant list</a>';
        echo '<a href="." class="back_btn">Back to index</a>';

        
    } catch (PDOException $e) {
        // Handle errors
        echo "<p>Error: " . $e->getMessage() . "</p>";
    }
} else {
    // If accessed without a POST request
    echo "<p>Invalid request method.</p>";
}
?>

</body>
</html>
