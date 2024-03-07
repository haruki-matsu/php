<?php
session_start();

// 二重送信防止用トークンの発行
$token = bin2hex(random_bytes(32));

// トークンをセッション変数にセット
$_SESSION['token'] = $token;
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="responsive.css">
    <title>Document</title>
</head>
<body>
    <!-- ヘッダー -->
    <?php include 'header.php'; ?>

    <!-- ヘッダー下背景(windowsとmacのロゴ)-->
    <section>
        <img src="images/image 1.png" alt="ヘッダー下の背景画像(windowsとmacのロゴ)" id=img_wiondosMac>
    </section>


    <!-- サービス一覧セクション -->
    <section id=service>
        <h1 class=index_h1>テクノロジーを身近に</h1>
            <h2 class="h2_1">サービス一覧</h2>
            <table>
            <colgroup>
                <col style="width: 20%;">
                <col style="width: 45%;">
                <col style="width: 20%;">
                <col style="width: 20%;">
            </colgroup>
                <tr>
                    <th>ラインナップ</th>
                    <th>サービス内容</th>
                    <th>金額(税込み)</th>
                    <th></th>
                </tr>
 
    <!-- DBからの取得した情報をテーブルに載せる -->
            <?php 
            require_once "./dbc.php"; 
            $files = getAllfile()->fetchAll(PDO::FETCH_ASSOC);       
            foreach ($files as $file):  ?>
                <tr>
                    <td><p><?php echo h($file['line_up']); ?></p></td>
                    <td><p><?php echo h($file['service_name']); ?></p></td>
                    <td><p><?php echo h($file['price']); ?></p></td>
                    <td><img src="<?php echo $file['img_path']; ?>" alt="" ></td>
                </tr>
            <?php endforeach; ?>
            </table>
            
    </section>
    
<!-- 入力フォームのセクション -->

    <section id="form">
        <h2 class="h2_2">お問合せ</h2>
        <form action="contactForm_confirm.php" method="post">
        <input type="hidden" name="token" value="<?php echo $token; ?>">
            <div class=form_top>
            <div class="input-group">
                <label for="name">氏名（必須）</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="input-group">
                <label for="email">メールアドレス(必須)</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="input-group">
                <label for="confirm_email">アドレス再入力(必須)</label>
                <input type="email" id="confirm_email" name="confirm_email" required>
            </div>
            
            <div class="input-group">
                <label for="category">お問い合せ分類(必須)</label>
                <select id="category" name="category" required>
                    <option value="" id=first_select>適切な種類を選択してください</option>
                    <option value="product">サービスについて</option>
                    <option value="service">商品について</option>
                    <option value="other">その他</option>
                </select> 
            </div>
            
            <div class="input-group">
                <label for="message">お問い合わせ内容</label>
                <textarea id="message" name="message"></textarea>
            </div>
            </div>
            <input type="submit" value="送信" id="bottan">
        </form>
    </section>

<!-- 空白（白背景)のセクション -->
    <section class="section4"></section>

<!--　フッター -->
<?php include 'footer.php'; ?>

</body>
</html>