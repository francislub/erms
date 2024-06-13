<?php

$con = new mysqli('localhost','root','','erms');
if ( mysqli_connect_errno() ) {
    echo 'Failed to connect to MySQL: ' . mysqli_connect_error();

}  
