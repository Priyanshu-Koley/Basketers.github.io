<?php
include_once '../shared/config.php';

session_start();

$qnty=$_POST['quantity'];
$pid=$_POST['pid'];
$price=$_POST['price'];
$cid=$_SESSION['id'];
$new_price=$price*$qnty;

$cmd="update cart set quantity=$qnty where client_id=$cid and pdt_id=$pid";
$sql_res=mysqli_query($conn,$cmd);
$cmd="update cart set price=$new_price where client_id=$cid and pdt_id=$pid";
$sql_res=mysqli_query($conn,$cmd);
echo "

<script>
window.location.replace('Cart.php');
</script>
";


?>