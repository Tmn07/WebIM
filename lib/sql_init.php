<?php
// 想办法保持连接？
$hostname = "localhost";
$dbuser = "root";
$dbpass = "root";
$dbname = 'webim';
$link = mysql_connect($hostname, $dbuser, $dbpass);

mysql_select_db($dbname, $link);
?>