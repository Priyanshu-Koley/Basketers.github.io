<?php
include_once '../shared/config.php';


$pid=$_GET['pid'];
$amt=$_GET['price'];
session_start();
$client_id=$_SESSION['id'];

    



include 'Home.php';

    $qnty=1;
    $cmd = "SELECT id FROM cart WHERE pdt_id = '$pid' and client_id = '$client_id' LIMIT 1" ;
	$check_query = mysqli_query($conn,$cmd);
	$count_quantity = mysqli_num_rows($check_query);
	
    if($count_quantity > 0)
    {
        $cmd="UPDATE cart SET quantity = quantity + 1 where pdt_id=$pid and client_id = '$client_id'";
        $sql_res = mysqli_query($conn,$cmd);
        $cmd="UPDATE cart SET price = price + price where pdt_id=$pid and client_id = '$client_id'";
        $sql_res = mysqli_query($conn,$cmd);
    }
    else
    {
        $cmd="insert into cart(client_id,pdt_id,quantity,price) values($client_id,$pid,$qnty,($amt*$qnty))";
        $sql_res=mysqli_query($conn,$cmd);
    }

    

    if($sql_res)
    {
        $cart_obj=mysqli_query($conn,"select * from cart where client_id=$client_id");
        $cart_count=0;
        while ($row=mysqli_fetch_assoc($cart_obj)) 
        {
            $qnty=$row['quantity'];
            $cart_count=$cart_count+$qnty;
        }
        
        echo "<span class='stick-to-cart'>$cart_count</span>";
        
        echo "
        <script>
            
            document.getElementById('add$pid').style.display='inline';
            
            setTimeout(function() {
                document.getElementById('add$pid').style.display='none';
                window.location.replace('Cart.php');
                }, 2500);
                
        </script>
        ";
    }
    else
    {
        echo "
        <script>
                alert('Error in Add To Cart !! ');
                window.location.replace('Home.php');

        </script>
        ";
    }

?>