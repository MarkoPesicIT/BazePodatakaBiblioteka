<?php
include 'dbconfig.php'; // Include database configuration file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $brojTelefona = $_POST['brojTelefona'];
    $adresaStanovanja = $_POST['adresaStanovanja'];
    $ePosta = $_POST['ePosta'];
    $datumUclanjenja = date("Y-m-d"); // Current date as the date of registration
    $datumRodjenja = $_POST['datumRodjenja'];
    // You might want to validate and sanitize the input data before inserting into the database

    // Insert data into database
    $sql = "INSERT INTO clan (ime, prezime, brojTelefona, adresaStanovanja, ePosta, datumUclanjenja, datumRodjenja) 
            VALUES ('$ime', '$prezime', '$brojTelefona', '$adresaStanovanja', '$ePosta', '$datumUclanjenja', '$datumRodjenja')";

    if ($conn->query($sql) === TRUE) {
        echo "New record inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
