<?php
$username = 'root';
$userpass = 'root';
$dbhost = 'localhost';
$dbdatabase = 'che';

$dsn = "mysql:host=$dbhost;dbname=$dbdatabase";
$db = new PDO($dsn, $username, $userpass);
$db->query("set names utf8");