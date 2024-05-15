<?php
// Prihvatanje podataka forme
$username = $_POST['username'];
$email = $_POST['email'];
$imePrezime = $_POST['imePrezime'];

// Provera da li su svi podaci uneti
if (empty($username) || empty($email) || empty($imePrezime)) {
    echo "Molimo unesite sve podatke.";
    exit;
}

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

// SQL upit za dodavanje korisnika
$sql = "INSERT INTO korisnici (username, email, ime_prezime) VALUES ('$username', '$email', '$imePrezime')";

// Izvršavanje SQL upita
if ($conn->query($sql) === TRUE) {
    echo "Korisnik je uspešno dodat";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Zatvaranje konekcije
$conn->close();
?>
