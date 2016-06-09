<?php
// 想办法保持连接？
include './sql_init.php';


if (isset($_POST['data'])) {
	$data = $_POST['data'];
	// var_dump($data);

	$sql ="INSERT INTO  `webim`.`msg` (
			`msg_id` ,
			`from` ,
			`text` ,
			`to` ,
			`time`
			)
			VALUES (
			NULL ,  '".$data['from']."', '".$data['msg']."',  '".$data['to']."', 
			CURRENT_TIMESTAMP
			);";
	mysql_query($sql);
	// echo mysql_error();
}
else{
	echo "no..";
}

?>