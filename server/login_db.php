<?php
session_start();
include('connect.php');

if (isset($_POST['login_user'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5(mysqli_real_escape_string($conn, $_POST['password']));

    $check = "SELECT * FROM user WHERE email = '$email' AND password = '$password' ";
    $query = mysqli_query($conn, $check);
    if (mysqli_num_rows($query) == 1) {
        $_SESSION['email'] = $email;
        $result = mysqli_fetch_assoc($query);
        $_SESSION['username'] = $result['username'];
        $_SESSION['tel'] = $result['tel'];
        $_SESSION['address'] = $result['address'];

        header('location:../index.php');
    } else {
        header('location:../login.php');
    }
}
