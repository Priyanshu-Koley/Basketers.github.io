<?php

$conn = new mysqli('localhost','root','','basketers');
if($conn->connect_error)
{
    echo '<h1>Connection Error</h1>';
    die;
}

?>