<?php
session_start();
if ($_SESSION['user_type'] != 'prodavac') {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj Komponentu</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Prodaja Kompjutera</h1>
        </div>
    </header>
    <main>
        <div class="container">
            <h2>Dodaj novu komponentu</h2>
            <form action="dodaj_komponentu.php" method="post" class="form-style">
                <label for="naziv">Naziv:</label>
                <input type="text" id="naziv" name="naziv" required><br>
                <label for="opis">Opis:</label>
                <textarea id="opis" name="opis" required></textarea><br>
                <label for="cena">Cena:</label>
                <input type="number" id="cena" name="cena" step="0.01" required><br>
                <label for="kolicina">Količina:</label>
                <input type="number" id="kolicina" name="kolicina" required><br>
                <button type="submit">Dodaj komponentu</button>
            </form>
        </div>
    </main>
    <footer>
        <div class="container">
            <p>&copy; 2024 Prodaja Kompjutera. Sva prava zadržana.</p>
        </div>
    </footer>
</body>
</html>
