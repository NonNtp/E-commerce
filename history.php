<?php
session_start();
include('./server/connectdb.php');
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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
        }

        header {
            font-size: 2.25rem;
            margin-top: 50px;
            margin-left: 400px;
        }
    </style>
</head>

<body>
    <?php
    $username = $_SESSION['username'];
    $stmt = $pdo->prepare("SELECT payments.order_id , payments.id , payments.quantity , orderss.paymode , orderss.username , product.product_name ,  
    SUM(product.product_price * payments.quantity) AS total   
    FROM payments JOIN orderss ON payments.order_id = orderss.order_id 
    JOIN product ON payments.id = product.product_id WHERE orderss.username = :username GROUP BY payments.order_id , payments.id;");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    ?>

    <?php include('nav.php') ?>
    <header>History</header>
    <div style="margin-top: 50px; display:flex; justify-content:center">
        <table border="1" width='1000' style="text-align: center;">
            <tr>
                <th width="100">Order ID </th>
                <th width="100">Product ID </th>
                <th width="100">Product Name </th>
                <th width="100">Image </th>
                <th width="100">Quantity </th>
                <th width="100">Paymode </th>
                <th width="100">Price </th>
            </tr>
            <?php while ($row = $stmt->fetch()) : ?>
                <tr>
                    <td> <?= $row["order_id"] ?> <br /> </td>
                    <td> <?= $row["id"] ?> <br /> </td>
                    <td> <?= $row["product_name"] ?> <br /> </td>
                    <td> <img src="./img/products/<?= $row["id"] ?>.jpg" /><br /> </td>
                    <td> <?= $row["quantity"] ?> <br /> </td>
                    <td> <?= $row["paymode"] ?> <br /> </td>
                    <td> <?= $row["total"] ?> <br /> </td>
                </tr>

            <?php endwhile; ?>
        </table>
    </div>
</body>

</html>