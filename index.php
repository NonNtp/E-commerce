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
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pandara</title>
    <link rel="stylesheet" type="text/css" href="style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <style>
        p {
            text-align: center;
            font-size: medium;
        }

        a:link {
            color: hotpink;
            text-decoration: none;
        }


        h1 {
            padding-top: 10px;
            text-align: center;
            font-size: larger;
        }

        h2 {
            color: pink;
            padding-top: 10px;
            text-align: center;
            font-size: larger;
        }


        .error {
            width: 92%;
            margin: 0px auto;
            padding: 10px;
            border: 1px solid #a94442;
            color: #a94442;
            background: #f2dede;
            border-radius: 5px;
            text-align: left;
        }

        .success {
            color: #3c763d;
            background: #dff0d8;
            border: 1px solid #3c763d;
            margin-bottom: 20px;
        }

        body {
            background-color: pink;
        }


        .inner {

            margin-bottom: 30px;
            padding-top: 50px;
            padding-bottom: 100px;
            background-color: white;
        }

        * {
            box-sizing: border-box
        }

        .mySlides1,
        .mySlides {
            display: none
        }




        /* Slideshow container */
        .slideshow-container {
            max-width: 1000px;
            position: relative;
            margin: auto;

        }

        .gallery {
            margin: 30px;
            position: relative;

        }

        /* Next & previous buttons */
        .prev,
        .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            padding: 16px;
            margin-top: -22px;
            color: gray;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        /* Position the "next button" to the right */
        .next {

            right: 0;
            border-radius: 3px 0 0 3px;
        }

        /* On hover, add a grey background color */
        .prev:hover,
        .next:hover {
            background-color: #f1f1f1;
            color: black;
        }

        .card shadow {
            align-items: center;
            width: 100%;

        }

        .cardre {
            margin-bottom: 50px;
            padding-bottom: 50px;
            background-color: #f2dede;
        }


        .rowg {
            justify-content: center;
            display: -ms-flexbox;
            /* IE10 */
            display: flex;
            -ms-flex-wrap: wrap;
            /* IE10 */
            flex-wrap: wrap;
            padding: 0 4px;

        }

        /* Create four equal columns that sits next to each other */
        .columng {
            -ms-flex: 25%;
            /* IE10 */
            flex: 25%;
            max-width: 25%;
            padding: 0 4px;
        }

        .columng img {
            margin-top: 8px;
            vertical-align: middle;
            width: 100%;
        }

        .columng a:hover {
            cursor: pointer;
            transform: scale(1.25);
            border: 1px solid black;
        }



        /* Responsive layout - makes a two column-layout instead of four columns */
        @media screen and (max-width: 800px) {
            .columng {
                -ms-flex: 50%;
                flex: 50%;
                max-width: 50%;
            }
        }

        @media screen and (max-width: 700px) {
            .columng {
                -ms-flex: 75%;
                flex: 75%;
                max-width: 75%;
            }
        }

        /* Responsive layout - makes the two columns stack on top of each other instead of next to each other */
        @media screen and (max-width: 600px) {
            .columng {
                -ms-flex: 100%;
                flex: 100%;
                max-width: 100%;
            }
        }
    </style>

</head>
<?php include('nav.php') ?>

<body>

    <div class="inner">

        <div class="slideshow-container">
            <div class="mySlides">
                <img src="https://cms-live.pandora.net/resource/responsive-image/1449972/m64-hero-module/lg/7/pandora-me-feature-inspire-oct-wk42-blackspace-inspiremehero.jpg" style="width:100%">
            </div>

            <div class="mySlides">
                <img src="https://www.pandora.net/-/media/Images/Consumer/campaigns/2021/CycleG_Nov_Dec/Extra/BuildMe_Hero_D_960x440.jpg" style="width:100%">
            </div>
        </div>

        <h1><br><br>Link up with Pandara </h1>
        <p>Meet our new collection of customisable pieces, made to remix and replay every day. </p>

        <?php
        $stmt0 = $pdo->prepare("SELECT product.product_id, product.product_name, product.product_price, payments.id, SUM(payments.quantity) as total FROM payments JOIN product ON payments.id = product.product_id GROUP BY id ORDER BY SUM(quantity) DESC LIMIT 4;");
        $stmt0->execute();
        ?>

        <div class="cardre">
            <div class="container">
                <div class="row">
                    <?php while ($row = $stmt0->fetch()) : ?>
                        <div class="col-md-3 text-center mt-5">
                            <div class="card ">
                                <h1>RECOMMENDED</h1>
                                <a href="detail.php?product_id=<?= $row['product_id'] ?>"> <img src="./img/products/<?= $row['product_id'] ?>.jpg" style="width:100% "></a>
                                <h6>Total : <?= $row["total"] ?> items </h6>
                                <h6>price : <?= $row["product_price"] ?> ฿ </h6>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>

        </div>


        <?php
        $stmt = $pdo->prepare("SELECT product.product_id , product.product_name , product.product_price FROM product WHERE product.type_id = 1;");
        $stmt->execute();
        ?>

        <div class="slideshow-container">
            <div class="mySlides1">
                <div class="row">
                    <?php while ($row = $stmt->fetch()) : ?>
                        <div class="col-md-3 text-center mt-5">
                            <div class="card shadow">
                                <a href="detail.php?product_id=<?= $row['product_id'] ?>"> <img src="./img/products/<?= $row['product_id'] ?>.jpg" style="width:100% "></a>
                                <h6>price : <?= $row["product_price"] ?> ฿ </h6>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>

            <?php
            $stmt2 = $pdo->prepare("SELECT product.product_id , product.product_name , product.product_price FROM product WHERE product.type_id = 2;");
            $stmt2->execute();
            ?>
            <div class="slideshow-container">
                <div class="mySlides1">
                    <div class="row">
                        <?php while ($row = $stmt2->fetch()) : ?>
                            <div class="col-md-3 text-center mt-5">
                                <div class="card shadow">

                                    <a href="detail.php?product_id=<?= $row['product_id'] ?>"><img src="./img/products/<?= $row['product_id'] ?>.jpg" style="width:100% "></a>
                                    <h6>price : <?= $row["product_price"] ?> ฿ </h6>

                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
            <?php
            $stmt3 = $pdo->prepare("SELECT product.product_id , product.product_name , product.product_price FROM product WHERE product.type_id = 3;");
            $stmt3->execute();
            ?>
            <div class="slideshow-container">
                <div class="mySlides1">
                    <div class="row">
                        <?php while ($row = $stmt3->fetch()) : ?>
                            <div class="col-md-3 text-center mt-5">
                                <div class="card shadow">

                                    <a href="detail.php?product_id=<?= $row['product_id'] ?>"><img src="./img/products/<?= $row['product_id'] ?>.jpg" style="width:100% "></a>
                                    <h6>price : <?= $row["product_price"] ?> ฿ </h6>

                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>

            <?php
            $stmt4 = $pdo->prepare("SELECT product.product_id , product.product_name , product.product_price FROM product WHERE product.type_id = 4;");
            $stmt4->execute();
            ?>
            <div class="slideshow-container">
                <div class="mySlides1">
                    <div class="row">
                        <?php while ($row = $stmt4->fetch()) : ?>
                            <div class="col-md-3 text-center mt-5">
                                <div class="card shadow">

                                    <a href="detail.php?product_id=<?= $row['product_id'] ?>"><img src="./img/products/<?= $row['product_id'] ?>.jpg" style="width:100% "></a>
                                    <h6>price : <?= $row["product_price"] ?> ฿ </h6>

                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>

            <?php
            $stmt5 = $pdo->prepare("SELECT product.product_id , product.product_name , product.product_price FROM product WHERE product.type_id = 5;");
            $stmt5->execute();
            ?>
            <div class="slideshow-container">
                <div class="mySlides1">
                    <div class="row">
                        <?php while ($row = $stmt5->fetch()) : ?>
                            <div class="col-md-3 text-center mt-5">
                                <div class="card shadow">

                                    <a href="detail.php?product_id=<?= $row['product_id'] ?>"> <img src="./img/products/<?= $row['product_id'] ?>.jpg" style="width:100% "></a>
                                    <h6>price : <?= $row["product_price"] ?> ฿ </h6>

                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>





            <a class="prev" onclick="plusSlides(-1, 0)">&#10094;</a>
            <a class="next" onclick="plusSlides(1, 0)">&#10095;</a>
        </div>


        <div class="gallery">
            <div class="rowg">
                <div class="columng">
                    <!-- <a href="ring.php"><img src="./img/collection pearl.jpg" style="width:100%">
                    <h1>Collection Purl set</h1>
                    <a href="ring.php"><img src="./img/collection rose gold.jpg" style="width:100%">
                    <h1>Collection Rose gold</h1>
                    <img src="https://www.pandora.net/-/media/Images/Consumer/SPOTS/Campaigns/2021/October/ME_Anthem_Of_Me_Oct/Widget1x1.jpg" style="width:100%"> -->

                    <img src="https://www.pandora.net/-/media/Images/Consumer/SPOTS/Campaigns/2021/October/ME_Collection_Oct/Widget2x2.jpg" style="width:100%">
                    <img src="https://www.pandora.net/-/media/Images/Consumer/SPOTS/Campaigns/2021/October/Halloween-Moments/Widget2x1.jpg" style="width:100%">
                    <a href="collectiongold.php"><img src="./img/collection gold.jpg" style="width:100%">
                        <h2>Collection Gold</h2>
                        <img src="https://www.pandora.net/-/media/Images/Consumer/SPOTS/Campaigns/2021/October/ME_Anthem_Of_Me_Oct/Widget1x1.jpg" style="width:100%">
                        <img src="https://www.pandora.net/-/media/Images/Consumer/SPOTS/Campaigns/2021/October/ME_Sneak_Peek/Widget2x2.jpg" style="width:100%">
                </div>
                <div class="columng">
                    <a href="pinkset.php"><img src="./img/pink.jpg" style="width:100%">
                        <h2>Pink Set</h2>
                        <img src="https://www.pandora.net/-/media/Images/Consumer/SPOTS/Campaigns/2021/October/Craftsmanship/Widget1x1.jpg" style="width:100%">
                        <a href="collectionsilver.php"><img src="./img/silver set.jpg" style="width:100%">
                            <h2>Collection Silver</h2>
                            <img src="https://www.pandora.net/-/media/Images/Consumer/SPOTS/Campaigns/2021/October/ME_Collection_Oct/Widget2x2.jpg" style="width:100%">
                </div>
            </div>
        </div>




    </div>


    <script>
        var slideIndex = [1, 1];
        var slideId = ["mySlides1"]
        showSlides(1, 0);
        showSlides(1, 1);

        function plusSlides(n, no) {
            showSlides(slideIndex[no] += n, no);
        }

        function showSlides(n, no) {
            var i;
            var x = document.getElementsByClassName(slideId[no]);
            if (n > x.length) {
                slideIndex[no] = 1
            }
            if (n < 1) {
                slideIndex[no] = x.length
            }
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            x[slideIndex[no] - 1].style.display = "block";
        }
    </script>

    <script>
        var myIndex = 0;
        carousel();

        function carousel() {
            var i;
            var x = document.getElementsByClassName("mySlides");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            myIndex++;
            if (myIndex > x.length) {
                myIndex = 1
            }
            x[myIndex - 1].style.display = "block";
            setTimeout(carousel, 2000); // Change image every 2 seconds
        }
    </script>





</body>

</html>