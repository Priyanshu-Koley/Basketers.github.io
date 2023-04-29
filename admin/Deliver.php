<?php

//session_start();
$oid=$_GET['order_id'];

include_once "../shared/config.php";

$cmd="update orders set is_deliver = 1 where id=$oid";



$res=mysqli_query($conn,$cmd);
if($res)
{
    echo "
        <script>
            alert('Sucessfully Status is set to Delivered !!');
            window.location.replace('Orders.php');
        </script>
    ";
}
else
{
    echo "
        <script>
            alert('Error in setting status to Delivered !!');
            window.location.replace('Orders.php');
        </script>
    ";
}



?>