<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT session_id, x, y FROM cursors WHERE last_update > NOW() - INTERVAL 5 SECOND";
$result = $conn->query($sql);

$cursors = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $cursors[] = $row;
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($cursors);
