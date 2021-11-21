<?php
session_start();
error_reporting(~E_NOTICE);
include('./server/connect.php');
if (!isset($_SESSION['email'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    session_unset();
    header("location: login.php");
}
?>
<html>
<?php
echo $_SESSION['username'];
$user=$_SESSION['username'];
$sql = "INSERT INTO `orderss` (`order_id`, `username`, `paymode`) VALUES (NULL, '$user', 'COD')";

mysqli_query($conn,$sql);

?>
<body>


</body>

</html>
