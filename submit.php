<!--footer  -->
<?php include 'header.php'; ?>

<?php
//phpメイラーの3つのをインポート
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {  //もしpostメゾットでデータが送られてきたら
    // XSS対策、エスケープ処理
    $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');//文字列になるようにエスケープ
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);//メール形式にあるようにサニタイズ
    $confirm_email = filter_var($_POST['confirm_email'], FILTER_SANITIZE_EMAIL);
    $category = htmlspecialchars($_POST['category'], ENT_QUOTES, 'UTF-8');
    $message = htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8');

    // メールアドレスが有効か、２つのメールアドレスが同じか
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $email !== $confirm_email) {
        echo 'メールアドレスが無効、またはメールアドレスが一致しません。';
        exit;//その場合はここで終了
    }

    $mail = new PHPMailer(true);//$mailに引数trueのPHPMailerクラスを作成

    try {//tryブロック　メール送信のための設定
        $mail->SMTPDebug = SMTP::DEBUG_OFF; 
        $mail->isSMTP(); 
        $mail->Host       = 'smtp.gmail.com'; 
        $mail->SMTPAuth   = true; 
        $mail->Username   = 'haruharo.ee@gmail.com'; 
        $mail->Password   = 'mnzm otmj pegu yuqv'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
        $mail->Port       = 587; 

        //送信者、受信者のメール設定
        $mail->setFrom('haruharo.ee@gmail.com', 'Mailer');
        $mail->addAddress('haruharo.ee@gmail.com', 'haruki'); 
        // メール内容の設定
        $mail->isHTML(true); // 
        $mail->Subject = 'お問い合わせ分類: ' . $category;
        $mail->Body    = "氏名: {$name}<br>メールアドレス: {$email}<br>メッセージ: {$message}";
        //メールの送信とメッセージ
        $mail->send();

        header('Location: thank_you.php');
        exit();

        //tryブロックで何らかのエラーが起きたら、エラーメッセージを往診
    } catch (Exception $e) {
        echo "メッセージを送信できませんでした。Mailer Error: {$mail->ErrorInfo}";
    }
    //そもそもpostメゾット以外の場合は以下のメッセージ
} else {
    echo 'このページはPOSTメソッドでのみアクセスできます。';
}
?>

<!--footer  -->
<?php include 'footer.php'; ?>
