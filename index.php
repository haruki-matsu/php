<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <h1>テクノロジーを身近に</h1>
            <h2 class="h2_1">サービス一覧</h2>
            <table>
                <tr>
                    <th>ラインナップ</th>
                    <th>サービス内容</th>
                    <th>金額(税込み)</th>
                    <th></th>
                </tr>
                <tr>
                    <td>PC構築</td>
                    <td>お客様が購入して、当店に持ち込んで<br>いただいた部品を組み立ていたします</td>
                    <td>¥40,000-</td>
                    <td><img src="images/image 2.png" alt="デスクトップPC" class=mini_img></td>
                </tr>
                <tr>
                    <td>PCメンテナンス</td>
                    <td>各部品を清掃し、劣化した部品が<br>あればリストを作成します。</td>
                    <td>¥20,000-</td>
                    <td><img src="images/image 6.png" alt="ノートPC" class=mini_img></td>
                </tr>
                <tr>
                    <td>ソフトウェア<br>アップグレード</td>
                    <td>1アプリあたりで、最新版に更新い<br>たします</td>
                    <td>¥20,000-</td>
                    <td><img src="images/image 5.png" alt="2つの円状の矢印" class=mini_img_smaller></td>
                </tr>
                <tr>
                    <td>アプリ<br>インストール</td>
                    <td>アプリのインストールから設定まで<br>実施いたします</td>
                    <td>¥4,000-</td>
                    <td><img src="images/image 4.png" alt="APPと書かれた四角いマーク" class=mini_img></td>
                </tr>
                <tr>
                    <td>ソフトウェア<br>開発</td>
                    <td>お客様がご要望している製品を開発さ<br>せていただきます</td>
                    <td>¥400,000-</td>
                    <td><img src="images/image 5.png" alt="ノートPCでの作業(青画面)" class=mini_img_smaller></td>
                </tr>
                <tr>
                    <td>サーバー<br>構築</td>
                    <td>ご要望に沿ったサーバーを構築いたし<br>ます</td>
                    <td>¥500,000-</td>
                    <td><img src="images/image 3.png" alt="黒い箱" class=mini_img></td>
                </tr>
            </table>
            
    </section>
    
<!-- 入力フォームのセクション -->

    <section id="form">
        <h2 class="h2_2">お問合せ</h2>
        <form action="confirm.php" method="post">
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
            <input type="submit" value="送信">
        </form>
    </section>

<!-- 空白（白背景)のセクション -->
    <section class="section4"></section>

<!--　フッター -->
<?php include 'footer.php'; ?>

</body>
</html>