<?php
// Include database configuration
include 'dbconfig.php';

if (isset($_POST['query'])) {
    $query = $_POST['query'];
    // You can adjust the SQL query to match your table structure and search criteria
    $sql = "SELECT * FROM knjige WHERE naziv LIKE '%$query%' LIMIT 5";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<li>" . $row['naziv'] . "</li>";
        }
    } else {
        echo "<li>No suggestions found</li>";
    }
}
?>
