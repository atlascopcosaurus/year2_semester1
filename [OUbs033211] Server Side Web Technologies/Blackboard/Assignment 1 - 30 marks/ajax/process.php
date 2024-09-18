<?php
include 'connect.php';
// Check if form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Check if all fields are filled
    if(isset($_POST["username"]) && isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["password"])){
        $username = htmlspecialchars($_POST["username"]);
        $name = htmlspecialchars($_POST["name"]);
        $email = htmlspecialchars($_POST["email"]);
        $password = htmlspecialchars($_POST["password"]);
    }    
    
}

// Insert data into the database
$sql = "INSERT INTO student VALUES ('$username','$name', '$email', '$password', NULL)";

if ($conn->query($sql) === TRUE) {
 echo "New record created successfully";
 header("Location: success.php"); 
 exit();
 
} else {
 echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>