<?php
include 'dbconfig.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $brojTelefona = $_POST['brojTelefona'];
    $adresaStanovanja = $_POST['adresaStanovanja'];
    $ePosta = $_POST['email'];
    $datumUclanjenja = date("d-m-y");
    $datumRodjenja = $_POST['datumRodjenja'];
    $pozivnabroj = $_POST['randomNumber'];


    $sql = "INSERT INTO clan (ime, prezime, brojTelefona, adresaStanovanja, ePosta, datumUclanjenja, datumRodjenja, poziv_na_broj) 
            VALUES ('$ime', '$prezime', '$brojTelefona', '$adresaStanovanja', '$ePosta', '$datumUclanjenja', '$datumRodjenja', '$pozivnabroj')";
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
              } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
              }
              
              $conn->close();
}
?>
