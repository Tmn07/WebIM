<?php
// 想办法保持连接？
header("Content-type: text/html;charset=utf-8");
include './sql_init.php';


if (isset($_POST['data'])) {
	$data = $_POST['data'];

	$sql ="INSERT INTO  `webim`.`msg` (
			`msg_id` ,
			`from` ,
			`text` ,
			`to` ,
			`time`
			)
			VALUES (
			NULL ,  '".$data['from']."', '".iconv('utf-8', 'gbk', $data['msg'])."',  '".$data['to']."', 
			CURRENT_TIMESTAMP
			);";
	// echo($sql);
	mysql_query($sql);
	// echo mysql_error();
}
else{
	echo "no..";
}

?>