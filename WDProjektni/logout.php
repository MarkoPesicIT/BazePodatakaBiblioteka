<?php
session_start(); // Pokretanje sesije

// Provera da li je korisnik prijavljen
if (isset($_SESSION['user_id'])) {
    // Ako je korisnik prijavljen, uništavamo sesiju
    session_unset(); // Uklanja sve podatke iz sesije
    session_destroy(); // Uništava sesiju

    // Redirekcija na početnu stranicu ili na stranicu za prijavu
    header("Location: index.php"); // Promenite "index.php" na putanju do vaše početne stranice
    exit(); // Prekid izvršavanja skripte
} else {
    // Ako korisnik nije prijavljen, možete redirektovati na početnu stranicu ili na stranicu za prijavu
    header("Location: index.php"); // Promenite "index.php" na putanju do vaše početne stranice ili stranice za prijavu
    exit(); // Prekid izvršavanja skripte
}
?>
