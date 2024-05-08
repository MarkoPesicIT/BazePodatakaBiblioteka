<?php
include 'dbconfig.php';

$query = "SELECT 
p.stanje AS stanje,
p.id_clana AS broj_clanske_karte,
k.naziv AS naziv_knjige,
CONCAT(a.ime, ' ', a.prezime) AS autor_knjige,
pri.`id( INV. BROJ )` AS inv_broj,
p.datumPozajmice AS datum_pozajmice,
p.datumPovratka AS datum_povratka,
p.beleska AS beleska
FROM
pozajmica p
JOIN knjige k ON p.id_knjige = k.id_knjige
JOIN autor_knjiga ak ON k.id_knjige = ak.KNJIGE_id_knjige
JOIN autor a ON ak.AUTOR_id_autora = a.id_autora
JOIN primerak pri ON p.inventarski_broj = pri.`id( INV. BROJ )`";
$result = mysqli_query($conn, $query);

if (!$result) {
    // Query failed, handle the error
    die("Query failed: " . mysqli_error($conn));
}

$data = array();

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Output the data as JSON
echo json_encode($data);

// Remember to close the database connection when done
mysqli_close($conn);
?>
