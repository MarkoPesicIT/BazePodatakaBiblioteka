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
    $pozivnabroj = 1234;
    $napraviozaposleni = 1;

    echo "Ovo je danasnji datum: $datumUclanjenja";
    $sql = "INSERT INTO clan (ime, prezime, brojTelefona, adresaStanovanja, ePosta, datumUclanjenja, datumRodjenja, poziv_na_broj, napravio_zaposleni) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    
    $stmt->bind_param("sssssssii", $ime, $prezime, $brojTelefona, $adresaStanovanja, $ePosta, $datumUclanjenja, $datumRodjenja, $pozivnabroj, $napraviozaposleni);
    
    if ($stmt->execute()) {
        echo "New record inserted successfully";
    } else {
        echo "Error: " . $sql . $conn->error;
    }
    
    // Close statement and connection
    $stmt->close();
    $conn->close();
    
} else {
    echo "Invalid request.";
}
?>
