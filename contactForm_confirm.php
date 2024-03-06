<?php
session_start();
$token = $_SESSION['token']; 


//XSS対策、エスケープ処理//
$name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');//文字列になるようにエスケープ
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);//メール形式になるようにサニタイズ
$confirm_email = filter_var($_POST['confirm_email'], FILTER_SANITIZE_EMAIL);
$category = htmlspecialchars($_POST['category'], ENT_QUOTES, 'UTF-8');
$message = htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8');


$newToken = bin2hex(random_bytes(32));
$_SESSION['token'] = $newToken;
?>


<!--サイトデザイン-->
<!DOCTYPE html>
<html lang="jp">
<?php include 'header.php'; ?>
<body>
    <h2 class=mail_h2>送信内容の確認</h2>
    <!-- 別のファイルにデータを送る -->
    <form action="contactForm_submit.php" method="post">
        <div class=mail_p>
            <p>名前: <?php echo $name; ?></p> <!--ユーザーが入力した名前をページに載せる-->
            <p>メールアドレス: <?php echo $email; ?></p>
            <p>カテゴリ: <?php echo $category; ?></p>
            <p>メッセージ:</p>
            <p><?php echo nl2br($message); ?></p> <!--改行をbrに変換-->
        </div>

        <!-- 次のファイルに送る（ユーザーに見せる必要ない) -->
        <input type="hidden" name="name" value="<?php echo $name; ?>">
        <input type="hidden" name="email" value="<?php echo $email; ?>">
        <input type="hidden" name="confirm_email" value="<?php echo $confirm_email; ?>">
        <input type="hidden" name="category" value="<?php echo $category; ?>">
        <input type="hidden" name="message" value="<?php echo $message; ?>">
        
        <!-- 修正ボタン -->
        <button type="button" class=mail_button onclick="history.back()">修正する</button>
        <!-- 送信ボタン -->
        <input type="submit"  class=mail_button value="送信する">
        <input type="hidden" name="token" value="<?php echo $token;?>">
    </form>
    <?php include 'footer.php'; ?>
</body>
</html>


