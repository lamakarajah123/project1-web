<!DOCTYPE html>
<html>
<head>
    <title>View Data</title>
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
    </style>
</head>
<body>
    <h2>View Data</h2>
    
    <?php
  
       include_once "conn.php";
        $sql = "SELECT * FROM techar";
        $stmt = $conn->query($sql);

        if ($stmt->rowCount() > 0) {
         
            echo '<table border="1">';
            echo '<tr><th>ID</th><th>Name</th><th>Age</th><th>Gender</th><th>Phone</th></tr>';

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['age'] . '</td>';
                echo '<td>' . $row['gender'] . '</td>';
                echo '<td>' . $row['phone'] . '</td>';
                echo '</tr>';
            }

            echo '</table>';
        } else {
            echo "No records found.";
        }

   
    $conn = null;
    ?>
</body>
</html>
