
<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update participant scores</title>
    <link rel="stylesheet" href="style.scss">
</head>
<body>
    <?php
    // Include the database connection
    include 'dbconnect.php';

    try {
        $conn = new PDO("mysql:host=$sName;dbname=$db_name", $uName, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Fetch participant data based on the ID passed via GET
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $stmt = $conn->prepare("SELECT * FROM participant WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $participant = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($participant) {
                ?>

                <section class="form-container">
                <h1>Edit Participant</h1>
                <form action="edit_participant.php" method="POST">
                    <!-- Display the first name -->
                    Participant Firstname<br>
                    <input type="text" name="firstname" disabled value="<?php echo $participant['firstname']; ?>" required class="box"> <br>
                    
                    <!-- Display the surname -->
                    Participant Surname <br>
                    <input type="text" name="surname" disabled value="<?php echo $participant['surname']; ?>"> <br>
                    
                    <!-- Editable fields for power_output and distance -->
                    Power output in watts<br>
                    <input type="text" name="power_output" value="<?php echo $participant['power_output']; ?>"> <br>
                    
                    Distance in KM<br>
                    <input type="text" name="distance_travelled" value="<?php echo $participant['distance']; ?>"> <br>
                    
                    <!-- Hidden field to pass the participant ID -->
                    <input type="hidden" name="id" value="<?php echo $participant['id']; ?>">
                    
                    <input type="submit" value="Update this rider">
                </form>

                </section>
                
                <?php
            } else {
                echo "<p>Participant not found.</p>";
            }
        } else {
            echo "<p>No participant ID provided.</p>";
        }
    } catch (PDOException $e) {
        echo "<p>Error: " . $e->getMessage() . "</p>";
    }
    ?>
</body>
</html>
