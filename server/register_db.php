<?php
include('connect.php');
session_start();
$errors = array();

if (isset($_POST['reg_user'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);
    $tel = mysqli_real_escape_string($conn, $_POST['tel']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $user_check_query = "SELECT * FROM user WHERE username='$username' OR email='$email' LIMIT 1";
    $query = mysqli_query($conn, $user_check_query);
    $result = mysqli_fetch_assoc($query);

    if ($result) {
        if ($result['username'] === $username) {
            array_push($errors, "Username already exists");
        }

        if ($result['email'] === $email) {
            array_push($errors, "email already exists");
        }
    }
    if (count($errors) == 0) {
        $password = md5($password_1);

        $sql = "INSERT INTO user (email, username, password, tel, address) 
                  VALUES('$email', '$username', '$password','$tel','$address')";
        mysqli_query($conn, $sql);
        $_SESSION['email'] = $email;
        $_SESSION['success'] = "You are now logged in";
        header('location:../login.php');
    } else {
        array_push($errors, "Email already exists ");
        $_SESSION['error'] = "Email already exists";
        header('location:../register.php');
    }
}
