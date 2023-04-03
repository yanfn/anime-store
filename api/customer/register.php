<?php
// error_reporting(0);

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: POST');

include "function.php";

$requestMethod = $_SERVER["REQUEST_METHOD"];

if (isset($_POST['submit'])) {

    $inputData = json_decode(file_get_contents("php://input"), true);

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