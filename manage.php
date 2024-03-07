<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="responsive.css">
    <title>管理ページ</title>
</head>
<body>
    <!-- ヘッダー -->
    <?php include 'header_manage.php'; ?>

<!-- サービス内容の登録フォーム -->
    <h1 class="manage_h1">管理画面</h1 >
    <section id=service>
        <form action="file_upload.php" method="post" enctype="multipart/form-data">
            <h2 class="manage_h2">新規登録</h2>
                <table class=table_manage>
                    <tr>
                        <th width="15%">ラインナップ</th>
                        <th width="30%">サービス内容</th>
                        <th width="15%">金額（税込）</th>
                        <th width="15%"><input type="file" name="up_img" id="up_img">
                            <label for="up_img" class="apload_btn">アップロード</label></th>
                        <th width="10%"></th>
                    </tr>
                    <tr>
                        <td><input class=input_gray type="text" name="line_up"></td>
                        <td><textarea  class=input_gray2 type="text" name="service_contents"></textarea></td>
                        <td><input class=input_gray type="text" name="price"></td>
                        <td id="image_preview"><span>画像表示</span></td>
                        <td><button type="submit" class=input_gray3>登録</button></td>
                    </tr>
                </table> 
        </form>   
    </section>


<!-- 登録サービスのテーブルのセクション -->
    <section>
        <h2 class="manage_h2">データ管理</h2>
        <table class=table_manage>
            <tr>
                <th width="15%">ラインナップ</th>
                <th width="30%">サービス内容</th>
                <th width="15%">金額（税込）</th>
                <th width="15%"></th>
                <th width="5%"></th>
                <th width="5%"></th>
            </tr>

        <?php 
        require_once "./dbc.php"; 
        $files = getAllfile()->fetchAll(PDO::FETCH_ASSOC); 
        foreach ($files as $file):
        ?>
             <tr>
                <td><p><?php echo h($file['line_up']); ?></p></td>
                <td><p><?php echo h($file['service_name']); ?></p></td>
                <td><p><?php echo h($file['price']); ?></p></td>
                <td><img src="<?php echo $file['img_path']; ?>" alt=""></td>
                <td class=td_button><a href="edit_item.php?id=<?php echo $file['id']; ?>" class=input_gray4>編集</a></td>
                <td class=td_button><a href="delete_item.php?id=<?php echo $file['id']; ?>"class=input_gray4 onClick="return confirm('削除しても良いですか？')" >削除</a></td>
            </tr>
            
        <?php endforeach; ?>
         </table>  
    </section>

    <!--　フッター -->
    <?php include 'footer.php'; ?>
    
    <script src="script.js"></script>
</body>
</html>
