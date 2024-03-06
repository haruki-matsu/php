<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'vendor/autoload.php';

class MailSenderInfo {
    public $host;
    public $username;
    public $password;
    public $smtpSecure;
    public $port;
    public $fromEmail;
    public $fromName;

    public function __construct($host, $username, $password, $smtpSecure, $port, $fromEmail, $fromName) {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->smtpSecure = $smtpSecure;
        $this->port = $port;
        $this->fromEmail = $fromEmail;
        $this->fromName = $fromName;
    }
}

$mailSenderInfo = new MailSenderInfo(
    'smtp.gmail.com', // SMTPホスト
    'haruharo.ee@gmail.com', // SMTPユーザー名
    'mnzm otmj pegu yuqv', // SMTPパスワード
    PHPMailer::ENCRYPTION_STARTTLS, // SMTPセキュリティ
    587, // SMTPポート
    'haruharo.ee@gmail.com', // 送信元メールアドレス
    'Haruki Matsumoto' // 送信元名
);
