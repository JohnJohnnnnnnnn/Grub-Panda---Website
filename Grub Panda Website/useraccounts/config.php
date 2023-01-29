<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "db_useraccounts";

if(!$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname)){
	die("failed to connect");
}