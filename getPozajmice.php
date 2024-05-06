<?php
include 'dbconfig.php';

$query = "SELECT * FROM your_table_name";
$result = mysqli_query($conn, $query);

$data = array();

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Output the data as JSON
echo json_encode($data);
?>
