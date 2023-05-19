<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecom_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$catId = $_GET['catId'];

// Fetch cities based on the selected region
$cityQuery = "SELECT sub_cat_id, sub_cat_title FROM sub_cat WHERE cat_id = '".$catId."'";
$cityResult = $conn->query($cityQuery);

$cities = array();

if ($cityResult->num_rows > 0) {
    while ($row = $cityResult->fetch_assoc()) {
        $cities[] = array(
            'id' => $row['sub_cat_id'],
            'name' => $row['sub_cat_title']
        );
    }
}

// Send the cities as JSON response
header('Content-Type: application/json');
echo json_encode($cities);
?>
