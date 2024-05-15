<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komponente na prodaju</title>
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
            <h2>Komponente na prodaju</h2>
            <div class="komponente-lista">
                <?php
                include 'db_config.php';

                $sql = "SELECT k.id, k.naziv, k.opis, k.cena, k.kolicina, p.ime AS prodavac
                        FROM komponente k
                        JOIN korisnici p ON k.prodavac_id = p.id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='komponenta'>";
                        echo "<h3>" . $row['naziv'] . "</h3>";
                        echo "<p>" . $row['opis'] . "</p>";
                        echo "<p><strong>Cena:</strong> " . $row['cena'] . " RSD</p>";
                        echo "<p><strong>Količina:</strong> " . $row['kolicina'] . "</p>";
                        echo "<p><strong>Prodavac:</strong> " . $row['prodavac'] . "</p>";
                        if ($_SESSION['user_type'] == 'prodavac') {
                            echo "<button class='prodaj-komponentu' data-komponenta-id='" . $row['id'] . "'>Prodaj komponentu</button>";
                        }
                        echo "</div>";
                    }
                } else {
                    echo "<p>Nema dostupnih komponenti.</p>";
                }

                $conn->close();
                ?>
            </div>
        </div>
    </main>
    <footer>
        <div class="container">
            <p>&copy; 2024 Prodaja Kompjutera. Sva prava zadržana.</p>
        </div>
    </footer>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dugmadProdajKomponentu = document.querySelectorAll('.prodaj-komponentu');

            dugmadProdajKomponentu.forEach(function(dugme) {
                dugme.addEventListener('click', function() {
                    const komponentaId = dugme.dataset.komponentaId;
                    const kolicina = prompt('Koliko komada želite prodati?');

                    if (kolicina !== null) {
                        const formData = new FormData();
                        formData.append('komponenta_id', komponentaId);
                        formData.append('kolicina', kolicina);

                        fetch('prodaj_komponentu.php', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                if (data.obrisana) {
                                    // Ažurirati UI tako da ukloni komponentu
                                    dugme.parentNode.remove();
                                } else {
                                    // Ažurirati UI tako da prikaže novu količinu komponente
                                    dugme.parentNode.querySelector('p strong:last-child').textContent = 'Količina: ' + data.novaKolicina;
                                }
                                alert('Komponenta je uspešno prodata.');
                            } else {
                                alert('Došlo je do greške prilikom prodaje komponente.');
                            }
                        })
                        .catch(error => {
                            console.error('Došlo je do greške prilikom slanja zahteva:', error);
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>
