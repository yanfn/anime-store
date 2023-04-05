<?php
// error_reporting(0);

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: POST');

include "function.php";

$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod == "POST") {

    // Used only in postman to send raw data
    $inputData = json_decode(file_get_contents("php://input"), true);

    // If inputData is empty this is where the POST method is processed
    if (empty($inputData)) {
        $customer = storeCustomer($_POST);
    }
    else {
        $customer = storeCustomer($inputData);
    }
    echo $customer;

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