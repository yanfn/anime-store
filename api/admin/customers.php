<?php
header('Content-Type: application/json');
header ('Access-Control-Allow-Origin: *');
header ('Access-Control-Allow-Method: GET');

include 'function.php';

$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod == "GET") {

    $customerList = getCustomerList();
    echo $customerList;
    
}
else {
    $data = [
        'status' => 500,
        'message' => 'Internal Server Error'
    ];

    http_response_code(500);
    echo json_encode($data);
}

?>