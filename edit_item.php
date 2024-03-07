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
    <title>編集画面</title>
</head>
<?php include 'header.php'; ?>
<body class=display>
<h2 class="manage_h2">編集画面</h2>
    <form enctype="multipart/form-data" action="update_item.php" method="post">
        <input type="hidden" name="id" value="<?php echo $get_id; ?>">

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
                <td><input class=input_gray name="line_up" id="line_up" value="<?php echo $file[0]; ?>" class=input_gray1></td>
                <td><input class=input_gray name="service_content" id="service-content" value="<?php echo $file[1]; ?>"></td>
                <td><input class=input_gray name="price" id="service-charge" value="<?php echo $file[2]; ?>"></td>
                <td id="image_preview">                   
                    <input type="hidden" name="MAX_FILE_SIZE" value="1048576" >
                    <?php echo $file[3]; ?><br>
                    <input name="up_img" type="file" accept="image/*" />
                </td>
                <td><button type="submit" class=input_gray3>更新</button></td>
             
             <script>
document.getElementById('up_img').addEventListener('change', function(e) {
    var file = e.target.files[0]; // 選択されたファイルを取得
    var reader = new FileReader();
    reader.onload = function(e) {
        var img = new Image();
        img.src = e.target.result;
        img.width = 100; // 表示する画像の幅を指定（必要に応じて）
        document.getElementById('image_preview').innerHTML = ''; // 以前のプレビューをクリア
        document.getElementById('image_preview').appendChild(img); // 画像を表示
    }
    reader.readAsDataURL(file); // ファイルを Data URL として読み込む
});
</script>

        </table> 
    </form>   
    
</body>
</html>

