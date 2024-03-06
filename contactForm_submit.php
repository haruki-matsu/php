<?php
session_start();

// POSTされたトークンを取得
$posted_token = filter_input(INPUT_POST, 'token');

// セッション変数のトークンを取得
$session_token = isset($_SESSION['token']) ? $_SESSION['token'] : '';

// トークンの検証
if ($posted_token == $session_token) {
    // トークンが一致した場合の処理（データの保存など）
    unset($_SESSION['token']); // トークンの使用後はセッションから削除
    header('Location: success_page.php'); // PRGパターンの実装
    exit;
} else {
    // トークンが一致しない場合の処理（エラーメッセージの表示など）
    echo '不正な送信が検出されました。';
}


//phpメイラーの3つのをインポート
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'vendor/autoload.php';
require 'mail_config.php'; 


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formData = new FormData($_POST);

    // メールアドレスのバリデーション
    if (!$formData->isValidEmail()) {
        echo 'メールアドレスが無効、またはメールアドレスが一致しません。';
        exit; // その場合はここで終了
    }

    // 以下、PHPMailerでのメール送信処理...
    // $formData->name, $formData->email などを使用




    $mail = new PHPMailer(true); // $mailに引数trueのPHPMailerクラスを作成
    $mail->CharSet = 'UTF-8';
    
    try { // tryブロック　メール送信のための設定
        $mail->SMTPDebug = SMTP::DEBUG_OFF; 
        $mail->isSMTP(); 
        $mail->Host       = $mailSenderInfo->host; // SMTPホスト
        $mail->SMTPAuth   = true; 
        $mail->Username   = $mailSenderInfo->username; // SMTPユーザー名
        $mail->Password   = $mailSenderInfo->password; // SMTPパスワード
        $mail->SMTPSecure = $mailSenderInfo->smtpSecure; // SMTPセキュリティ
        $mail->Port       = $mailSenderInfo->port; // SMTPポート
    
        // 送信者、受信者のメール設定
        $mail->setFrom($mailSenderInfo->fromEmail, $mailSenderInfo->fromName); 
        $mail->addAddress($mailSenderInfo->fromEmail, 'haruki'); 

    
        // メール内容の設定(自分自身あて)
        $mail->isHTML(true); 
        $mail->Subject = 'お問い合わせ分類: ' . $formData->category;
        $mail->Body    = "氏名: {$formData->name}<br>メールアドレス: {$formData->email}<br>メッセージ: {$formData->message}";
        //メールの送信とメッセージ
        $mail->send();

        //ここからユーザー充てのメール
        $mail->clearAddresses();  // 以前のaddAddressで追加されたアドレスをクリア
        $mail->addAddress($formData->email);  // ユーザーのメールアドレスを追加
        
        // メール内容の設定（ユーザー宛て）
        $mail->Subject = 'お問い合わせありがとうございます';
        $mail->Body    = "以下の内容でお問い合わせを受け付けました。<br><br>氏名: {$name}<br>メールアドレス: {$email}<br>お問い合わせ分類: {$category}<br>メッセージ: {$message}<br><br>内容を確認の上、追ってご連絡させていただきます。";
        
        // メールの送信（ユーザー宛て）
        if(!$mail->send()) {
            echo "ユーザー宛てメールの送信に失敗しました。Mailer Error: " . $mail->ErrorInfo;
        } else {
            // メール送信成功時の処理（必要に応じて）
        }

        header('Location: contactForm_thank_you.php');
        exit();

        //tryブロックで何らかのエラーが起きたら、エラーメッセージを往診
    } catch (Exception $e) {
        echo "メッセージを送信できませんでした。Mailer Error: {$mail->ErrorInfo}";
    }
    //そもそもpostメゾット以外の場合は以下のメッセージ
} else {
    echo 'このページはPOSTメソッドでのみアクセスできます。';
}

    // セッション変数を破棄
    $_SESSION = array();
    session_destroy();
?>

<!--footer  -->
<?php include 'footer.php'; ?>
