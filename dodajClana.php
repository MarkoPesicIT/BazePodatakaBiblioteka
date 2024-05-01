<?php
include 'dbconfig.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "NE RADI\n";
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $brojTelefona = $_POST['brojTelefona'];
    $adresaStanovanja = $_POST['adresaStanovanja'];
    $ePosta = $_POST['email'];
    $datumUclanjenja = date("Y-m-d"); // Changed date format to YYYY-MM-DD
    $datumRodjenja = $_POST['datumRodjenja'];
    $pozivnabroj = $_POST['randomNumber'];

    $sql = "INSERT INTO clan (ime, prezime, brojTelefona, adresaStanovanja, ePosta, datumUclanjenja, datumRodjenja, poziv_na_broj) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    
    $stmt->bind_param("ssssssss", $ime, $prezime, $brojTelefona, $adresaStanovanja, $ePosta, $datumUclanjenja, $datumRodjenja, $pozivnabroj);
    
    if ($stmt->execute()) {
        echo "New record inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    // Close statement and connection
    $stmt->close();
    $conn->close();
    
} else {
    echo "Invalid request.";
}
?>
