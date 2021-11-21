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

        h1 {
            text-align: center;
        }
    </style>


</head>


<body>
    <?php include('nav.php') ?>
    <?php
    $stmt = $pdo->prepare("SELECT product.product_id , product.product_name , product.product_price,product.product_color,product.product_metal FROM product WHERE product.product_color LIKE '%Pink%';");
    $stmt->execute();
    ?>
    <div class="inner">

        <div class="slideshow-container">
            <div class="mySlides">
                <img src="./img/pinkbanner.jpg" style="width:100%">
            </div>
        </div>
        
        <h1>Pink Set</h1>

        <div class="container">
            <div class="row">
                <!-- <div class="d-flex"> -->
                    <?php while ($row = $stmt->fetch()) : ?>
                        <div class="card" style="width: 18rem; margin:30px">
                            <a href="detail.php?product_id=<?= $row['product_id'] ?>"><img src="./img/products/<?= $row['product_id'] ?>.jpg" class="card-img-top"></a>
                            <div class="card-body">
                              <form action="insertcart.php" method="post">
                                <p class="card-title"><strong><?= $row["product_name"] ?></strong></p>
                                <p class="card-text">price : <?= $row["product_price"] ?> ฿ </p>
                                <input type="hidden" name="Pproduct" value=" <?= $row["product_name"] ?>">
                                <input type="hidden" name="Pprice" value=" <?= $row["product_price"] ?>">
                                <input type="hidden" name="Pcolor" value=" <?= $row["product_color"] ?>">
                                <input type="hidden" name="Pmetal" value=" <?= $row["product_metal"] ?>">
                                <input type="hidden" name="Pid" value=" <?= $row["product_id"] ?>">
                                <input type="hidden" name="Ptype" value="1">
                                <p><input type="submit" name="addcart" value="Add to Cart"></p>
                              </form>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>

    </div>


</body>

</html>
