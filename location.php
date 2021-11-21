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
        ul,
        li {
            list-style-type: none;
        }
    </style>
    <script>
        async function getDataFromAPI() {
            let response = await fetch('http://localhost/project_web5/data.php')
            let rawData = await response.text()
            objectData = JSON.parse(rawData)
            let result = document.getElementById('result')

            for (let i = 0; i < objectData.Sheet1.length; i++) {
                let content = "Product : " + [i + 1] + ' ' + objectData.Sheet1[i].Product + ' <br/> '
                content += "Location : " + objectData.Sheet1[i].Government + '<br/>'
                content += "district : " + objectData.Sheet1[i].district + '<br/>'
                content += "province : " + objectData.Sheet1[i].province + '<br/>' + '<br/>'
                let li = document.createElement('li')
                li.innerHTML = content
                result.appendChild(li)
            }
        }
        getDataFromAPI()
    </script>
</head>

<body>
    <?php include('nav.php') ?>
    <h1 style="margin-left: 30px; margin-top:20px">OTOPS Product : </h1>
    <ul id="result"></ul>
</body>

</html>