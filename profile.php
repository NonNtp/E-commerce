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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <style>
        .box {
            padding: 3rem;
        }

        .container {
            width: 100%;
            height: 90vh;
            margin: 0 auto;
            border: 2px solid black;
            border-radius: 30px;
            padding: 3rem;
        }

        .header {
            text-align: center;
        }

        .inside {
            margin: 0 auto;
            width: 50%;
        }

        .inside input {
            padding-left: 2rem;
            -webkit-box-sizing: border-box;
            /* Safari/Chrome, other WebKit */
            -moz-box-sizing: border-box;
            /* Firefox, other Gecko */
            box-sizing: border-box;
            /* Opera/IE 8+ */
        }

        .button-ticket {

            margin: 30px auto;
            width: 50%;
        }

        .button-ticket a {
            width: 100%;
            padding: 10px 1em;
        }
    </style>
</head>

<body>


    <?php include('nav.php') ?>
    <hr />
    <div class="box">
        <div class="container">
            <header class="header">
                <h1>Profile</h1>
            </header>
            <form>
                <div class="profile-detil">
                    <div class="row mb-3 inside">
                        <p>Email</p>
                        <input type="email" name="email" id="username" value="<?= $_SESSION['email'] ?>" required />
                    </div>
                    <div class="row mb-3 inside">
                        <p>Username</p>
                        <input type="text" name="username" required value="<?= $_SESSION['username'] ?>" pattern="[a-zA-Z0-9_]{1,49}" title="Username should uppercase ,lowercase , number e.g. John1 or john" />
                    </div>
                    <div class="row mb-3 inside">
                        <p>Tel</p>
                        <input type="text" name="tel" value="<?= $_SESSION['tel'] ?>" pattern="[0-9]{10}" title="Tel should 10 digits only" required />
                    </div>
                    <div class="row mb-3 inside">
                        <p>Address</p>
                        <input name="address" rows="4" cols="50" value="<?= $_SESSION['address'] ?>" required></input>
                    </div>
                    <div class="button-ticket">
                        <button class="btn btn-info" type="submit" name="submit"><a href="./history.php" style="color: black; text-decoration:none">History</a></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>