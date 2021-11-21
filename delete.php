<?php include('./server/connectdb.php');

$stmt = $pdo->prepare("DELETE FROM product WHERE product_id=:product_id");
$stmt->bindParam(':product_id', $_GET["product_id"]);
if ($stmt->execute())
    header("location: admin.php");
