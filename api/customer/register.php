<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: POST');

require_once "../../includes/dbcon.php";

$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod == 'POST') {

    $inputData = json_decode(file_get_contents("php://input"), true);
    
    if (empty($inputData)) {
        
    }
    else {
        echo $inputData['name'];
    }
    
} 
else {
    $data = [
        'status' => 405,
        'message' => $requestMethod . ' Method not allowed'
    ];
    http_response_code(405);
    echo json_encode($data);
}

?>