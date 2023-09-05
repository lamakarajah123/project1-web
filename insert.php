<?php
include_once "conn.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input from the form
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];

    try {

       
$sql = "INSERT INTO techar (name, age, gender, phone) VALUES (:name, :age, :gender, :phone)";

        
     
        $stmt = $conn->prepare($sql);

   
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':age', $age, PDO::PARAM_INT);
        $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);

    
        if ($stmt->execute()) {
         
            header("Location: view.php");
        } else {
            echo "Error: " . $stmt->errorInfo()[2];
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


$conn = null;
?>

