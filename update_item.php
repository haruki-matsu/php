<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="responsive.css">
    <title>更新ページ</title>
</head>
<body class=display>
    <!-- ヘッダー -->
    <?php include 'header.php'; ?>

    <!-- 更新画面のセクション -->
    <h2 class="f_h2">更新画面</h2>
    <div class=f_text>

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
 array_push($err_msgs,'ラインナップを入力してください。');
 }
 if(empty( $post_servicecontents)){
 array_push($err_msgs,'サービス内容を入力してください。');
 }
 if(empty( $post_price)){
 array_push($err_msgs,'料金を入力してください。');
 }
 if(strlen($post_lineup) > 255){
 array_push($err_msgs,'ラインナップは255文字以内で入力');
 }
 if(strlen($post_servicecontents) > 255){
 array_push($err_msgs,'サービス内容は255文字以内で入力');
 }
 if(strlen($post_price) > 40){
 array_push($err_msgs,'料金が40文字以内で入力');
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


 $result = upDateFixfile(
 $post_id,
 $post_lineup,
 $post_servicecontents,
 $post_price,
 $post_save_path,
 );

 if($result){
    echo '<p>' . htmlspecialchars($post_lineup) . 'サービスの登録が完了しました。</p>';
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
    </div>
    <a href="./index.php" class=f_button>戻る</a> 

    <!--　フッター -->
    <?php include 'footer.php'; ?>
</body>
</html>