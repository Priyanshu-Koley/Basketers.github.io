<?php

if(!isset($_SESSION['id']))
session_start();

echo "
        <nav style='width:100vw; height:3rem; background-color:#232f3e; color:white;  position:fixed; padding-top:10px;


        '>
            <a href='ProductUpload.html' class='active nav-btn' id='upload' >ADD Product</a>
            <a href='ViewProducts.php' class='nav-btn' id='view'>Products</a>
            <a href='Orders.php' class='nav-btn' id='orders' style='margin-left:100px';>Orders</a>
        </nav>
        <div style='height:95px; display:block;'> . </div>

    ";

include_once '../shared/config.php';


    $cart_obj=mysqli_query($conn,"select * from orders where is_deliver=0");
    $order_count=0;
    while ($row=mysqli_fetch_assoc($cart_obj)) 
    {
        $qnty=$row['quantity'];
        $order_count=$order_count+$qnty;
    }
    if($order_count>0)
        echo "<span class='stick-to-order'>$order_count</span>";
    

    $cmd="select * from orders ";
    $sql_res=mysqli_query($conn,$cmd);


	$count_quantity = mysqli_num_rows($sql_res);
	if($count_quantity < 1)
    {
        echo "  <div>
                    <h2 class='bg-warning p-5 text-center m-0'>
                        You had not given any ORDERS !! 
                    </h2>
                    <h3 class='bg-warning p-5 text-center m-0'>
                        Add more items and Check-Out
                    </h3>
                <div>
        
        
        ";
    }
    else
    {
        $total=0;
        echo "
                <h2 class='heading'>Orders</h2>
                
        ";

        while($row=mysqli_fetch_assoc($sql_res)) 
        {
            
            $id=$row['id'];
            $cid=$row['client_id'];
            $pid=$row['pdt_id'];
            $qnty=$row['quantity'];
            $date=$row['order_date'];
            $is_deliver=$row['is_deliver'];
            $cmd="select * from products where id=$pid";
            $sql_obj=mysqli_query($conn,$cmd);

                        if($is_deliver==1)
                        {
                            echo "
                                <style>
                                    #d1$id{
                                        display:inline;
                                        text-decoration:underline;
                                        text-decoration-color:#61d461;
                                    }
                                    #d2$id{
                                        display:none;
                                        text-decoration:underline;
                                        text-decoration-color:#f25555;
                                        
                                    }
                                    </style>
                                    ";
                                }
                                else
                                {
                                    echo "
                                    <style>
                                    #d2$id{
                                        display:inline;
                                        text-decoration:underline;
                                        text-decoration-color:#f25555;
                                    }
                                    #d1$id{
                                        display:none;
                                        text-decoration:underline;
                                        text-decoration-color:#61d461;
                                    }
                                    </style>
                            ";
                        }

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

                        $amt=$price*$qnty;
                        

                        echo "
                                
                        <div class='row  ms-5'>

                            <div id='img' class='col-3 text-center justify-content-center'>

                                <img class=' ' id='imgpdt' src='$imgpath' alt='Image not available'>
                            
                            </div>

                            <div class='col-6' >
                            
                                <label for='name' class='m-2 mt-0'><h4>$name</h4></label>
                                <br>
                                
                                <div style='margin-left:10px;'>
                                    <div>
                                        <span id=''>Customer ID : $cid</span>
                                        
                                    </div>  
                                    <div>
                                        <span id=''>Order ID : #$id</span>
                                        <span id='' style='margin-left:25px;'>Quantity : $qnty</span>
                                        
                                    </div>  
                                    <span id=''>Order Date : $date</span>              
                                </div>
                                               
                            
                            </div>

                            <div id='edit' class='col-4  justify-content-center'>


                            <label for='price' id='price' class='m-2'>&#8377 ", number_format($price, 2)," x $qnty  </label>
                            <label for='price' id='price' class='m-2'>Total : &#8377 $amt  </label>

                            <div class='deliver' >
                                <a aria-disabled='true''>
                                    <button id='d1$id' class='btn-deliver d1 btndel'   type='submit' disabled title='Order has been Delivered !'>
                                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check-circle-fill' viewBox='0 0 16 16'>
                                    <path d='M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z'/>
                                    </svg>    
                                        Delivered
                                    </button>
                                </a>

                            </div>
                            <div class='deliver' >
                                <a href='Deliver.php?order_id=$id'>
                                    <button id='d2$id' class='btn-deliver d2'   type='submit' style='background-color:#f25555;' onclick='' title='Order is not Delivered&#013;Click to set Delivered'>
                                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-x-circle-fill' viewBox='0 0 16 16'>
                                        <path d='M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z'/>
                                    </svg>   
                                        Not Delivered
                                    </button>
                                </a>

                            </div>
                            
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
                        $string = ' An Item of your Order list is not Available from You!! \n Please Solve the issue \nBe Sorry for inconvenience';
                        echo "<script>alert(\"$string\")
                        window.location.replace('Cart.php');
                        </script>";
                        $cmd1="delete from orders where pdt_id=$pid";
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
    <title>Basketers | Orders</title>
    <link rel='stylesheet' href='../bootstrap.css'>
    <script>
        function display()
        {
           
            document.getElementById("d1").style.display="inline";
            document.getElementById("d2").style.display="none'";
        }
    </script>
    <style>

            .btndel:disabled{
                background-color:#61d461;
                color:black;
            }
        
            #price
            {
                color:#232f3e;
                font-weight:bold;
                font-size: 20px;;
            }   
            .btn-deliver{
                background-color:#61d461;
                border:none;
                border-radius:17px;
                width:40%;
                height:45px;
                margin-bottom:0px;
                margin-top:20px;
                margin-left:40px;
                box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
            }

            
            
            .hr{
                border-bottom: 1px solid #232f3e;
                margin-top:10px;
                margin-bottom:10px;
                
            }
            #hr{
                width: 90%;
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
                margin-top:0px;
            }
            .d1:hover{
                background-color:#4da84d;
                box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.3);
                text-decoration:underline;
                text-decoration-color:#4da84d !important;
                
                
            }
            .d2:hover{
                background-color:#bf3434 !important;
                box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.3);
                text-decoration:underline;
                text-decoration-color:#bf3434 !important;
                
                
            }
            #d1{

            }
            #d2{
                
            }
            .stick-to-order
            {
                position:fixed;
                left:37.6vw;
                top:1%;
                z-index:10;
                padding-left:4px;
                padding-right:6px;
                padding-top:0px;
                padding-bottom:0px;
                background-color:coral;
                border-radius:50%; 
                color:white;  
                font-size:13px;            
            }
            .total{
                border-left: 5px solid #232f3e;
                border-bottom: 5px solid #232f3e;
                border:none;
                position:fixed;
                top:9%;
                right:0%;
                height:66vh;
                background-color:#dee3e3;
                overflow:auto;
                border-bottom-left-radius: 25px;
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
            .deliver{
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

            #price
        {
            color:rgb(177,39,5);
            font-weight:bold;
            font-size: 20px;;
        }
        a{
            margin:3rem;
        }

        .nav-btn{
            color:rgb(195,202,206);
            text-decoration:none;
        }
        a:visited{
            color:#e7e9eb;
            text-decoration:none;
        } 
        #view{
          margin-right: 0%;
        }
        #delete{
            margin-bottom:15px;
        }
        .nav-btn:hover{
            color:white;

        }
        #orders{
            border-bottom: 4px solid #3589fd;
        }
        .nav-btn{
          margin-bottom:0px;
          padding-bottom: 9px;
          padding-left: 5px;
          padding-right: 6px;
        }
    </style>
</head>
<body style="overflow-x:hidden;">
    
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

                        <!-- <div class='col-3 total'>
                                <p>Total </p>
                                <label for='total' id='total' class=''>&#8377 ", number_format($total, 2),"</label>
                            </div> -->