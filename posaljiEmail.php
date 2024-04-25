<?php

include 'dbconfig.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $email = $_POST['email'];
    $clanarina = $_POST['clanarina'];
    $randomNumber = $_POST['randomNumber'];

    // Determine membership fee based on selected option
    switch ($clanarina) {
        case "MESECNO GOTOVINOM":
            $cena = "500";
            break;
        case "MESECNO ELEKTRONSKI":
            $cena = "450";
            break;
        case "GODISNJE GOTOVINOM":
            $cena = "5000";
            break;
        case "GODISNJE ELEKTRONSKI":
            $cena = "4500";
            break;
        default:
            $cena = "N/A";
            break;
    }

    $subject = "Dobrodošlica u našu biblioteku";
    $message = "Poštovani/a $ime $prezime,\n\n";
    $message .= "Želim Vam iskreno zahvaliti što ste postali član naše biblioteke. Vaša podrška je od izuzetne važnosti za održavanje i unapređenje naših usluga, i radujemo se što ćemo biti deo Vašeg knjižnog putovanja.\n\n";
    $message .= "Vaša odluka da postanete član biblioteke omogućava Vam pristup našoj bogatoj kolekciji knjiga, časopisa, i drugih resursa. Nadamo se da ćete uživati u istraživanju sveta literature i znanja koje smo za Vas pripremili.\n\n";
    $message .= "Takođe, želimo da Vas obavestimo o našim mogućnostima za elektronsko plaćanje članarine. Možete odabrati da plaćate godišnju ili mesečnu članarinu putem elektronskog bankarstva. Evo detalja koji Vam mogu biti od koristi:\n\n";
    $message .= "Članarina: $clanarina - $cena RSD\n";
    $message .= "Molimo Vas da uplatu izvršite na sledeći bankovni račun: [Broj računa biblioteke]\n";
    $message .= "Prilikom uplate, koristite ovaj poziv na broj: $randomNumber\n\n";
    $message .= "Još jednom, hvala Vam što ste se pridružili našoj biblioteci. Radujemo se što ćemo zajedno graditi prostor za učenje, istraživanje i inspiraciju.\n\n";
    $message .= "Srdačan pozdrav,\n\n";
    $message .= "[Naziv biblioteke]\n";
    $message .= "[Kontakt informacije (broj email adresa)]";

    $headers = "From: sender@example.com\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    if (mail($email, $subject, $message, $headers)) {
        echo "Email sent successfully!";
    } else {
        echo "Email sending failed.";
    }
} else {
    echo "Invalid request.";
}
?>
