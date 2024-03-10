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
 $original_img = $_POST['original_img'];
 $files = $_FILES['up_img'];
 $post_filename = basename($files['name']);
 $tmp_path = $files['tmp_name'];
 $file_err = $files['error'];
 $filesize = $files['size'];
 $upload_dir = './up-images/';
 $err_msgs = array();
 $save_path = $upload_dir.$post_filename;


 $currentImagePath = '';
 try {
     $stmt = dbc()->prepare("SELECT img_path FROM service_table WHERE id = :id");
     $stmt->bindValue(':id', $post_id, PDO::PARAM_INT);
     $stmt->execute();
     $currentImage = $stmt->fetch(PDO::FETCH_ASSOC);
     if ($currentImage) {
         $currentImagePath = $currentImage['img_path'];
     }
 } catch (PDOException $e) {
     echo "画像パス取得エラー: " . $e->getMessage();
     die();
 }


// バリデーションチェック
if (empty($post_lineup)) {
    array_push($err_msgs, 'ラインナップを入力してください。');
}
if (empty($post_servicecontents)) {
    array_push($err_msgs, 'サービス内容を入力してください。');
}
if (empty($post_price)) {
    array_push($err_msgs, '金額を入力してください。');
}
if (strlen($post_lineup) > 255 || strlen($post_servicecontents) > 255 || strlen($post_price) > 40) {
    array_push($err_msgs, '入力値が長すぎます。');
}
if ($filesize > 1048576 || $file_err == 2) {
    array_push($err_msgs, 'ファイルサイズを1MB以下にしてください。');
}

$allow_ext = array('jpg', 'jpeg', 'png', 'gif');
if (is_uploaded_file($tmp_path) && !in_array(strtolower(pathinfo($post_filename, PATHINFO_EXTENSION)), $allow_ext)) {
    array_push($err_msgs, '許可された拡張子の画像ファイルを添付してください。');
}

// エラーメッセージがない場合の処理
if (count($err_msgs) === 0) {
    // 新しいファイルがある場合は古いファイルを削除
    if (is_uploaded_file($tmp_path) && file_exists($original_img) && $original_img !== $save_path) {
        unlink($original_img);
    }

    // ファイルがアップロードされているかチェック
    if (is_uploaded_file($tmp_path)) {

        //ファイルが移動しているかチェック
        if (move_uploaded_file($tmp_path, $save_path)) {
           
            // データベースが更新しているかチェック
            $result = upDateFixfile($post_id, $post_lineup, $post_servicecontents, $post_price, $save_path);
            if ($result) {
                echo $post_lineup . 'の更新が完了しました。<br>';
            } else {
                echo 'データの更新に失敗しました。<br>';
            }
        } else {
            echo 'ファイルが保存できませんでした。<br>';
        }
    } elseif (!empty($original_img) && $original_img !== $save_path) {
        // 新しいファイルがアップロードされていないが、古いファイルある場合
        $result = upDateFixfile($post_id, $post_lineup, $post_servicecontents, $post_price,$original_img);
        if ($result) {
            echo $post_lineup . 'の更新が完了しました。<br>';
        } else {
            echo 'データの更新が失敗しました。<br>';
        }
    } else {
        echo 'ファイルが選択されていません。<br>';
    }
} else {
    foreach ($err_msgs as $msg) {
        echo $msg . '<br>';
    }
}


?>
    </div>
    <a href="./index.php" class=f_button>戻る</a> 

    <!--　フッター -->
    <?php include 'footer.php'; ?>
</body>
</html>