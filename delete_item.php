<?php
 require_once "./dbc.php";
 $get_id = $_GET['id'];
 $result = deletefile($get_id);
?>
<h1>削除結果</h1>
<a href="./index.php">戻る</a> 