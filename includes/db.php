<?php
$host = 'localhost';
$db   = 'travel_mate';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$mysqli = new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_errno) {
	die('Failed to connect to MySQL: ' . $mysqli->connect_error);
}

$mysqli->set_charset($charset);
?>
