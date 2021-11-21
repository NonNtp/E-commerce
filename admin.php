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
    <link rel="stylesheet" type="text/css" href="style.css">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <style>
        .card:hover {
            cursor: pointer;
            transform: scale(1.25);
            border: 1px solid black;
        }

        .btn:hover {
            cursor: pointer;
        }

        a {
            text-decoration: none;
            color: white;
        }
    </style>
    <script>
        function confirmDelete(product_id) {
            var ans = confirm("Confirm to Delete " + product_id);
            if (ans == true)
                document.location = "delete.php?product_id=" + product_id;
        }
    </script>
    <title>Document</title>
</head>

<body>
    <?php include('nav.php') ?>
    <?php
    $stmt = $pdo->prepare("SELECT product.product_id , product.product_name , product.product_price,product.product_color,product.product_metal FROM product WHERE product.type_id = 1; ");
    $stmt->execute();
    ?>
    <?php
    $stmt2 = $pdo->prepare("SELECT product.product_id , product.product_name , product.product_price,product.product_color,product.product_metal FROM product WHERE product.type_id = 2; ");
    $stmt2->execute();
    ?>
    <?php
    $stmt3 = $pdo->prepare("SELECT product.product_id , product.product_name , product.product_price,product.product_color,product.product_metal FROM product WHERE product.type_id = 3; ");
    $stmt3->execute();
    ?>
    <?php
    $stmt4 = $pdo->prepare("SELECT product.product_id , product.product_name , product.product_price,product.product_color,product.product_metal FROM product WHERE product.type_id = 4; ");
    $stmt4->execute();
    ?>
    <?php
    $stmt5 = $pdo->prepare("SELECT product.product_id , product.product_name , product.product_price,product.product_color,product.product_metal FROM product WHERE product.type_id = 5; ");
    $stmt5->execute();
    ?>
    <div class="inner">
        <div class="container">
            <div class="row">
                <div class="d-flex">

                    <?php while ($row = $stmt->fetch()) : ?>
                        <div class="card" style="width: 18rem; margin:30px">
                            <a href="detail.php?product_id=<?= $row['product_id'] ?>"><img src="./img/products/<?= $row['product_id'] ?>.jpg" class="card-img-top"></a>
                            <div class="card-body">

                                <input type="hidden" name="product_id" value=" <?= $row["product_id"] ?>">
                                <p class="card-title"><strong><?= $row["product_name"] ?></strong></p>
                                <p class="card-text">price : <?= $row["product_price"] ?> ฿ </p>
                                <button type="button" class="btn btn-info"><a href="edit-form.php?product_id=<?= $row['product_id'] ?>">Edit</a></button>
                                <button type="button" class="btn btn-danger" onclick="confirmDelete(<?= $row['product_id'] ?>)">Delete</button>

                            </div>
                        </div>

                    <?php endwhile; ?>
                </div>
            </div>
            <div class="row">
                <div class="d-flex">
                    <?php while ($row = $stmt2->fetch()) : ?>
                        <div class="card" style="width: 18rem; margin:30px">
                            <a href="detail.php?product_id=<?= $row['product_id'] ?>"><img src="./img/products/<?= $row['product_id'] ?>.jpg" class="card-img-top"></a>
                            <div class="card-body">

                                <input type="hidden" name="product_id" value=" <?= $row["product_id"] ?>">
                                <p class="card-title"><strong><?= $row["product_name"] ?></strong></p>
                                <p class="card-text">price : <?= $row["product_price"] ?> ฿ </p>
                                <button type="button" class="btn btn-info"><a href="edit-form.php?product_id=<?= $row['product_id'] ?>">Edit</a></button>
                                <button type="button" class="btn btn-danger" onclick="confirmDelete(<?= $row['product_id'] ?>)">Delete</button>

                            </div>
                        </div>

                    <?php endwhile; ?>
                </div>
            </div>
            <div class="row">
                <div class="d-flex">
                    <?php while ($row = $stmt3->fetch()) : ?>
                        <div class="card" style="width: 18rem; margin:30px">
                            <a href="detail.php?product_id=<?= $row['product_id'] ?>"><img src="./img/products/<?= $row['product_id'] ?>.jpg" class="card-img-top"></a>
                            <div class="card-body">

                                <input type="hidden" name="product_id" value=" <?= $row["product_id"] ?>">
                                <p class="card-title"><strong><?= $row["product_name"] ?></strong></p>
                                <p class="card-text">price : <?= $row["product_price"] ?> ฿ </p>
                                <button type="button" class="btn btn-info"><a href="edit-form.php?product_id=<?= $row['product_id'] ?>">Edit</a></button>
                                <button type="button" class="btn btn-danger" onclick="confirmDelete(<?= $row['product_id'] ?>)">Delete</button>

                            </div>
                        </div>

                    <?php endwhile; ?>
                </div>
            </div>
            <div class="row">
                <div class="d-flex">
                    <?php while ($row = $stmt4->fetch()) : ?>
                        <div class="card" style="width: 18rem; margin:30px">
                            <a href="detail.php?product_id=<?= $row['product_id'] ?>"><img src="./img/products/<?= $row['product_id'] ?>.jpg" class="card-img-top"></a>
                            <div class="card-body">

                                <input type="hidden" name="product_id" value=" <?= $row["product_id"] ?>">
                                <p class="card-title"><strong><?= $row["product_name"] ?></strong></p>
                                <p class="card-text">price : <?= $row["product_price"] ?> ฿ </p>
                                <button type="button" class="btn btn-info"><a href="edit-form.php?product_id=<?= $row['product_id'] ?>">Edit</a></button>
                                <button type="button" class="btn btn-danger" onclick="confirmDelete(<?= $row['product_id'] ?>)">Delete</button>

                            </div>
                        </div>

                    <?php endwhile; ?>
                </div>
            </div>
            <div class="row">
                <div class="d-flex">
                    <?php while ($row = $stmt5->fetch()) : ?>
                        <div class="card" style="width: 18rem; margin:30px">
                            <a href="detail.php?product_id=<?= $row['product_id'] ?>"><img src="./img/products/<?= $row['product_id'] ?>.jpg" class="card-img-top"></a>
                            <div class="card-body">
                                <input type="hidden" name="product_id" value=" <?= $row["product_id"] ?>">
                                <p class="card-title"><strong><?= $row["product_name"] ?></strong></p>
                                <p class="card-text">price : <?= $row["product_price"] ?> ฿ </p>
                                <button type="button" class="btn btn-info"><a href="edit-form.php?product_id=<?= $row['product_id'] ?>">Edit</a></button>
                                <button type="button" class="btn btn-danger" onclick="confirmDelete(<?= $row['product_id'] ?>)">Delete</button>

                            </div>
                        </div>

                    <?php endwhile; ?>
                </div>
            </div>
        </div>

</body>

</html>