<?php
// error_reporting(0);
$host="sql107.infinityfree.com";
$username="if0_38428644";
$db="car_rent";
$pass='r3Rg1hTA3a';
$conn = mysqli_connect("$host", "$username", "$pass", "$db");
if (!$conn) {
    echo "not";
}
