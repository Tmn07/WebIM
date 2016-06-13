<?php
header("Content-type: text/html;charset=utf-8");
include './sql_init.php';

$data = $_POST['data'];
// $data['from'] = 'admin';
// $data['to'] = 'admin0';

$sql1 ="SELECT * FROM  `msg` 
		WHERE  (`from` =  '".$data['from']."'
		AND  `to` =  '".$data['to']."') OR ( `from` =  '".$data['to']."'
		AND  `to` =  '".$data['from']."') ;";

/*
    字符串GBK转码为UTF-8，数字转换为数字。
*/
function ct2($s){
    if(is_numeric($s)) {
        return intval($s);
    } else {
        return iconv("GBK","UTF-8",$s);
    }
}
/*
    批量处理gbk->utf-8
*/
function icon_to_utf8($s) {
  if(is_array($s)) {
    foreach($s as $key => $val) {
      $s[$key] = icon_to_utf8($val);
    }
  } else {
      $s = ct2($s);
  }
  return $s;
}

$emp_info = array();

$res1 = mysql_query($sql1);
while($row = mysql_fetch_assoc($res1)){

    $emp_info[] = icon_to_utf8($row);
}

echo json_encode($emp_info);

?>