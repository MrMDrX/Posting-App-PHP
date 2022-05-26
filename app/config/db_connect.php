<?php
 //connect to database
    $conn = mysqli_connect('localhost', 'med', 'med', 'postsdb');
    //check connection
    if(!$conn){
        echo 'Connection error : ' . mysqli_connect_error();
    }
?>