<!DOCTYPE html>
<html>
<head>
    <title>Rezervacije</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rezervacije";

// Establish database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Neuspešno povezivanje na bazu podataka: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["unesi"])) {
        $ime = $_POST["ime"];
        $hotel = $_POST["hotel"];
        $datum_dolaska = $_POST["datum_dolaska"];
        $datum_odlaska = $_POST["datum_odlaska"];
       
        unesiRezervaciju($ime, $hotel, $datum_dolaska, $datum_odlaska);
    } elseif (isset($_POST["brisi"])) {
        $id = $_POST["id"];
        obrisiRezervaciju($id);
    }
}

// Function to insert reservation data into the database
function unesiRezervaciju($ime, $hotel, $datum_dolaska, $datum_odlaska) {
    global $conn;
   
    $sql = "INSERT INTO rezervacije (ime, hotel, datum_dolaska, datum_odlaska) VALUES (?, ?, ?, ?)";
    
    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $ime, $hotel, $datum_dolaska, $datum_odlaska);
    
    if ($stmt->execute()) {
        echo "Rezervacija uspešno unesena.";
    } else {
        echo "Greška prilikom unosa rezervacije: " . $conn->error;
    }
    
    $stmt->close();
}

// Function to display reservations
function prikaziRezervacije() {
    global $conn;
   
    $sql = "SELECT * FROM rezervacije";
    $result = $conn->query($sql);
   
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Ime</th><th>Hotel</th><th>Datum dolaska</th><th>Datum odlaska</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["id"] . "</td><td>" . $row["ime"] . "</td><td>" . $row["hotel"] . "</td><td>" . $row["datum_dolaska"] . "</td><td>" . $row["datum_odlaska"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "Nema rezervacija.";
    }
}

// Function to delete a reservation
function obrisiRezervaciju($id) {
    global $conn;
   
    $sql = "DELETE FROM rezervacije WHERE id=?";
    
    // Prepare and bind parameter
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo "Rezervacija uspešno obrisana.";
    } else {
        echo "Greška prilikom brisanja rezervacije: " . $conn->error;
    }
    
    $stmt->close();
}
?>

<h2>Unesi rezervaciju</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Ime: <input type="text" name="ime"><br><br>
    Hotel: <input type="text" name="hotel"><br><br>
    Datum dolaska: <input type="date" name="datum_dolaska"><br><br>
    Datum odlaska: <input type="date" name="datum_odlaska"><br><br>
    <input type="submit" name="unesi" value="Unesi">
</form>

<h2>Prikazi rezervacije</h2>
<?php prikaziRezervacije(); ?>

<h2>Obriši rezervaciju</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    ID rezervacije: <input type="text" name="id"><br><br>
    <input type="submit" name="brisi" value="Brisi">
</form>

</body>
</html>
