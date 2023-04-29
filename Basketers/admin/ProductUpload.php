<?php

include_once '../shared/config.php';

$name = $_POST['name'];
$price = $_POST['price'];
$detail = $_POST['detail'];
$catagory = $_POST['catagory'];

$imgobj = $_FILES['img'];


date_default_timezone_set('Asia/Kolkata');
$milisec = round(microtime(true) * 1000);
$uniqueName=date("Y_m_d_H_i_s_$milisec");

$path = "../images/$uniqueName.jpg";

move_uploaded_file($imgobj['tmp_name'],$path);


/* $cmd="select * from products where name='$name' and price='$price' and catagory='$catagory' ";

$query = $conn->prepare($cmd);
$user_array = $query ->execute();

$sql_result = mysqli_query($conn,$cmd);

if (!$sql_result) {
    echo 'Could not run query: ' . mysql_error();
    exit;
  }
  

if ( count('$user_array') >0) {
    echo "Product Already Uploaded Earlier !!";
    print_r ($user_array);
    die;
} */

$cmd="insert into products(name,price,details,imgpath,catagory) values('$name','$price','$detail','$path','$catagory')";

$sql_result = mysqli_query($conn,$cmd);

if ($sql_result) {
    echo "
    <script>
        alert('Product Uploaded Sucessfully !!');
        window.location.replace('ViewProducts.php');
    </script>
    
    ";
}
else {

    echo "
    <script>
        alert('Product Upload Failed !! Please Check Query');
        window.location.replace('ProductUpload.html');
    </script>
    
    ";

}


?>