<?php
require_once "./dbc.php";
$lineup = filter_input(INPUT_POST,'line_up',FILTER_SANITIZE_SPECIAL_CHARS);
$servicecontents=filter_input(INPUT_POST,'service_contents',FILTER_SANITIZE_SPECIAL_CHARS);
$price= filter_input(INPUT_POST,'price',FILTER_SANITIZE_SPECIAL_CHARS);
$files = $_FILES['up_img'];
$filename = basename($files['name']);
$tmp_path = $files['tmp_name'];
$file_err = $files['error'];
$filesize = $files['size'];
$upload_dir = './up-images/';
$err_msgs = array();
$save_path = $upload_dir.$filename; 
?>


<!DOCTYPE html>
<html lang="jp">
<?php include 'header.php'; ?>
<body class=display>
    <h2 class=f_h2>登録画面</h2>

<div class=f_text>

<?php
if(empty($lineup)){
 array_push($err_msgs,'ラインナップを入力してください。');
}
if(empty($servicecontents)){
 array_push($err_msgs,'サービス内容を入力してください。');
}
if(empty($price)){
 array_push($err_msgs,'金額を入力してください。');
}
if(strlen($lineup) > 40){
 array_push($err_msgs,'40 文字以内で入力');
}
if(strlen($servicecontents) > 255){
 array_push($err_msgs,'255 文字以内で入力');
}
if(strlen($price) > 10){
 array_push($err_msgs,'10 文字以内で入力');
}
if($filesize > 1048576 || $file_err == 5){
 array_push($err_msgs,'ファイルサイズを 5MB 以下にすること');
}
$allow_ext = array('jpg','jpeg','png');
$file_ext = pathinfo($filename,PATHINFO_EXTENSION);
if(!in_array(strtolower($file_ext),$allow_ext)){
 array_push($err_msgs,'画像ファイルを添付してください。');
}
if(count($err_msgs)===0){
if (is_uploaded_file($tmp_path)){
 if(move_uploaded_file($tmp_path,$save_path)){
 $result = fileSave(
 $lineup,
 $servicecontents,
 $price,
 $save_path,
 );
 if ($result) {
    echo '<p>' . htmlspecialchars($lineup) . 'サービスの更新が完了しました。</p>';
} else {
    echo '<p>データの格納が失敗しました。</p>';
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
</div>

<a href="./manage.php" class=f_button>管理画面に戻る</a> 

<!--　フッター -->
<?php include 'footer.php'; ?>

</body>
</html>