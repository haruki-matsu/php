<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<!-- サービス内容の入力フォーム -->
<section id=service>
    <form action="file_upload.php" method="post" enctype="multipart/form-data">
        <h2>サービス一覧</h2>
        <table>
            <tr>
                <th>ラインナップ</th>
                <th>サービス内容</th>
                <th>金額(税込み)</th>
                <th>アップロード</th>
                <th></th>
            </tr>
            <tr>
                <td><input type="text" name="line_up"></td>
                <td><input type="text" name="service_contents"></td>
                <td><input type="text" name="price"></td>
                <td><input type="file" name="up_img"></td>
                <td><button type="submit">送信</button></td>
            </tr>
        </table> 
    </form>   
</section>

<section>
        <table>
            <tr>
                <th width="15%">ラインナップ</th>
                <th width="35%">サービス内容</th>
                <th width="10%">金額（税込み）</th>
                <th width="30%">画像</th>
                <th width="5%"></th>
                <th width="5%"></th>
            </tr>

            <?php 

// DB情報をテーブルに載せる
require_once "./dbc.php"; 
$files = getAllfile()->fetchAll(PDO::FETCH_ASSOC); 
?>

<?php foreach ($files as $file):  ?>
    <tr>
        <td><p><?php echo h($file['line_up']); ?></p></td>
        <td><p><?php echo h($file['service_name']); ?></p></td>
        <td><p><?php echo h($file['price']); ?></p></td>
        <td><img src="<?php echo $file['img_path']; ?>" alt="" style="width:40%;"></td>
        <td><a href="edit_item.php?id=<?php echo $file['id']; ?>">編集</a></td>
        <td><a href="delete_item.php?id=<?php echo $file['id']; ?>" onClick="return confirm('削除しても良いですか？')">削除</a></td>
    </tr>
<?php endforeach; ?>

 
         </table> 
</section>
    
</body>
</html>
