<?php
// Konekcija sa bazom podataka
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rentiranjeautomobila";

// Kreiranje konekcije
$conn = new mysqli($servername, $username, $password, $dbname);

// Provera konekcije
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Parsiranje podataka iz POST zahteva
$data = json_decode(file_get_contents("php://input"));

// Priprema SQL upita za unos rezervacije u bazu podataka
$sql = "INSERT INTO rentiranje (id_automobila, id_korisnika, datum_pozajmljivanja, datum_povratka) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iiss", $data->carId, $data->userId, $data->startDate, $data->endDate);

// Izvršavanje upita
if ($stmt->execute()) {
    echo "Uspešno rezervisano.";
} else {
    echo "Greška prilikom rezervacije: " . $conn->error;
}

// Zatvaranje konekcije
$stmt->close();
$conn->close();
?>
