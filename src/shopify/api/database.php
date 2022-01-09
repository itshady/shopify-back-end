<?php

$mysql_hostname = "db";
$mysql_username = "root";
$mysql_password = "password";
$mysql_database = "shopify";
$dsn = "mysql:host=".$mysql_hostname.";dbname=".$mysql_database;

$debug = false;
try
{
	$pdo= new PDO($dsn, $mysql_username,$mysql_password, array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (PDOException $e)
{
	echo 'PDO error: could not connect to DB, error: '.$e;
}
