<?php

session_start();

$client_id=$_SESSION['id'];
$oid=$_GET['oid'];

    include_once '../shared/config.php';
    $cmd="delete from orders where id=$oid";
    $sql_res=mysqli_query($conn,$cmd);
    if($sql_res)
    {
        echo "
        <script>
                alert('Order Cancelled Sucessfull !! ');
                window.location.replace('Orders.php');

        </script>
        ";
    }
    else
    {
        echo "
        <script>
                alert('Error in Cancelling Order !! ');
                window.location.replace('Orders.php');

        </script>
        ";
    }

?>