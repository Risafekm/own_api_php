<?php
error_reporting(0);
include 'connection.php';
$rollno=$_GET['rollNo'];
$sql = "SELECT * FROM `division_1`";
mysqli_set_charset($conn,'utf8');
$result = $conn->query($sql);
$response = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        array_push($response, $row);
    }
}
$conn->close();
header('Content-Type: application/json');
echo json_encode($response);

?>


