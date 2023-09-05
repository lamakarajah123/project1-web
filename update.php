<!DOCTYPE html>
<html>
<head>
    <title>Update Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        h2 {
            background-color: #007BFF;
            color: #fff;
            padding: 10px;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #007BFF;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        .no-records {
            font-weight: bold;
            color: red;
        }

        form {
            margin-top: 10px;
        }

        input[type="text"],
        input[type="number"] {
            padding: 5px;
            margin-right: 10px;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h2>Update Data</h2>
    
    <?php
    // Database connection code (you can include it from a separate file)
    include_once "conn.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
        // Get the data from the form
        $id_to_update = $_POST["id_to_update"];
        $new_name = $_POST["new_name"];
        $new_age = $_POST["new_age"];
        $new_gender = $_POST["new_gender"];
        $new_phone = $_POST["new_phone"];

        // SQL query to update the record with the specified ID
        $update_sql = "UPDATE techar SET name = :name, age = :age, gender = :gender, phone = :phone WHERE id = :id";

        try {
            // Prepare the SQL statement
            $stmt = $conn->prepare($update_sql);

            // Bind parameters
            $stmt->bindParam(':name', $new_name, PDO::PARAM_STR);
            $stmt->bindParam(':age', $new_age, PDO::PARAM_INT);
            $stmt->bindParam(':gender', $new_gender, PDO::PARAM_STR);
            $stmt->bindParam(':phone', $new_phone, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id_to_update, PDO::PARAM_INT);

            // Execute the statement
            if ($stmt->execute()) {
                echo "Record with ID $id_to_update has been updated successfully.";
            } else {
                echo "Error updating record.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

   
    $sql = "SELECT * FROM techar";
    $stmt = $conn->query($sql);

    if ($stmt->rowCount() > 0) {
    
        echo '<table border="1">';
        echo '<tr><th>ID</th><th>Name</th><th>Age</th><th>Gender</th><th>Phone</th><th>Action</th></tr>';

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td>' . $row['age'] . '</td>';
            echo '<td>' . $row['gender'] . '</td>';
            echo '<td>' . $row['phone'] . '</td>';
            echo '<td>';
            echo '<form method="post" action="update.php">';
            echo '<input type="hidden" name="id_to_update" value="' . $row['id'] . '">';
            echo '<input type="text" name="new_name" placeholder="New Name">';
            echo '<input type="number" name="new_age" placeholder="New Age">';
            echo '<input type="text" name="new_gender" placeholder="New Gender">';
            echo '<input type="text" name="new_phone" placeholder="New Phone">';
            echo '<input type="submit" name="update" value="Update">';
            echo '</form>';
            echo '</td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo "No records found.";
    }
    ?>

</body>
</html>
