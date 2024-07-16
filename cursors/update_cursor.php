<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sessionId = $_POST['sessionId'];
$x = $_POST['x'];
$y = $_POST['y'];

$sql = "INSERT INTO cursors (session_id, x, y, last_update) 
        VALUES (?, ?, ?, NOW()) 
        ON DUPLICATE KEY UPDATE x = ?, y = ?, last_update = NOW()";

$stmt = $conn->prepare($sql);
$stmt->bind_param("siiii", $sessionId, $x, $y, $x, $y);
$stmt->execute();

$stmt->close();
$conn->close();

echo "Success";
