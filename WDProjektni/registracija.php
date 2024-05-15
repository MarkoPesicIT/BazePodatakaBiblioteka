<?php
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $korisnicko_ime = $_POST['korisnicko_ime'];
    $lozinka = password_hash($_POST['lozinka'], PASSWORD_DEFAULT);
    $ime = $_POST['ime'];
    $email = $_POST['email'];
    $tip = $_POST['tip']; // 'prodavac' ili 'kupac'

    $sql = "INSERT INTO korisnici (korisnicko_ime, lozinka, ime, email, tip) VALUES ('$korisnicko_ime', '$lozinka', '$ime', '$email', '$tip')";

    if ($conn->query($sql) === TRUE) {
        echo "Korisnik je uspešno registrovan.";
    } else {
        echo "Greška: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
