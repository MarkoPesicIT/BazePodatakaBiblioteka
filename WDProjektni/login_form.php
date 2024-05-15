<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
            <h2>Login</h2>
            <form action="login.php" method="post" class="form-style">
                <label for="korisnicko_ime">Korisničko ime:</label>
                <input type="text" id="korisnicko_ime" name="korisnicko_ime" required><br>
                <label for="lozinka">Lozinka:</label>
                <input type="password" id="lozinka" name="lozinka" required><br>
                <button type="submit">Login</button>
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
