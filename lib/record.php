<?php

include './sql_init.php';

$data = $_POST['data'];
// $data['from'] = 'admin';
// $data['to'] = 'admin0';

$sql1 ="SELECT * FROM  `msg` 
		WHERE  `from` =  '".$data['from']."'
		AND  `to` =  '".$data['to']."';";

$sql2 ="SELECT * FROM  `msg` 
		WHERE  `from` =  '".$data['to']."'
		AND  `to` =  '".$data['from']."';";


$emp_info = array();

$res1 = mysql_query($sql1);
while($row = mysql_fetch_assoc($res1)){
    $emp_info[] = $row;
}

$res2 = mysql_query($sql2);
while($row = mysql_fetch_assoc($res2)){
    $emp_info[] = $row;
}

echo json_encode($emp_info);

?>