<?php

include('config.php');

$id = $_GET['id'];

$query = "DELETE FROM users WHERE id = $id";

if($conn->query($query)){
    header("location: index.php");
}else{
    echo "Data failed to delete";
}

?>