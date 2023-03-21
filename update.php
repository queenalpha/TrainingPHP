<?php
include "server/connection.php";

$id = $_GET['user_id'];
$sql = "SELECT * FROM users WHERE user_id='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);


if (isset($_POST['btn_update'])) {

    $name = $_POST['user_name'];
    $email = $_POST['user_email'];
    $address = $_POST['user_address'];

    $q = "UPDATE users SET user_name = '$name', 
    user_address ='$address', user_email = '$email' WHERE user_id = '$id' ";
    mysqli_query($conn, $q);

    header('location:welcome.php');
}
?>

<html>

<head>
    <title>Update Account</title>
    <link rel="stylesheet" href="css/update.css">
</head>

<body>
    <div class="info-acc">
        <h1>Hi,
            <?php echo $row['user_name']; ?>
        </h1>
        <p>Here's form for update your account, Fill below</p>
    </div>
    <div class="container">
        <form id="login-form" method="POST">
            <div class="txt-field">
                Username
                <input type="username" name="user_name" value="<?php echo $row['user_name'] ?>"
                    placeholder="Enter new username">
            </div>
            <div class="txt-field">
                Address
                <input type="address" name="user_address" value="<?php echo $row['user_address'] ?>"
                    placeholder="Enter new address">
            </div>
            <div class="txt-field">
                Email
                <input type="email" name="user_email" value="<?php echo $row['user_email'] ?>"
                    placeholder="Enter new email">
            </div>
            <button type="submit" name="btn_update" class="btn-update">Update</button>
        </form>
    </div>
</body>

</html>