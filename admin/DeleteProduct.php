<?php

include_once '../shared/config.php';

    $id=$_GET['id'];
    $imgpath=$_GET['imgpath'];
    if(unlink("$imgpath"))
    {
        $cmd="delete from products where id=$id";
        $sql_obj=mysqli_query($conn,$cmd);
        header('Location: ViewProducts.php');
    }
    else
    {
        echo "
        <script>
            alert('Failed to Delete Product !!');
        </script>
        ";
    }
    ?>