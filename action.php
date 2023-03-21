<?php
    include 'server/connection.php';

    $username = $_POST['user_name'];
    $email = $_POST['user_email'];
    $password = ($_POST['user_password']);
    $address = $_POST['user_address'];

    $query = "INSERT into users values ('','$username','$email','$password','','$address','','')";

    mysqli_query($conn, $query);

    header("location:register.html");
    die();
?>
