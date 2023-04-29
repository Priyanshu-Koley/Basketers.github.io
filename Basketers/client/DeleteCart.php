<?php

session_start();

$client_id=$_SESSION['id'];
$pid=$_GET['pid'];

include_once '../shared/config.php';
//include 'Cart.php';
$cmd="delete from cart where client_id=$client_id and pdt_id=$pid";
$sql_res=mysqli_query($conn,$cmd);
if($sql_res)
{
    echo "
    <script>
            alert('One Item has been Deleted !! ');
            window.location.replace('Cart.php');

    </script>
    ";
}
else
{
    echo "
    <script>
            alert('Error in Deleting Cart items !! ');
            window.location.replace('Cart.php');

    </script>
    ";
}

?>