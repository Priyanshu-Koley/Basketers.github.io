<?php

include_once '../shared/config.php';

session_start();

$cid=$_SESSION['id'];
$pid=$_GET['pid'];
$amt=$_GET['amt'];


//$qnty=mysqli_query($conn,"select quantity from cart where client_id=$cid and pdt_id=$pid");
$qnty=1;
date_default_timezone_set('Asia/Kolkata');
$cur_date=date('jS F , Y \a\t h:i A');
$cmd="insert into orders(client_id,pdt_id,quantity,amount,order_date) values('$cid','$pid','$qnty','$amt','$cur_date')";
$sql_result = mysqli_query($conn,$cmd);
//$cmd="delete from cart where client_id=$cid and pdt_id=$pid";
//$sql_result = mysqli_query($conn,$cmd);



if($sql_result)
{
    //echo "Order Placed Successfully!!";
    //echo "<a href='order.php'>Go to Orders</a>";
    
    $string = ' Order Placed Successfully!! \n';
    echo "<script>alert(\"$string\")
    window.location.replace('Orders.php');
    </script>
    ";
}
else
{
    $string = " Couldn't Place Order due to some reasons \n Please Try-Again Later. ";
    echo "<script>alert(\"$string\")
    window.location.replace('Home.php');
    </script>";
}

?>