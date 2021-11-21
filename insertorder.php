<?php
session_start();
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
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pandara</title>
    <link rel="stylesheet" type="text/css" href="style.css">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <style>
        .card:hover {
            cursor: pointer;
            transform: scale(1.25);
            border: 1px solid black;
        }


    </style>

</head>


<body>

<?php
//$totoaa=$_POST['TotalPrice'];
//$decoded = json_decode($totoaa, true);
$pavment = $_POST['Payment'];
$totoaa=$_POST['totalp'];

//echo $_SESSION['username'];
$user=$_SESSION['username'];
if(isset($_POST['Buy'])){
    $sql = "INSERT INTO `orderss` (`order_id`, `username`, `paymode`, `total_price`) VALUES (NULL, '$user', '$pavment','$totoaa')";

    if(mysqli_query($conn,$sql))
    {
      $order_id = mysqli_insert_id($conn);
      $sql2 = "INSERT INTO `payments`(`order_id`, `id`, `quantity`) VALUES (?,?,?)";

      $stmt=mysqli_prepare($conn,$sql2);

      if($stmt){
        mysqli_stmt_bind_param($stmt,"iii",$order_id,$Pid,$Quantity);
        foreach ($_SESSION['cart'] as $key => $value)
        {
          $Pid=$value['Pid'];
          $Quantity=$value['Quantity'];
          mysqli_stmt_execute($stmt);

        }
        unset($_SESSION['cart']);
        echo"<script>alert('Order Placed'); window.location.href=('index.php');</script>";
      }
        else{echo"<script>alert('sql error')</script>";}

    }
    else{echo"<script>alert('sql prepare error')</script>";}
  }

?>
    </div>


</body>

</html>
