<?php
 require_once "./dbc.php";
 $get_id = $_GET['id'];
 $file = upDatefile($get_id);
?>

<!-- ここからhtml -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="responsive.css">
    <title>編集ページ</title>
</head>
<body class=display>
    <!-- ヘッダー -->
    <?php include 'header.php'; ?>

    <!-- 編集フォーム -->
    <h2 class="f_h2">編集画面</h2>
    <form enctype="multipart/form-data" action="update_item.php" method="post">
        <input type="hidden" name="id" value="<?php echo $get_id; ?>">
        <input type="hidden" name="original_img" value="<?php echo $file[3]; ?>">
        <table class=table_manage>
            <tr>
                <th width="15%">ラインナップ</th>
                <th width="30%">サービス内容</th>
                <th width="15%">金額（税込）</th>
                <th width="15%">                    
                    <input name="up_img" type="file" id=up_img accept="image/*" />
                    <label for="up_img" class="apload_btn">アップロード</label></th>
                <th width="10%"></th>
            </tr>
            <tr>
                <td><input class=input_gray name="line_up" id="line_up" value="<?php echo $file[0]; ?>" class=input_gray1></td>
                <td><input class=input_gray name="service_content" id="service-content" value="<?php echo $file[1]; ?>"></td>
                <td><input class=input_gray name="price" type="number" id="service-charge" value="<?php echo $file[2]; ?>"></td>
                <td id="image_preview"><img src="<?php echo $file[3]; ?>" alt="画像"></td>      
                <td><button type="submit" class=input_gray3>更新</button></td>
        </table> 
    </form>   
    <a href="./manage.php" class=f_button>管理画面に戻る</a> 
<script src="script.js"></script>
</body>
</html>

