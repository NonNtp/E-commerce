<?php session_start() ?>
<?php include('./server/connect.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css" />
    <style>
        .btn:hover {
            cursor: pointer;
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

        .header {
            width: 30%;
            margin: 50px auto 0px;
            color: white;
            background: #E86A69;
            text-align: center;
            border: 1px solid #E86A69;
            border-bottom: none;
            border-radius: 10px 10px 0px 0px;
            padding: 20px;
        }

        .btn {
            background-color: lightpink;
        }

        p>a {
            color: red;
        }

        div label {
            font-size: 1.25rem;
        }
    </style>
</head>

<body>
    <h1 class="header">Login</h1>
    <form action="./server/login_db.php" method="POST">
        <?php include('./server/errors.php') ?>
        <?php if (isset($_SESSION['error'])) : ?>
            <div class="error">
                <h3>
                    <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
                </h3>
            </div>
        <?php endif ?>
        <div class="input-group">
            <label for="email">Email</label>
            <input type="text" name="email" />
        </div>
        <div class="input-group">
            <label for="password">Password</label>
            <input type="password" name="password" />
        </div>
        <div class="input-group">
            <button type="submit" name='login_user' class="btn">Login</button>
        </div>
        <p>Not yet a member ? <a href="register.php">Sign up</a></p>
    </form>
</body>

</html>