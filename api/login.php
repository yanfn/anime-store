<?php
require "../includes/dbcon.php";




    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FROM users WHERE email = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $user_type = $row['type'];

        if ($user_type == 'seller') {
            header("Location: index.html");
        } elseif ($user_type == 'customer') {
            header("Location: index.html");
        } elseif ($user_type == 'admin') {
            header("Location: ../view/admin/login.html");
        }
    } else {
        echo "Invalid credentials.";
    }


?>