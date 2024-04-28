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

    switch ($clanarina) {
        case "MESECNO GOTOVINOM":
            $cena = "120";
            break;
        case "MESECNO ELEKTRONSKI":
            $cena = "100";
            break;
        case "GODISNJE GOTOVINOM":
            $cena = "1200";
            break;
        case "GODISNJE ELEKTRONSKI":
            $cena = "1000";
            break;
        default:
            $cena = "N/A";
            break;
    }

    // $subject = "Dobrodošlica u našu biblioteku";
    // $message = "Poštovani/a $ime $prezime,\n\n";
    // $message .= "Želim Vam iskreno zahvaliti što ste postali član naše biblioteke. Vaša podrška je od izuzetne važnosti za održavanje i unapređenje naših usluga, i radujemo se što ćemo biti deo Vašeg knjižnog putovanja.\n\n";
    // $message .= "Vaša odluka da postanete član biblioteke omogućava Vam pristup našoj bogatoj kolekciji knjiga, časopisa, i drugih resursa. Nadamo se da ćete uživati u istraživanju sveta literature i znanja koje smo za Vas pripremili.\n\n";
    // $message .= "Takođe, želimo da Vas obavestimo o našim mogućnostima za elektronsko plaćanje članarine. Možete odabrati da plaćate godišnju ili mesečnu članarinu putem elektronskog bankarstva. Evo detalja koji Vam mogu biti od koristi:\n\n";
    // $message .= "Članarina: $clanarina - $cena RSD\n";
    // $message .= "Molimo Vas da uplatu izvršite na sledeći bankovni račun: [Broj računa biblioteke]\n";
    // $message .= "Prilikom uplate, koristite ovaj poziv na broj: $randomNumber\n\n";
    // $message .= "Još jednom, hvala Vam što ste se pridružili našoj biblioteci. Radujemo se što ćemo zajedno graditi prostor za učenje, istraživanje i inspiraciju.\n\n";
    // $message .= "Srdačan pozdrav,\n\n";
    // $message .= "[Naziv biblioteke]\n";
    // $message .= "[Kontakt informacije (broj email adresa)]";

    // $from_email = "projektnibiblioteka@gmail.com";
    // $headers = "From: $from_email\r\n";
    // $headers .= "Reply-To: $from_email\r\n";
    // $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // if (mail($email, $subject, $message, $headers, "-f $from_email")) {
    //     echo "Email sent successfully!";
    // } else {
    //     echo "Email sending failed.";
    // }

    // if ($conn->query($sql) === TRUE) {
    //     echo "New record inserted successfully";
    // } else {
    //     echo "Error: " . $sql . "<br>" . $conn->error;
    // }
} else {
    echo "Invalid request.";
}

?>
