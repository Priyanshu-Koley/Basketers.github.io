<?php

    if(!isset($_SESSION['id']))
    {
        session_start();
    } 
    if(!isset($_SESSION['id']))
    {

        echo "

        <!DOCTYPE html>
            <html lang='en'>
            <head>
            <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC' crossorigin='anonymous'>
            <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js' integrity='sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM' crossorigin='anonymous'></script>   
            <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css'>
            
            <style>
                h2{
                    font-size:50px;
                    margin-bottom:100px;
                }
                #mess{
                        text-decoration:none;
                        color:white;
                        
                }
            </style>
            </head>
            <body class='bg-danger'>

                <div class='text-center'>    
                    <h2 >Unauthorized Access</h2>
                    <button class='btn btn-primary' style='padding:10px;' ><a id='mess' href='SignIn.html'>Login First </a></button>
                <div>
            </body>
            </html>

            ";

        die;
    }

    include 'navHome.html';
    
    $client_name=$_SESSION['name'];

    echo "
        
        <div id='welcomeMess'>
        <h6 id='welcome' class='welcome' >Hello,</h6>
        <h3 id='welcome-name' class='welcome'>$client_name</h3>
        </div>
        <div id='space'>
        </div>

        ";

    include_once '../shared/config.php';

    $client_id=$_SESSION['id'];
    
    
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
    
    
    
    $sql_obj=mysqli_query($conn,'select * from products');
    
    while ($row=mysqli_fetch_assoc($sql_obj)) 
    {
        $name=$row['name'];
        $price=$row['price'];
        $imgpath=$row['imgpath'];
        $details=$row['details'];
        $catagory=$row['catagory'];
        $id=$row['id'];

        echo "
                
        <div class='row  ms-5'>

            <div id='img' class='col-4 text-center justify-content-center'>

            <img class=' ' id='imgpdt' src='$imgpath' alt='Image not available'>
            
            </div>

            <div class='col-4'>
            
            <label for='name' class='m-2'><h4>$name</h4></label>
            <br>
            <label for='price' id='price' class='m-2'>&#8377 ", number_format($price, 2),"</label>
            <br>
            <label for='details' id='details' class='m-2'>$details</label>
            <br><br><br><br>
            <small for='catagory' id='catagory' class='m-2'>in $catagory</small>
            
            </div>
            <div class='col-1'>
            </div>

            <div id='edit' class='col-4 text-center  justify-content-center'>


            <div class=''>
            
            <a href='AddToCart.php?pid=$id&price=$price'>
                    <button id='cart' class='btn-cart '   type='submit'>
                        Add to Cart
                    </button>
                </a>

            </div>

            <div class='addedcart' id='add$id' >
                <small>
                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check2-circle' viewBox='0 0 16 16'>
                    <path d='M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z'/>
                    <path d='M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z'/>
                </svg>
                    Added to cart </small>
            </div>

            <div class=''>
            <a href='Buy.php?pid=$id&amt=$price'>
                    <button type='submit' class='btn-buy' aria-label='Left Align' id='buy'>                        
                        Buy Now
                    </button>
                </a>

            </div>
            
            </div>
            <div class=''>
                
            </div>

        </div>
        <div id='hr'></div>

        ";

       
    }

?>

<html>
    <head>
        

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Basketers | Home</title>

    <link rel="stylesheet" href="../bootstrap.css">
        
        <style>
            img{
                    width:100%;
            }
            .product
            {
                border-left:4px solid red;
            }
            #price
            {
                color:rgb(177,39,5);
                font-weight:bold;
                font-size: 20px;;
            }   
            .details p
            {
                margin-top:30px;
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
            #welcome{
                
                margin-top:5rem;
                margin-bottom:5px;
            }
            #welcome-name{
               
            }
            .welcome{
                color:white;;
                margin-left:2rem;
                
            }

            .btn-cart{
                background-color:#ffd814;
                border:none;
                border-radius:17px;
                width:80%;
                height:45px;
                margin-bottom:20px;
                margin-top:40px;
                box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
            }
            .btn-buy{
                background-color:#ffa41c;
                border:none;
                border-radius:17px;
                width:80%;
                height:45px;
                margin-top:20px;
                margin-bottom:20px;
                box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
            }
            
            #hr{
                border-bottom: 5px solid #232f3e;
                margin-top:30px;
                margin-bottom:30px;
                margin-right:none;
                width:100%:
            }
            #imgpdt
            {
                width:80%;
                height:80%;
                margin:10px;
                padding:0px;

            }

            #img
            {
                width:217px;
                height:225px;
                background-color: #f8f8f8;
                padding:0px;
                margin-left:0px;
                margin-right:20px;
            }
            #welcomeMess{
                background-color: #131921;
                margin-top:0px;
                padding:15px;
                width:100vw;
                                
            }
            #space{
                height:100px;
                background-color:white;
            }
            .btn-cart:hover{
                background-color:#e9c511;
                box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.3);

            }
            .btn-buy:hover{
                background-color:#ee9a1d;
                box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.3);
            }
            .addedcart{
                color:#ed7d1a;
                font-weight:bold;
                display:none;
                margin:10px;
                margin-left:2vw;
                
            }
        </style>

    </head>
</html>

