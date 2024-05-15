<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "prodaja_komponenti";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Konekcija nije uspela: " . $conn->connect_error);
}
?>
