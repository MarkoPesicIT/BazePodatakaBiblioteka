<?php
include 'db_config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION['user_type'] == 'kupac') {
    $komponenta_id = $_POST['komponenta_id'];
    $kolicina = $_POST['kolicina'];
    $korisnik_id = $_SESSION['user_id'];

    // Provera da li korisnik već ima korpu
    $sql = "SELECT id FROM korpa WHERE korisnik_id='$korisnik_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $korpa_id = $row['id'];
    } else {
        $sql = "INSERT INTO korpa (korisnik_id) VALUES ('$korisnik_id')";
        if ($conn->query($sql) === TRUE) {
            $korpa_id = $conn->insert_id;
        } else {
            echo "Greška: " . $sql . "<br>" . $conn->error;
            exit();
        }
    }

    // Dodavanje komponente u korpu
    $sql = "INSERT INTO korpa_komponente (korpa_id, komponenta_id, kolicina) VALUES ('$korpa_id', '$komponenta_id', '$kolicina')";

    if ($conn->query($sql) === TRUE) {
        echo "Komponenta je uspešno dodata u korpu.";
    } else {
        echo "Greška: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
