<?php
 //connect to database
    $conn = mysqli_connect('localhost', 'your_username', 'your_password', 'postsdb');
    //check connection
    if(!$conn){
        echo 'Connection error : ' . mysqli_connect_error();
    }
?>
