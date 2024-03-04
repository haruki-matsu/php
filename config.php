<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'vendor/autoload.php';


return [
    'mail' => [
        'host' => 'smtp.gmail.com',
        'username' => 'haruharo.ee@gmail.com',
        'password' => 'mnzm otmj pegu yuqv',
        'smtp_secure' => PHPMailer::ENCRYPTION_STARTTLS,
        'port' => 587,
        'from_email' => 'haruharo.ee@gmail.com',
        'from_name' => 'Mailer',
        'add_address' => 'haruharo.ee@gmail.com',
        'add_name' => 'haruki',
    ]
];
