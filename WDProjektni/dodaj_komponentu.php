<?php
include 'db_config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION['user_type'] == 'prodavac') {
    $naziv = $_POST['naziv'];
    $opis = $_POST['opis'];
    $cena = $_POST['cena'];
    $kolicina = $_POST['kolicina'];
    $prodavac_id = $_SESSION['user_id'];

    $sql = "INSERT INTO komponente (naziv, opis, cena, kolicina, prodavac_id) VALUES ('$naziv', '$opis', '$cena', '$kolicina', '$prodavac_id')";

    if ($conn->query($sql) === TRUE) {
        echo "Nova komponenta je uspešno dodata.";
    } else {
        echo "Greška: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
