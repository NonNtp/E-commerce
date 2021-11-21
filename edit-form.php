<?php
session_start();
require_once('cartelement.php');
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
    <link rel="stylesheet" href="./css/style.css" />
    <title>Document</title>
</head>

<body>
    <?php
    $stmt = $pdo->prepare("SELECT * FROM product WHERE product_id = :product_id ");
    $stmt->bindParam(':product_id', $_GET["product_id"]);
    $stmt->execute();
    $row = $stmt->fetch();
    ?>
    <h1 class="header">Edit Product</h1>
    <form action="edit-product.php" method="post">
        <input type="hidden" name="product_id" value="<?= $row["product_id"] ?>">
        <div class="input-group">
            <label for="product_name">product_name</label>
            <input type="text" name="product_name" value="<?= $row["product_name"] ?>" required />
        </div>
        <div class="input-group">
            <label for="product_detail">product_detail</label>
            <textarea rows="8" cols="77" name="product_detail" required><?= $row["product_detail"] ?> </textarea>
        </div>
        <div class="input-group">
            <label for="product_color">product_color</label>
            <input type="text" name="product_color" value="<?= $row["product_color"] ?>" required />
        </div>
        <div class="input-group">
            <label for="product_price">product_price</label>
            <input type="number" name="product_price" value="<?= $row["product_price"] ?>" required />
        </div>
        <div class="input-group">
            <label for="product_metal">product_metal</label>
            <input type="text" name="product_metal" value="<?= $row["product_metal"] ?>" required />
        </div>

        <div class="input-group">
            <button type="submit" class="btn">Edit</button>
        </div>
    </form>
</body>

</html>