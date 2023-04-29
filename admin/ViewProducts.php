<?php

include_once '../shared/config.php';

$sql_obj=mysqli_query($conn,'select * from products');



echo "
        <nav style='width:100vw; height:3rem; background-color:#232f3e; color:white;  position:fixed; padding-top:10px;


        '>
            <a href='ProductUpload.html' class='active nav-btn' id='upload' >ADD Product</a>
            <a href='ViewProducts.php' class='nav-btn' id='view'>Products</a>
            <a href='Orders.php' class='nav-btn' id='orders' style='margin-left:100px';>Orders</a>
        </nav>
        <div style='height:95px; display:block;'> . </div>

    ";

    $cart_obj=mysqli_query($conn,"select * from orders where is_deliver=0");
    $order_count=0;
    while ($row=mysqli_fetch_assoc($cart_obj)) 
    {
        $qnty=$row['quantity'];
        $order_count=$order_count+$qnty;
    }
    if($order_count>0)
        echo "<span class='stick-to-order'>$order_count</span>";

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
        
        <label for='name' class='m-2'><h4>$name [#$id]</h4></label>
        <br>
        <label for='price' id='price' class='m-2'>&#8377 ", number_format($price, 2),"</label>
        <br>
        <label for='details' id='details' class='m-2'>$details</label>
        <br><br>
        <small for='catagory' id='catagory' class='m-2'>in $catagory</small>
        
        </div>

        <div id='edit' class='col-4 text-center justify-content-center'>


        <div class=''>

        <div class=''>
           
        <a href='DeleteProduct.php?id=$id&imgpath=$imgpath'>
                <button id='delete' class='btn btn-danger '   type='submit'>
                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>
                        <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/>
                        <path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/>
                    </svg>
                    Delete Product
                </button>
            </a>

        </div>

            

        </div>

        <div class=''>

        

            
                <button type='submit' class='btn btn-primary' aria-label='Left Align' id='edit'>
                
                    <span class='glyphicon'>&#x270f;&nbsp&nbsp</span>
                    Edit Product
                </button>

        </div>
        
        </div>

    </div>
    <div id='hr'></div>

    ";

       
}

    
?>








<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Basketers | View Products</title>

    <link rel='stylesheet' href='../bootstrap.css'>
    

    <style>
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

        #price
        {
            color:rgb(177,39,5);
            font-weight:bold;
            font-size: 20px;;
        }
        body{
            margin:0px;
            width:100%;
            overflow-x:hidden;
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
        #view{
            border-bottom: 4px solid #3589fd;
        }
        .nav-btn{
          margin-bottom:0px;
          padding-bottom: 9px;
          padding-left: 5px;
          padding-right: 6px;
        }
        #hr{
            border-bottom: 5px solid #232f3e;
            margin-top:30px;
            margin-bottom:30px;
            margin-right:none;
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

    </style>
</head>
    
<body>

</body>
</html>




