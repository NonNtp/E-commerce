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

        .thinking {
            background: white url('./img/checking.gif') no-repeat;
            background-position: 500px 15px;
        }

        .approved {
            background: white url('./img/true.gif') no-repeat;
            background-position: 500px 15px;
        }

        .denied {
            background: #ff8282 url('./img/false.gif') no-repeat;
            background-position: 500px 15px;
        }
        
        .header {
            width: 30%;
            margin: 50px auto 0px;
            color: white;
            background: #E86A69 ;
            text-align: center;
            border: 1px solid #E86A69 ;
            border-bottom: none;
            border-radius: 10px 10px 0px 0px;
            padding: 20px;
        }
        .btn {
            background-color: lightpink;
        }
    </style>
    <script>
        var xmlHttp;

        function checkUsername() {
            document.getElementById("username").className = "thinking";
            xmlHttp = new XMLHttpRequest();
            xmlHttp.onreadystatechange = showUsernameStatus;
            var username = document.getElementById("username").value;
            var url = "./server/checkusername.php?username=" + username;
            xmlHttp.open("GET", url);
            xmlHttp.send();
        }

        function showUsernameStatus() {
            if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                if (xmlHttp.responseText == "okay") {
                    document.getElementById("username").className = "approved";
                } else {
                    document.getElementById("username").className = "denied";
                    document.getElementById("username").focus();
                    document.getElementById("username").select();
                }
            }
        }
    </script>
</head>

<body>
    <h1 class="header">Register</h1>
    <form action="./server/register_db.php" method="POST">
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
            <label for="username">Username</label>
            <input type="text" name="username" id="username" onblur="checkUsername()" pattern="[a-zA-Z0-9_]{1,49}" title="Username should uppercase ,lowercase , number e.g. John1 or john" required />
        </div>
        <div class="input-group">
            <label for="email">Email</label>
            <input type="email" name="email" required />
        </div>
        <div class="input-group">
            <label for="password_1">Password</label>
            <input type="password" name="password_1" pattern="[a-zA-Z0-9_]{1,49}" title="password should uppercase ,lowercase , number e.g. John1 or john " required />
        </div>
        <div class="input-group">
            <label for="password_2">Confirm Password</label>
            <input type="password" name="password_2" pattern="[a-zA-Z0-9_]{1,49}" title="password should uppercase ,lowercase , number e.g. John1 or john " required />
        </div>
        <div class="input-group">
            <label for="tel">Tel</label>
            <input type="text" name="tel" pattern="[0-9]{10}" title="Tel should 10 digits only" required />
        </div>
        <div class="input-group">
            <label for="address">Address</label>
            <textarea name="address" rows="4" cols="50" required></textarea>
        </div>
        <div class="input-group">
            <button type="submit" name='reg_user' class="btn">Register</button>
        </div>
        <p>Already a member <a href="login.php">Sign in</a></p>
    </form>
</body>

</html>