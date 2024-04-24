<?php
include 'dbconfig.php';

$query = "SELECT stanje, naziv_knjige, invBroj_knjige, datumPozajmice, datumPovratka, beleska FROM pozajmice";

$result = mysqli_query($conn, $query);

if ($result) {
    echo '<table>
            <thead>
                <tr>
                    <th>Stanje</th>
                    <th>Naziv Knjige</th>
                    <th>Inv. Broj</th>
                    <th>Datum Pozajmice</th>
                    <th>Datum Povratka</th>
                    <th>Beleska</th>
                </tr>
            </thead>
            <tbody>';
    
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>
                <td>' . $row['stanje'] . '</td>
                <td>' . $row['naziv_knjige'] . '</td>
                <td>' . $row['invBroj_knjige'] . '</td>
                <td>' . $row['datumPozajmice'] . '</td>
                <td>' . $row['datumPovratka'] . '</td>
                <td>' . $row['beleska'] . '</td>
              </tr>';
    }

    echo '</tbody></table>';
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
