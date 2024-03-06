<?php

 require_once "./dbc.php";
 $get_id = $_GET['id'];
 $file = upDatefile($get_id);
 // var_dump($file);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>変更画面</title>
</head>
<body>
    <h1>編集</h1>
    <form enctype="multipart/form-data" action="update_item.php" method="post">
        <input type="hidden" name="id" value="<?php echo $get_id; ?>">
        <table>
        <tr>
                <th>ラインナップ</th>
                <th>サービス内容</th>
                <th>金額(税込み)</th>
                <th>アップロード</th>
                <th></th>
            </tr>
            <tr>
                <td><input name="line_up" id="line_up" value="<?php echo $file[0]; ?>"></td>
                <td><input name="service_content" id="service-content" value="<?php echo $file[1]; ?>"></td>
                <td><input name="price" id="service-charge" value="<?php echo $file[2]; ?>"></td>
                <td>
                    <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                    <?php echo $file[3]; ?><br>
                    <input name="up_img" type="file" accept="image/*" />
                </td>
            </tr>
        </table>
        <button type="submit">更新</button>
    </form>
</body>
</html>

