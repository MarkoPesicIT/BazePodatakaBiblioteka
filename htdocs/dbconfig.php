<?php

$host = 'localhost';
$username = 'root'; 
$password = '';
$database = 'biblioteka';

// Attempt to connect to the database
$conn = new mysqli($host, $username, $password, $database);

// Check if the connection was successful
if ($conn->connect_error) {
    // If connection failed, log the error
    echo "Failed to connect to database: " . $conn->connect_error;
    die("Connection failed: " . $conn->connect_error);
} else {
    // If connection succeeded, log the success
    echo "Connected to database successfully!";
}
?>
