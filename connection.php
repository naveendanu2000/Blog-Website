<?php
    $host = 'localhost';
    $user = 'php_basic_course';
    $pass = 'php_basic_course';
    $db = 'blog_website';

    $conn = mysqli_connect($host,$user,$pass,$db);

    if(!isset($conn)){
        die("Could not establish connection successfully!" . mysqli_connect_error());
    }
?>