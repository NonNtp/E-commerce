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
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
        }
    </style>



</head>


<body>
    <?php include('nav.php') ?>
    <?php
    $stmt = $pdo->prepare("SELECT * FROM product WHERE product_id = :product_id");
    $stmt->bindParam(':product_id', $_GET['product_id']);
    $stmt->execute();
    ?>

    <div class="container">
        <?php while ($row = $stmt->fetch()) : ?>
            <div style="width: 40rem; margin:50px;">
                <img src="./img/products/<?= $row['product_id'] ?>.jpg">
                <div style="margin-top: 20px;">
                    <form action="insertcart.php" method="post">
                        <h5>ID : <?= $row["product_id"] ?></h5>
                        <p><strong>Name : </strong> <?= $row["product_name"] ?> </p>
                        <p><strong>Detail : </strong><?= $row["product_detail"] ?> </p>
                        <p><strong>Color : </strong><?= $row["product_color"] ?> </p>
                        <p><strong>Metal : </strong><?= $row["product_metal"] ?> </p>
                        <p><strong>Price : </strong> <?= $row["product_price"] ?> ฿ </p>
                        <input type="hidden" name="Pproduct" value=" <?= $row["product_name"] ?>">
                        <input type="hidden" name="Pprice" value=" <?= $row["product_price"] ?>">
                        <input type="hidden" name="Pcolor" value=" <?= $row["product_color"] ?>">
                        <input type="hidden" name="Pmetal" value=" <?= $row["product_metal"] ?>">
                        <input type="hidden" name="Pid" value=" <?= $row["product_id"] ?>">
                        <input type="hidden" name="Ptype" value="2">
                        <p><input type="submit" name="addcart" value="Add to Cart"></p>
                    </form>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

</body>

</html>