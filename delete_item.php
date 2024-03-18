<?php
require_once "./dbc.php";
$get_id = $_GET['id'];
$result = deletefile($get_id);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="responsive.css">
    <title>削除ページ</title>
</head>
<body class=display>
    <!-- ヘッダー -->
    <?php include 'header.php'; ?>
    
    <!-- 削除画面 -->
    <h2 class=f_h2>削除画面</h2>
    <div class=f_text>
    <?php
        if ($result) {
            echo "<p>削除に成功しました。</p>";
        } else {
            echo "<p>削除に失敗しました。</p>";
        }
        ?>
    </div>
    <a href="./manage.php" class=f_button>管理画面に戻る</a>

    <!--　フッター -->
    <?php include 'footer.php'; ?>
</body>
</html>
