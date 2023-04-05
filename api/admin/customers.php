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
        'status' => 405,
        'message' => $requestMethod . ' Not Allowed'
    ];

    http_response_code(405);
    echo json_encode($data);
}

?>