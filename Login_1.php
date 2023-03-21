<?php
session_start();
include('server/connection.php');

if (isset($_SESSION['logged_in'])) {
    header('location: welcome.php');
    exit;
}

if (isset($_POST['register_btn'])) {
    header('location: register.html');
}


if (isset($_POST['login_btn'])) {
    $email = $_POST['user_email'];
    $password = ($_POST['user_password']);

    $query = "SELECT user_id, user_name, user_email, user_password, user_phone,
        user_address, user_city, user_photo FROM users WHERE user_email = ? 
        AND user_password = ? LIMIT 1";

    $stmt_login = $conn->prepare($query);
    $stmt_login->bind_param('ss', $email, $password);

    if ($stmt_login->execute()) {
        $stmt_login->bind_result(
            $user_id,
            $user_name,
            $user_email,
            $user_password,
            $user_phone,
            $user_address,
            $user_city,
            $user_photo
        );
        $stmt_login->store_result();

        if ($stmt_login->num_rows() == 1) {
            $stmt_login->fetch();

            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_name'] = $user_name;
            $_SESSION['user_email'] = $user_email;
            $_SESSION['user_password'] = $user_password;
            $_SESSION['user_phone'] = $user_phone;
            $_SESSION['user_address'] = $user_address;
            $_SESSION['user_city'] = $user_city;
            $_SESSION['user_photo'] = $user_photo;
            $_SESSION['logged_in'] = true;


            header('location: welcome.php?message=Logged in successfully');
        } else {
            header('location: Login_1.php?error=Could not verify your account!');
        }

    } else {
        header('location: Login_1.php?error=Something went wrong!');
    }
}
?>

<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="css/Login.css">
</head>

<body>
    <h1>Welcome to training.php</h1>
    <p>This page is Form Login, Please Login</p>
    <div class="Container-form">
        <form action="login_1.php" method="post">
            <div class="txt-field">
                <input type="email" name="user_email" placeholder="Enter email">
            </div>
            <div class="txt-field">
                <input type="password" name="user_password" placeholder="Enter password">
            </div>
            <div class="error">
                <?php if (isset($_GET['error'])) {
                    echo $_GET['error'];
                } ?>
            </div>
            <div>
                <input type="submit" id="login-btn" name="login_btn" value="LOGIN">
            </div>
        </form>
        <div class="daftar">
            Dont have an account yet?<a href="register.html">  Register Here</a>
        </div>
    </div>

</body>

<footer>
    Copyright, Fahri Aqila Putra
</footer>

</html>