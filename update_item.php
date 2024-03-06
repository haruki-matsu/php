<?php
 require_once "./dbc.php";

 $post_id = $_POST['id'];
 $post_lineup = $_POST['line_up'];
 $post_servicecontents = $_POST['service_content'];
 $post_price = $_POST['price'];
 $files = $_FILES['up_img'];
 $post_filename = basename($files['name']);
 $tmp_path = $files['tmp_name'];
 $file_err = $files['error'];
 $filesize = $files['size'];
 $upload_dir = './up-images/';
 $err_msgs = array();
 $post_save_path = $upload_dir.$post_filename;

if(empty($post_lineup)){
 array_push($err_msgs,'サービス名を入力してください。');
 }
 if(empty( $post_servicecontents)){
 array_push($err_msgs,'サービス内容を入力してください。');
 }
 if(empty( $post_price)){
 array_push($err_msgs,'サービス料金を入力してください。');
 }
 if(strlen($post_lineup) > 255){
 array_push($err_msgs,'255 文字以内で入力');
 }
 if(strlen($post_servicecontents) > 255){
 array_push($err_msgs,'255 文字以内で入力');
 }
 if(strlen($post_price) > 255){
 array_push($err_msgs,'255 文字以内で入力');
 }
 if($filesize > 1048576 || $file_err == 2){
 array_push($err_msgs,'ファイルサイズを 1MB 以下にすること');
 }
 $allow_ext = array('jpg','jpeg','png');
 $file_ext = pathinfo($post_filename,PATHINFO_EXTENSION);

 if(!in_array(strtolower($file_ext),$allow_ext)){
 array_push($err_msgs,'画像ファイルを添付してください。');
 }

 if(count($err_msgs)===0){

 if (is_uploaded_file($tmp_path)){
 if(move_uploaded_file($tmp_path,$post_save_path)){
 echo $post_filename . 'がアップロードされました。';
 echo '<br>';

 $result = upDateFixfile(
 $post_id,
 $post_lineup,
 $post_servicecontents,
 $post_price,
 $post_save_path,
 );

 if($result){
 echo 'データの格納が成功しました。';
 } else {
 echo 'データの格納が失敗しました。';
 }
 } else {
 echo ($tmp_path .'と' . $upload_dir);
 echo 'ファイルが保存できませんでした。';
 echo '<br>';
 }
 } else {
 echo 'ファイルが選択されていません。';
 echo '<br>';
 }

 } else {
 foreach ($err_msgs as $msg) {
 echo $msg;
 echo '<br>';
 }

 }
?>
<h1>更新結果</h1>
<a href="./index.php">戻る</a> 