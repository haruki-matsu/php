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
