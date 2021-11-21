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
        .card:hover {
            cursor: pointer;
            transform: scale(1.25);
        }
    </style>



</head>


<body>
    <?php
    $stmt = $pdo->prepare("SELECT * FROM product WHERE product.product_name LIKE ?");
    if (!empty($_GET))
        $value = '%' . $_GET['keyword'] . '%';
    $stmt->bindParam(1, $value);
    $stmt->execute();
    ?>
    <?php include('nav.php') ?>

    <div class="container" style="margin-top: 50px;">
        <h3>Search Result : <?php echo $_GET['keyword'] ?> </h3> <br />
        <div class="row">

            <div class="d-flex" style="flex-wrap: wrap; ">
                <?php while ($row = $stmt->fetch()) : ?>
                    <div class="card" style="width: 18rem;  margin-left:20px ; margin-top:20px">
                        <a href="detail.php?product_id=<?= $row['product_id'] ?>"><img src="./img/products/<?= $row['product_id'] ?>.jpg" class="card-img-top"></a>
                        <div class="card-body">
                            <p class="card-title"><strong><?= $row["product_name"] ?></strong></p>
                            <p class="card-text">price : <?= $row["product_price"] ?> ฿ </p>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>

        </div>
    </div>




</body>

</html>