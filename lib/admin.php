<?php

include './sql_init.php';

$sql =  'SELECT * FROM msg;';

$res = mysql_query($sql);

// 原生一点都不好用。。orz
// $row = mysql_result($res,2);

// var_dump($row);

?>