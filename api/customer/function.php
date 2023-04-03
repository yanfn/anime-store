<?php

require "../../includes/dbcon.php";

function error422 ($message){
    $data = [
        'status' => 422,
        'message' => $message,
    ];
    http_response_code(422);
    echo json_encode($data);
    exit();
}

function storeCustomer ($customerInput) {
    
    global $conn;

    $type = 'customer';
    $email = mysqli_real_escape_string($conn, $customerInput['email']);
    $password = mysqli_real_escape_string($conn, $customerInput['password']);
    $fname = mysqli_real_escape_string($conn, $customerInput['fname']);
    $lname = mysqli_real_escape_string($conn, $customerInput['lname']);
    $sex = mysqli_real_escape_string($conn, $customerInput['sex']);
    $raw_date = mysqli_real_escape_string($conn, $customerInput['date']);
    $phone = mysqli_real_escape_string($conn, $customerInput['phone']);
    $street = mysqli_real_escape_string($conn, $customerInput['street']);
    $city = mysqli_real_escape_string($conn, $customerInput['city']);
    $province = mysqli_real_escape_string($conn, $customerInput['province']);
    $zipcode = mysqli_real_escape_string($conn, $customerInput['zipcode']);
    
    $date = date('Y-m-d', strtotime($raw_date));

    if (empty(trim($email))) {
        return error422('Enter your email');
    }elseif (empty(trim($password))) {
        return error422('Enter your password');
    }elseif (empty(trim($fname))) {
        return error422('Enter your first name');
    }elseif (empty(trim($lname))) {
        return error422('Enter your last name');
    }elseif (empty(trim($sex))) {
        return error422('Enter your sex');
    }elseif (empty(trim($date))) {
        return error422('Enter your date');
    }elseif (empty(trim($phone))) {
        return error422('Enter your phone');
    }elseif (empty(trim($street))) {
        return error422('Enter your street');
    }elseif (empty(trim($city))) {
        return error422('Enter your city');
    }elseif (empty(trim($province))) {
        return error422('Enter your province');
    }elseif (empty(trim($zipcode))) {
        return error422('Enter your zipcode');
    }
    else {
        $user_query = "INSERT INTO users (email, password, type) VALUES ('$email', '$password', '$type')";
        $user_result = mysqli_query($conn, $user_query);

        if ($user_result) {

            $user_id = mysqli_insert_id($conn);

            $customer_query = "INSERT INTO customers (user_id, fname, lname, sex, birthdate, phone_number) VALUES ('$user_id', '$fname', '$lname', '$sex', '$date', '$phone')";
            $customer_result = mysqli_query($conn, $customer_query);

            if ($customer_result) {

                $customer_id = mysqli_insert_id($conn);

                $address_query = "INSERT INTO customer_address (customer_id, street_address, city, province, zip_code) VALUES ('$customer_id', '$street', '$city', '$province', '$zipcode')";
                $address_result = mysqli_query($conn, $address_query);

                if ($address_result) {
                    $data = [
                        'status' => 201,
                        'message' => 'Account created successfully',
                        'customer' => [
                            'id' => $customer_id,
                            'fname' => $fname,
                            'lname' => $lname,
                            'sex' => $sex,
                            'birthdate' => $date,
                            'phone_number' => $phone,
                            'address' => [
                                'street_address' => $street,
                                'city' => $city,
                                'province' => $province,
                                'zip_code' => $zipcode
                            ]
                        ]
                    ];
                    http_response_code(201);
                    return json_encode($data);
                }
                else {
                    $data = [
                        'status' => 500,
                        'message' => 'Internal server error'
                    ];
                    http_response_code(500);
                    return json_encode($data);
                }
            }
        }
    }




}


?>