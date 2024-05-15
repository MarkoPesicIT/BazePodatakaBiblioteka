<?php
include 'db_config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $korisnicko_ime = $_POST['korisnicko_ime'];
    $lozinka = $_POST['lozinka'];

    $sql = "SELECT * FROM korisnici WHERE korisnicko_ime='$korisnicko_ime'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($lozinka, $row['lozinka'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_type'] = $row['tip'];
            header("Location: index.php");
        } else {
            echo "Neispravna lozinka.";
        }
    } else {
        echo "Korisničko ime ne postoji.";
    }

    $conn->close();
}
?>
