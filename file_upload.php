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
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="responsive.css">
    <title>登録ページ</title>
</head>

<body class=display>
    <!-- ヘッダー -->
    <?php include 'header.php'; ?>

    <!-- 登録画面のセクション -->
    <h2 class=f_h2>登録画面</h2>
    <div class=f_text>

<!-- バリデーション -->
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
 array_push($err_msgs,' ラインナップは40 文字以内で入力してください');
}
if(strlen($servicecontents) > 255){
 array_push($err_msgs,'サービス内容は255 文字以内で入力してください');
}
if(strlen($price) > 40){
 array_push($err_msgs,'料金は40文字以内で入力');
}
if($filesize > 1048576 || $file_err == 5){
 array_push($err_msgs,'ファイルサイズが5MB 以下の画像を使用してください');
}
$allow_ext = array('jpg','jpeg','png');
$file_ext = pathinfo($filename,PATHINFO_EXTENSION);
if(!in_array(strtolower($file_ext),$allow_ext)){
 array_push($err_msgs,'画像ファイルを添付してください。');
}
if (count($err_msgs) === 0) {
    if (is_uploaded_file($tmp_path)) {
        if (file_exists($save_path)) {
            array_push($err_msgs, '既に同じ画像が存在します。違う画像を入れてください。');
        }
    } else {
        array_push($err_msgs, 'ファイルが選択されていません。');
    }
}
if (count($err_msgs) > 0) {
    foreach ($err_msgs as $msg) {
        echo $msg;
        echo '<br>';
    }
} else {

    if (move_uploaded_file($tmp_path, $save_path)) {
        $result = fileSave($lineup, $servicecontents, $price, $save_path);
        if ($result) {
            echo '<p>' . htmlspecialchars($lineup) . 'サービスの登録が完了しました。</p>';
        } else {
            echo '<p>データの格納が失敗しました。</p>';
        }
    } else {
        echo 'ファイルが保存できませんでした。';
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