<?php

include_once '../shared/config.php';

$name=$_POST['name'];
$email=$_POST['email'];
$password=$_POST['password'];
$password = md5($password);
$address=$_POST['adr'];
$phone=$_POST['phone'];

    $cmd = "SELECT id FROM users WHERE email = '$email' LIMIT 1" ;
	$check_query = mysqli_query($conn,$cmd);
	$count_email = mysqli_num_rows($check_query);
	if($count_email > 0)
    {
		echo "
        <script>
            alert('E-Mail ID is already Registered !! ');
            window.location.replace('SignUp.html');

        </script>
            ";
		
	}
    else
    {
        $cmd="insert into users(name,email,address,phone,password) values('$name','$email','$address','$phone','$password')";
        $sql_result = mysqli_query($conn,$cmd);
        if($sql_result)
        {
            echo "
            <script>
                alert('Sucessfully Registered !!');
                window.location.replace('SignIn.html');

            </script>

            ";
        }
    } 
    


?>