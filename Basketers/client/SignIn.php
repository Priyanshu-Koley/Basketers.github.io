<?php
session_start();
$email=$_POST['email'];
$password=$_POST['password'];
$password = md5($password);

include_once '../shared/config.php';

$cmd="select * from users where email='$email' and password='$password' limit 1";

$sql_obj=mysqli_query($conn,$cmd);

$total_rows=mysqli_num_rows($sql_obj);

if($total_rows==0)
{
    echo "
        <script>
            alert('Invalid Credentials !! ');
            window.location.replace('SignIn.html');

        </script>
            ";
}
else
{
    $row=mysqli_fetch_assoc($sql_obj);
    
    $_SESSION['id']=$row['id'];
    $_SESSION['name']=$row['name'];

    header('location:Home.php');
}



?>