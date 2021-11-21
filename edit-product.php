<?php include('./server/connectdb.php'); ?>
<?php
$stmt = $pdo->prepare("UPDATE product SET product_name=:product_name, product_detail=:product_detail, product_color=:product_color , 
product_price=:product_price ,  product_metal=:product_metal WHERE product_id= :product_id");
$stmt->bindParam(':product_name', $_POST["product_name"]);
$stmt->bindParam(':product_detail', $_POST["product_detail"]);
$stmt->bindParam(':product_color', $_POST["product_color"]);
$stmt->bindParam(':product_price', $_POST["product_price"]);
$stmt->bindParam(':product_metal', $_POST["product_metal"]);
$stmt->bindParam(':product_id', $_POST["product_id"]);
if ($stmt->execute())
    header("location: admin.php");
?>
