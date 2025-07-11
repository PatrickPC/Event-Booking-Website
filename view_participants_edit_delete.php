<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.scss">
    <title>View Participants</title>
    <style>

        body{
            font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            overflow: hidden;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            color: black;
        }
        h1 {
            text-align: center;
            margin-top: 20px;
        }
        a {
            text-decoration: none;
            color: blue;
            margin: 10px 0;
            display: inline-block;
        }

        
    </style>
</head>
<body>
    <div class="heading">
    <h1>View All Participants</h1>
    <a href="admin_menu.php" class="back_btn">Back to menu</a>

    </div>
    
    <?php
    include 'dbconnect.php'; // Include database connection

    try {
        // Create a new database connection
        $conn = new PDO("mysql:host=$sName;dbname=$db_name", $uName, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // SQL query to fetch data from participants table
        $query = "SELECT * FROM participant";
        $stmt = $conn->prepare($query);
        $stmt->execute();

        // Check if there are records
        if ($stmt->rowCount() > 0) {
            echo "<table>";
            echo "<tr>
                    <th>ID</th>
                    <th>Firstname</th>
                    <th>Surname</th>
                    <th>Email</th>
                    <th>Power Output</th>
                    <th>Distance</th>
                    <th>Club ID</th>
                    <th>Actions</th>
                  </tr>";

            // Fetch and display each row
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['firstname']}</td>
                        <td>{$row['surname']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['power_output']}</td>
                        <td>{$row['distance']}</td>
                        <td>{$row['club_id']}</td>
                        <td>
                            <a href='edit_participant_form.php?id={$row['id']}' class='btn' >Edit</a> | 
                            <a href='delete.php?id={$row['id']}' class='delete-btn'>Delete</a>
                        </td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No participants found in the database.</p>";
        }
    } catch (PDOException $e) {
        echo "<p>Error: " . $e->getMessage() . "</p>";
    }

    ?>
</body>
</html>
