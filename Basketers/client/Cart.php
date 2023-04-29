<?php

session_start();
$client_id=$_SESSION['id'];

include 'navCart.html';
include_once '../shared/config.php';


    $cart_obj=mysqli_query($conn,"select * from cart where client_id=$client_id");
    $cart_count=0;
    while ($row=mysqli_fetch_assoc($cart_obj)) 
    {
        $qnty=$row['quantity'];
        $cart_count=$cart_count+$qnty;
    }
    if($cart_count>0)
        echo "<span class='stick-to-cart'>$cart_count</span>";

        $cart_obj=mysqli_query($conn,"select * from orders where client_id=$client_id and is_deliver=0");
        $order_count=0;
        while ($row=mysqli_fetch_assoc($cart_obj)) 
        {
            $qnty=$row['quantity'];
            $order_count=$order_count+$qnty;
        }
        if($order_count>0)
            echo "<span class='stick-to-order'>$order_count</span>";

    $cmd="select * from cart where client_id=$client_id";
    $sql_res=mysqli_query($conn,$cmd);


	$count_quantity = mysqli_num_rows($sql_res);
	if($count_quantity < 1)
    {
        echo "  <div>
                    <h2 class='bg-warning p-5 text-center m-0'>
                        Your CART is empty !! 
                    </h2>
                    <h3 class='bg-warning p-5 text-center m-0'>
                        Add more items to Check-Out
                    </h3>
                <div>
        
        
        ";
    }
    else
    {
        $total=0;
        echo "
                <h2 class='heading'>Shopping Cart</h2>
                
        ";

        while($row=mysqli_fetch_assoc($sql_res)) 
        {
            
            $pid=$row['pdt_id'];
            $qnty=$row['quantity'];
            $cmd="select * from products where id=$pid";
            $sql_obj=mysqli_query($conn,$cmd);

            $cmd0="select id from products where id=$pid";
            $sql_obj0=mysqli_query($conn,$cmd0);
            if(mysqli_fetch_assoc($sql_obj0))
            {
                while($row1=mysqli_fetch_assoc($sql_obj)) 
                {
                    
                        $name=$row1['name'];
                        $price=$row1['price'];
                        $imgpath=$row1['imgpath'];
                        $details=$row1['details'];
                        $catagory=$row1['catagory'];
        
                        $total=$total+($price*$qnty);

                        echo "
                                
                        <div class='row  ms-5'>

                            <div id='img' class='col-3 text-center justify-content-center'>

                                <img class=' ' id='imgpdt' src='$imgpath' alt='Image not available'>
                            
                            </div>

                            <div class='col-4'>
                            
                                <label for='name' class='m-2 mt-0'><h4>$name</h4></label>
                                <br>
                                <small style='color:green; margin-left:8px;'>In Stock</small>
                                <div class=''>
                                    <span id='qtyspan'>Qty:</span>
                                    <div class='qnty'>
                                    
                                        <div class='formqty'>
                                            <form action='ChQnty.php' method='post' style=' display:inline!important;' >
                                                <select name='quantity' id='quantity' class='text-center' name='quantity' style='' onchange='this.form.submit()';>
                                                    <option value='$qnty' selected disabled >$qnty</option>
                                                    <option value='1'>1</option>
                                                    <option value='2'>2</option>
                                                    <option value='3'>3</option>
                                                    <option value='4'>4</option>
                                                    <option value='5'>5</option>
                                                    <option value='6'>6</option>
                                                    <option value='7'>7</option>
                                                    <option value='8'>8</option>
                                                    <option value='9'>9</option>
                                                    <option value='10'>10</option>
                                                </select>
                                                <input type='hidden' id='pid' name='pid' value='$pid'>
                                                <input type='hidden' id='price' name='price' value='$price'>
                                            </form>
                                        </div>
                                    </div>
                                    <div class='delete'>
                                        <a href='DeleteCart.php?pid=$pid'>
                                            <button id='' class='btn-delete '   type='submit'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>
                                                <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/>
                                                <path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/>
                                            </svg>    
                                            Remove
                                            </button>
                                        </a>

                                    </div>
                                </div>
                                                
                            
                            </div>

                            <div id='edit' class='col-2 text-center  justify-content-center'>


                            <label for='price' id='price' class='m-2'>&#8377 ", number_format($price, 2),"</label>
                            
                            </div>
                            <div class='col-3 total '>
                                <h2 class='totalhead'>Total($cart_count items): </h2>
                                <label for='total' id='total' class='totalcost' style='color:#003366; font-size:30px; margin-top:10px; font-weight:bold; '>&#8377 ", number_format($total, 2),"</label>
                                <small class='d-block' style='color:green; margin-left:10px; margin-top:10px; margin-bottom:20px;'> 
                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check-circle-fill' viewBox='0 0 16 16'>
                                <path d='M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z'/>
                                </svg>
                                    Your Order is eligible for FREE Delivery.               
                                </small>   
                                <lable style='margin-left:10px; margin-top:20px;'>
                                    Payment Method :
                                </lable>            
                                <select name='payment_mode' class='form-control' style='margin-left:25px; margin-top:10px; width:65%;'>
                                    <option value='COD'>Cash On Delivery(COD)</option>
                                </select>
                                <a href='BuyCart.php'>
                                    <button type='submit' class='btn-buy' id='buy' style='' >
                                        Place Order
                                    </button>
                                </a> 
                                </div>

                        </div>
                        
                        ";
                        echo "
                        <div id='hr'>
                        <div id='' class='hr'></div>
                        </div>
                        ";
                    
                }
            }
                    else
                    {
                        $string = ' An Item of your cart is not Available !! \n Please check another products \n Sorry for inconvenience';
                        echo "<script>alert(\"$string\")
                        window.location.replace('Cart.php');
                        </script>";
                        $cmd1="delete from cart where pdt_id=$pid";
                        $sql_res1=mysqli_query($conn,$cmd1);
                    }
            


        }
    }

    ?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basketers | Cart</title>
    <style>
        
            #price
            {
                color:#232f3e;
                font-weight:bold;
                font-size: 20px;;
            }   
            .btn-delete{
                background-color:white;
                border:none;
                border-radius:17px;
                width:30%;
                height:45px;
                margin-bottom:0px;
                margin-top:0px;
                box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
            }
                   
            
            .hr{
                border-bottom: 1px solid #232f3e;
                margin-top:10px;
                margin-bottom:10px;
                
            }
            #hr{
                width: 65%;
                margin-left:45px;
            }
            #imgpdt
            {
                width:100%;
                height:95%;
                padding:0.5px;

            }

            #img
            {
                width:125px;
                height:130px;
                background-color: white;
                padding:0px;
                margin-left:0px;
                margin-right:30px;
            }
            .heading{
                margin:50px;
            }
            .btn-delete:hover{
                background-color:#f25555;
                box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.3);

            }
            #buy:hover{
                background-color:#ee9a1d;
                box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.3);
            }

            #buy{
                background-color:#ffa41c;
                border:none;
                border-radius:17px;
                width:50%;
                height:45px;
                margin-top:40px;
                margin-bottom:20px;
                margin-left:none;
                box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
            }

            .stick-to-cart
            {
                position:fixed;
                left:56.5vw;
                top:1%;
                z-index:10;
                padding-left:5px;
                padding-right:7px;
                padding-top:1px;
                padding-bottom:1px;
                background-color:coral;
                border-radius:50%; 
                color:white;              
            }
            .stick-to-order
            {
                position:fixed;
                left:73.9vw;
                top:1%;
                z-index:10;
                padding-left:5px;
                padding-right:7px;
                padding-top:1px;
                padding-bottom:1px;
                background-color:coral;
                border-radius:50%; 
                color:white;              
            }
            .total{
                border-left: 5px solid #232f3e;
                border-bottom: 5px solid #232f3e;
                border:none;
                position:fixed;
                top:0px;
                right:0%;
                height:66vh;
                background-color:#dee3e3;
                overflow:auto;
                border-bottom-left-radius: 25px;
                border-top-left-radius: 25px;
                box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
                margin-top:10%;
                padding:20px;
            }
            .qnty{
                display:inline;
                width:50px;
                
            }
            #quantity{
                width:20%;
                height:40px;
                border: 1px solid white;
                border-radius:17px;
                background-color:white;
                margin-top:2px;
                box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
            }
            #quantity:hover{
                background-color:#e4e5eb;
                box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.3);

            }
            .delete{
                display:inline;
            }
            #qtyspan{
                margin:5px;
                padding:5px;
            }
            .formqty{
                display:inline;
                width:50px;
                margin:0px;
                padding:0px;
            }
            .totalhead{
                margin-top:40px;
                margin-left:10px;
            }
            .totalcost{
                margin-left:10px;
                
            }
    </style>
</head>
<body style="margin-top:90px; overflow-x:hidden;">
    
</body>
</html>



<!-- <div class='deletedcart' id='delete$pid' >
                            <small>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check2-circle' viewBox='0 0 16 16'>
                                <path d='M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z'/>
                                <path d='M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z'/>
                            </svg>
                                Deleted from Cart </small>
                        </div> -->