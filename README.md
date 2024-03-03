# 2024/3/2  
以下phpでの指示に対する自分がやったことです。  
・インクルードファイルとして、ヘッダーとフッターをモジュール化してページを構成すること。  
→ヘッダー用とフッター用のphpファイルを別で作成し、各ページのphpファイルに挿入しました  

・送信元メールアドレスにはGmailを使用すること  
→自分のgmailを使用（のため、２段階認証の処理をしました)  

・メール送信機能を付け、メソッドはPOSTメソッドを使用すること。  
→phpmailerを使用しました、POSTメゾット使用  

・メール送信の際にXSS対策をすること。  
→htmlspecialchars関数でエスケープ処理をしました。  

・メール送信の際にメールヘッダインジェクションの対策をすること。  
→filter_var関数でサニタイズ、PHPMailerによる対策  

・送信項目に適切なバリデーションをつけること。  
→メアドの項目に対して以下のバリデーションをつけた  
　　①メアドが適切な型か？  
　　②入力された２つのメアドが一致しているか  

・送信時に送信確認画面と送信完了画面を表示させること。  
→入力画面、送信確認画面、送信完了画面の３つのPHPファイルを作成しました  

・二重ポストできないような仕様にすること。  
→PRGパターンによる対策、処理が終わったら別のページにリダイレクトさせた  

エスケープ処理と、二重ポストがまだ自分の中で自分の中で理解が追い付いていない感じです。  
# 2024/3/3

＜ご指摘いただいた点の修正＞

・HTMLの読み込み言語が英語になっているので日本語にしましょう
→HTMLの読み込み言語をenからjpに修正しました。

・サイト全体の余白がまだきれいに揃ってないので修正してください
→サイト全体の余白を修正しました

・alt属性にはどんな文字を入れるべきかを再度してべ手見ましょう
→alt属性に適切な文字をいれました（画像がなくてもわかるような名前）

・mail_complete.phpとmail_complete2.phpという命名規則は美しくないので、わかりやすいように修正してください
→ファイル名を変更しました

・home.phpはindex.phpとして、なぜこの変更があったかをネットの情報を元に理解しておいてください
→？

・cssファイル内で不要なインデントがあるため、修正しておいてください
→不要なインデントを修正しました。



＜その他修正した点＞

〇ファイル名の変更に関して
メール送信関連のファイル名を以下のように変更いたしました。
・home.php → index.php
・mail.confirm.php → confirm.php
・mail.complete.php → submit.php
・mail.complete.php → thank_you.php
・php-work.css → main.css

それに伴い、各ファイル内の送信先ファイルの名前も変更しました


〇リスポンデザインの追加
リスポンシブデザインに対応できるよう新たにresponsive.cddファイルを作成しました



