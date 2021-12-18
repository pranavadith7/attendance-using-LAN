<?php

$conn= mysqli_connect('localhost', 'root', '' , 'attendance');

if (!$conn) {
    echo "Connection failed: " . mysqli_connect_error();
}
?>