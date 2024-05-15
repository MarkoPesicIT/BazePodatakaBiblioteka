<?php
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

// Prikaz dostupnih automobila
$sql_cars = "SELECT * FROM automobili WHERE dostupan = 1";
$result_cars = $conn->query($sql_cars);

// Prikaz rezervacija
$sql_bookings = "SELECT * FROM rentiranje";
$result_bookings = $conn->query($sql_bookings);

// Prikaz korisnika
$sql_users = "SELECT * FROM korisnici";
$result_users = $conn->query($sql_users);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent a Car</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
      <div>
            
            <h1>Dostupni automobili</h1>
            <div id="cars-list">
                  <?php
            if ($result_cars->num_rows > 0) {
                  while($row = $result_cars->fetch_assoc()) {
                        echo "<div class='car'>";
                        echo "<h2>" . $row["marka"] . " " . $row["model"] . " (" . $row["godina"] . ")</h2>";
                        echo "<p>Cena: EUR " . $row["cena"] . " po danu</p>";
                        echo "<button onclick='reserveCar(" . $row["id"] . ")'>Rentiraj</button>";
                        echo "</div>";
                  }
            } else {
                  echo "Nema dostupnih automobila.";
            }
            ?>
        </div>
      </div>
<div>

      <h1>Rezervacije</h1>
      <div id="bookings-list">
            <?php
            if ($result_bookings->num_rows > 0) {
                  while($row = $result_bookings->fetch_assoc()) {
                        echo "<div class='booking'>";
                        echo "<p>Korisnik: " . $row["id_korisnika"] . ", Auto: " . $row["id_automobila"] . ", Datum pozajmice: " . $row["datum_pozajmljivanja"] . ", Datum povrtka: " . $row["datum_povratka"] . "</p>";
                        echo "<button onclick='cancelBooking(" . $row["id"] . ")'>Otkaži rezervaciju</button>";
                        echo "</div>";
                  }
            } else {
                  echo "Nema rezervacija.";
            }
            ?>
        </div>
      </div>
<div>

      <h1>Korisnici</h1>
      <input type="button" value="Dodaj korisnika" onclick="addUser()">

      <div id="users-list">
            <?php
            if ($result_users->num_rows > 0) {
                  while($row = $result_users->fetch_assoc()) {
                        echo "<div class='user'>";
                        echo "<p>Korisnicko ime: " . $row["username"] . ", Email: " . $row["email"] . ", Ime: " . $row["ime_prezime"] . "</p>";
                        echo "</div>";
                  }
            } else {
                  echo "Nema korisnika.";
            }
            ?>
        </div>
      </div>
</div>
      
      <script src="script.js"></script>
</body>
</html>

<?php
// Zatvaranje konekcije
$conn->close();
?>
