<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    // Retrieve form data
    $firstN = $_POST['firstN'];
    $lastN = $_POST['lastN'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Database connection
    $host = "localhost";
    $dbuser = "root";
    $dbpassword = "";
    $dbname = "auth";

    $conn = new mysqli($host, $dbuser, $dbpassword, $dbname);
    if($conn->connect_error){
        die("Connection failed: ".$conn->connect_error);
    }

    // Validate login
    $query = "SELECT * FROM login WHERE firstN=? AND lastN=? AND email=? AND password=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $firstN, $lastN, $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 1){
        // Login success
        header("LOCATION: ./home/home.php");
        exit();
    } else {
        // Login failed
        header("LOCATION: error/error.html");
        exit();
    }

    $conn->close();
}
?>