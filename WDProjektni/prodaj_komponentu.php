<?php
session_start();

// Učitavanje konekcije sa bazom podataka
require_once "db_config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Provera da li su prosleđeni potrebni podaci
    if (isset($_POST['komponenta_id'], $_POST['kolicina'])) {
        $komponenta_id = $_POST['komponenta_id'];
        $kolicina = $_POST['kolicina'];

        // Priprema upita za ažuriranje količine komponente
        $sql_update = "UPDATE komponente SET kolicina = kolicina - ? WHERE id = ?";

        // Priprema i izvršavanje SQL upita koristeći prepared statements
        if ($stmt_update = $conn->prepare($sql_update)) {
            $stmt_update->bind_param("ii", $kolicina, $komponenta_id);
            if ($stmt_update->execute()) {
                // Provera minimalne količine komponente
                $sql_check_min_quantity = "SELECT kolicina, min_kolicina FROM komponente WHERE id = ?";
                if ($stmt_check_min_quantity = $conn->prepare($sql_check_min_quantity)) {
                    $stmt_check_min_quantity->bind_param("i", $komponenta_id);
                    $stmt_check_min_quantity->execute();
                    $stmt_check_min_quantity->store_result();
                    $stmt_check_min_quantity->bind_result($nova_kolicina, $min_kolicina);
                    $stmt_check_min_quantity->fetch();

                    if ($nova_kolicina <= $min_kolicina) {
                        // Ako je nova količina manja ili jednaka minimalnoj količini, obriši komponentu
                        $sql_delete_component = "DELETE FROM komponente WHERE id = ?";
                        if ($stmt_delete_component = $conn->prepare($sql_delete_component)) {
                            $stmt_delete_component->bind_param("i", $komponenta_id);
                            $stmt_delete_component->execute();
                            $stmt_delete_component->close();
                        }
                        $obrisana = true;
                    } else {
                        $obrisana = false;
                    }

                    // Zatvaranje prepared statementa
                    $stmt_check_min_quantity->close();
                } else {
                    echo "Greška pri pripremi upita: " . $conn->error;
                }

                // Ažuriranje UI sa novom količinom
                echo json_encode(array("success" => true, "novaKolicina" => $nova_kolicina, "obrisana" => $obrisana));
            } else {
                echo json_encode(array("success" => false, "error" => ""));
            }
            $stmt_update->close();
        } else {
            echo json_encode(array("success" => false, "error" => ""));
        }
    } else {
        echo json_encode(array("success" => false, "error" => "Nisu prosleđeni potrebni podaci."));
    }
} else {
    echo json_encode(array("success" => false, "error" => "Neispravan HTTP zahtev."));
}

$conn->close();
?>
