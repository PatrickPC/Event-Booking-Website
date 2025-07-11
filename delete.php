<?php
// Include the database connection
include 'dbconnect.php';

if (isset($_GET['id'])) {
    // Get the ID from the URL
    $id = intval($_GET['id']); // Ensure it is an integer

    try {
        // Create a new database connection
        $conn = new PDO("mysql:host=$sName;dbname=$db_name", $uName, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare the DELETE query
        $query = "DELETE FROM participant WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Execute the query
        if ($stmt->execute()) {
            echo "<p>Participant with ID {$id} has been successfully deleted.</p>";
        } else {
            echo "<p>Failed to delete participant with ID {$id}.</p>";
        }

        echo '<a href="view_participants_edit_delete.php">Back to participants list</a>';

    } catch (PDOException $e) {
        echo "<p>Error: " . $e->getMessage() . "</p>";
    }
} else {
    echo "<p>No ID provided. Please specify a participant to delete.</p>";
    echo '<a href="view_participants_edit_delete.php">Back to participants list</a>';
}
?>
