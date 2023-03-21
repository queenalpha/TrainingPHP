okkkk
<?php
session_start();
include('server/connection.php');

$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
}

if (isset($_POST['cari'])) {
    $keyword = $_POST['keyword'];
    $q = "SELECT * FROM users WHERE user_id LIKE '%$keyword%' OR
    user_name LIKE '%$keyword%' OR  user_email LIKE '%$keyword%'";
} else {
    $q = 'SELECT * FROM users';
}

$result = mysqli_query($conn, $q);


if (!isset($_SESSION['logged_in'])) {
    header('location: Login_1.php');
    exit;
}

if (isset($_GET['logout'])) {
    if (isset($_SESSION['logged_in'])) {
        unset($_SESSION['logged_in']);
        unset($_SESSION['user_email']);
        header('location: Login_1.php');
        exit;
    }
}
?>

<html>

<head>
    <link rel="stylesheet" href="css/welcome.css">
    <title>Selamat Datang</title>
</head>

<body>
    <section class="Informasi">
        <h1>Hi,
            <?php echo $_SESSION['user_name']; ?>
        </h1>
        <p>Please check your information below</p>

        <table id="self-table">
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Address</th>
            </tr>
            <tr>
                <td>
                    <?php echo $_SESSION['user_id'] ?>
                </td>
                <td>
                    <?php echo $_SESSION['user_email'] ?>
                </td>
                <td>
                    <?php echo $_SESSION['user_address'] ?>
                </td>
            </tr>
        </table>
    </section>

    <section class="info-acc">
        <h3>Here is an accounts list that already regist</h3>
        <form class="search" method="post">
            <input class="search-box" type="text" name="keyword" placeholder="Masukan keyword">
            <br>
            <input type="submit" class="btn-search" name="cari" value="Cari">
        </form>
        <table id="acc-table">
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Address</th>
                <th colspan="2">Action</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td>
                        <?php echo $row['user_id'] ?>
                    </td>
                    <td>
                        <?php echo $row['user_email'] ?>
                    </td>
                    <td>
                        <?php echo $row['user_address'] ?>
                    </td>
                    <td class="dlt">
                        <a href="actionDelete.php?user_id= <?php echo $row['user_id']; ?>" id="delete"
                            onclick="return confirm('Data ini akan dihapus')">Hapus</a>
                    </td>
                    <td class="upd">
                        <a href="update.php?user_id=<?php echo $row['user_id']; ?>" id="update">Update</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <button id="log-out">
            <a href="welcome.php?logout=1" id="keluar">Log Out</a>
        </button>
    </section>
</body>

</html>