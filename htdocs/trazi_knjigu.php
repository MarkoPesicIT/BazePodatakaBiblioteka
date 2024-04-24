<?php

// Include the database connection file
require_once('dbconfig.php');

// Fetch search term from GET request
$searchTerm = $_GET['searchTerm'];

// Set headers to allow CORS
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// SQL query to retrieve data
$sql = "SELECT knjige.*, autor.* FROM knjige 
INNER JOIN `autor-knjiga` ON knjige.id_knjige = `autor-knjiga`.id_knjige
INNER JOIN autor ON autor.id_autora = `autor-knjiga`.id_autora
WHERE knjige.id_knjige = 1 AND (knjige.naziv LIKE '%$searchTerm%' OR autor.ime LIKE '%$searchTerm%' OR autor.prezime LIKE '%$searchTerm%')
";

$result = $conn->query($sql);

if ($result === false) {
    // Handle query error
    $error = $conn->error;
    $response = array('error' => $error);
    echo json_encode($response);
} else {
    $data = array();

    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    // Close connection
    $conn->close();

    // Return data as JSON
    echo json_encode($data);
}

?>
