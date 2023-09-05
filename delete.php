<!DOCTYPE html>
<html>
<head>
    <title>Delete Data by ID</title>
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

        form {
            margin: 20px auto;
            width: 50%;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
        }

        input[type="number"] {
            padding: 5px;
            width: 100%;
            margin-bottom: 15px;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

        .message {
            margin-top: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h2>Delete Data by ID</h2>
    
    <?php
    
    include_once "conn.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
     
        $id_to_delete = $_POST["id_to_delete"];

     
        $check_sql = "SELECT id FROM techar WHERE id = :id";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bindParam(':id', $id_to_delete, PDO::PARAM_INT);
        $check_stmt->execute();

        if ($check_stmt->rowCount() > 0) {
           
            $delete_sql = "DELETE FROM techar WHERE id = :id";

            try {
            
                $stmt = $conn->prepare($delete_sql);

               
                $stmt->bindParam(':id', $id_to_delete, PDO::PARAM_INT);

           
                if ($stmt->execute()) {
                    echo "Record with ID $id_to_delete has been deleted successfully.";
                } else {
                    echo "Error deleting record.";
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            echo "No record found with ID $id_to_delete.";
        }
    }
    ?>

    <form method="post" action="delete.php">
        <label for="id_to_delete">Enter ID to Delete:</label>
        <input type="number" name="id_to_delete" required>
        <input type="submit" name="delete" value="Delete">
    </form>
</body>
</html>
