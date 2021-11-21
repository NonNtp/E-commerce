<?php
session_start();

$idnum='0';
error_reporting(~E_NOTICE);
if($_POST['Ptype']=='5'){$idnum='earring';}
elseif ($_POST['Ptype']=='4') {$idnum='necklace';}
elseif ($_POST['Ptype']=='3') {$idnum='bracelet';}
elseif ($_POST['Ptype']=='2') {$idnum='charm';}
elseif ($_POST['Ptype']=='1') {$idnum='ring'; }
else {
  $idnum='index';
}
if($_SERVER["REQUEST_METHOD"]=="POST")
{

    if(isset($_POST['addcart']))
    {

      if(isset($_SESSION['cart']))
      {
        $myitem=array_column($_SESSION['cart'],'Item_Name');
        if(in_array($_POST['Pproduct'],$myitem))
        {

          echo"<script>
          alert('Item Already Added');
          window.location.href=('$idnum.php');
          </script>";
        }

        $count=count($_SESSION['cart']);
        $_SESSION['cart'][$count]=array('Item_Name'=>$_POST['Pproduct'],'Price'=>$_POST['Pprice'],'Quantity'=>1,'Color'=>$_POST['Pcolor'],'Metal'=>$_POST['Pmetal'],'Pid'=>$_POST['Pid'],'Ptype'=>$_POST['Ptype']);


      }
      else
      {
        $_SESSION['cart'][0]=array('Item_Name'=>$_POST['Pproduct'],'Price'=>$_POST['Pprice'],'Quantity'=>1,'Color'=>$_POST['Pcolor'],'Metal'=>$_POST['Pmetal'],'Pid'=>$_POST['Pid'],'Ptype'=>$_POST['Ptype']);

          echo"<script>
          alert('Item Added');
          window.location.href=('$idnum.php');
          </script>";
      }
    }
    if(isset($_POST['removeitem']))
    {
        foreach ($_SESSION['cart'] as $key => $value)
         {
          //print_r($key);
          if($value['Item_Name']==$_POST['Item_Name'])
          {
            unset($_SESSION['cart'][$key]);
            $_SESSION['cart']==array_values($_SESSION['cart']);
            echo"<script>alert('Item Removed');
             window.location.href=('cart.php');</script>";
          }
        }
    }
    if(isset($_POST['Mod_Quantity']))
    {
      foreach ($_SESSION['cart'] as $key => $value)
      {
          if($value['Item_Name']==$_POST['Item_Name'])
          {
            $_SESSION['cart'][$key]['Quantity']=$_POST['Mod_Quantity'];
            //print_r($_SESSION['cart']);
            echo"<script>
            window.location.href=('cart.php');</script>";
          }

      }
    }
}
echo"<script>alert('Item Added');
window.location.href=('$idnum.php');</script>";
?>
