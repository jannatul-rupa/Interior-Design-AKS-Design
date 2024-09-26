<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['Name'];
    $address = $_POST['Address'];
    $contact_number = $_POST['Contact Number'];
    $package_name = $_POST['Package Name'];
    $details = $_POST['Details'];

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "aksdesign";

    // Enable error reporting
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepared statement to insert data
    $stmt = $conn->prepare("INSERT INTO orders (Name, Address, `Contact Number`, `Package Name`, Details) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiss", $name, $address, $contact_number, $package_name, $details);

    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>