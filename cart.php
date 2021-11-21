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

    table,
    th,
    td {
      border: 1px solid black;
    }

    th,
    td {
      padding: 10px;
    }
  </style>

</head>


<body>
  <?php include('nav.php') ?>
  <?php
  $stmt = $pdo->prepare("SELECT product.product_id , product.product_name , product.product_price FROM product WHERE product.type_id = 5;");
  $stmt->execute();
  ?>
  <div class="inner">

    <div class="container">
      <div class="row">
        <div class="d-flex">

          <?php

          $src = 0;
          $fg = 0;
          $total = 0;

          if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $key => $value) {
              $sr = $key + 1;
              $total = $total + $value['Price'];


              $src = $value['Pid'];
              $src = $src + 0;
              $imgUrl = "./img/products/$src.jpg";
              echo "

                                <table>
                                  <tr>
                                    <td><img src='$imgUrl'/>  </td>
                                  </tr>
                                  <tr>
                                    <td>Name : $value[Item_Name] </td>
                                  </tr>
                                  <tr>
                                    <td>Price : $value[Price] ฿ <input type='hidden' class='iprice' value='$value[Price]'></td>
                                  </tr>
                                  <tr>
                                    <td>Color : $value[Color]</td>
                                  </tr>
                                  <tr>
                                      <td>Metal : $value[Metal]</td>
                                  </tr>
                                  <tr>

                                    <form action='insertcart.php' method='POST'>
                                      <td><input class='iquantity' type='number' name='Mod_Quantity' onchange='this.form.submit();' min='1' max='10' value='$value[Quantity]'><br><br></td>
                                      <input type='hidden' name='Item_Name' value='$value[Item_Name]'>
                                    </form>

                                  <tr>
                                      <td>

                                    <form action='insertcart.php' method='POST'>
                                      <button name='removeitem'>REMOVE</button>
                                      <input type='hidden' name='Item_Name' value='$value[Item_Name]'>
                                      </form>
                                      </td>
                                  </tr
                                  ><tr>

                                  </tr>

                                  ";
            }
            echo "
                              </table>
                              <table>
                                <tr><form action='insertorder.php' method='POST'>
                                  <th>TOTAL :</th>
                                  <th><input type='hidden' class='count' value='$sr'><h3 id='test'></th>
                                  <th><input type='hidden' id='test1' name='totalp' value='' readonly></th>
                                </tr>
                                <tr>
                                  <td></td>
                                </tr>
                                <tr>
                                  <td><input type='radio' id='COD' name='Payment' value='COD' checked>
                                      <label for='COD'>Cash On Delivery</label><br>
                                      <input type='radio' id='Credit' name='Payment' value='Credit'>
                                      <label for='Credit'>CREDIT Card</label><br>
                                  </td>
                                  <td>
                                      <button name='Buy'>Purchase</button>
                                      </td>
                                </tr>
                              </table>";
          }
          ?>

        </div>
      </div>
    </div>

  </div>


</body>
<script>
  src = "https://code.jquery.com/jquery-2.2.4.min.js"
  var gt = 0;
  var oo = 0;
  var cc = 0;
  var r = 0;
  var res;
  var stId;
  const data = 'fsf';
  var test = document.getElementById('test');
  var iprice = document.getElementsByClassName('iprice');
  var iquantity = document.getElementsByClassName('iquantity');
  var count = document.getElementsByClassName('count');
  var itotal = document.getElementsByName('itotal');
  var gtotal = document.getElementById('gtotal');
  var ptotal = document.getElementById('ptotal');
  var totalp=document.getElementById('test1');

  function subTo(){
      gt=0;
      r=count[0].value;
      cc=0;
      oo=0;
      for(i=0;i<r;i++){
        cc=iprice[i].value*iquantity[i].value;
        oo=oo+cc;
    }
      test.innerText=oo;
      totalp.value=oo;

      //gt=gt+iprice[i].value*iquantity[i].value;
    }



  function subTotal() {
    gt = 0;
    for (i = 0; i < iprice.lenght; i++) {
      itotal[i].innerText = (iprice[i].value + 0) * (iquantity[i].value);

      gt = gt + (iprice[i].value) * (iquantity[i].value);
    }
    gtotal.innerText = gt;
  }

  subTo();
  subTotal();
</script>
<?php $abc = "<script>document.write(res)</script>" ?>
</script>
<?php //echo $abc ;
?>

<input type='hidden' name='TotalPrice' value'<? $abc ?> </from>

</html>
