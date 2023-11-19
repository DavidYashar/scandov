<?php
require_once 'autoLoader.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

$conn = mysqli_connect('sql203.infinityfree.com', 'if0_35437179', 'OQpwSTENAoqDw', 'if0_35437179_moving');
$query = mysqli_query($conn,"SELECT * FROM `product1` ORDER BY timestamp DESC" );

while ($row = $query->fetch_assoc()) {
    $users[] = $row;

    Header('Content-Type: application/json');
} if (!empty($users)) {
    
    echo json_encode($users);
} else {
    
    echo json_encode([]);
}
    $conn->close();
     
?>
