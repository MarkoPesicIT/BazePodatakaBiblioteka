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

// Priprema SQL upita za brisanje rezervacije iz baze podataka
$sql = "DELETE FROM rentiranje WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $data->bookingId);

// Izvršavanje upita
if ($stmt->execute()) {
    echo "Rezervacija je uspešno otkazana.";
} else {
    echo "Greška prilikom otkazivanja rezervacije: " . $conn->error;
}

// Zatvaranje konekcije
$stmt->close();
$conn->close();
?>
