<?php
// DB接続
function dbc(){
 $host ="localhost";
 $dbname="php_work";
 $user = "root";
 $pass = "";
 $dns = "mysql:host=$host;
 dbname=$dbname;
 charset=utf8";

 try {
 $pdo = new PDO($dns,$user,$pass,
 [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
 PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
 ]);

 return $pdo;
 } catch (PDOException $e) {
 exit($e->getMessage());
 }
}

// DBに登録
function fileSave($lineup, $servicecontents, $price, $save_path) {
    $result = false;
    $sql = "INSERT INTO service_table (line_up, service_name, price, img_path) VALUES (?, ?, ?, ?)";
    try {
        $stmt = dbc()->prepare($sql);
        $stmt->bindValue(1, $lineup);
        $stmt->bindValue(2, $servicecontents);
        $stmt->bindValue(3, $price);
        $stmt->bindValue(4, $save_path);
        $result = $stmt->execute();
        return $result;
    } catch (\Exception $e) {
        echo $e->getMessage();
        return $result;
    };
}

//DBから取得
function getAllfile(){
 $sql = "SELECT * FROM service_table";
 $fileData = dbc()->query($sql);
 return $fileData;
 }

//特定情報の取得
function upDatefile($get_id){
 try {
 $sql = "SELECT * FROM service_table WHERE id = :id";
 $fileData = dbc()->prepare($sql);
 $fileData->bindParam(":id", $get_id);
 $fileData->execute();
 } catch (PDOException $e) {
 echo $e->getMessage();
 die();
 }

 $row = $fileData->fetch(PDO::FETCH_ASSOC);
 $servicename = $row['line_up'];
 $servicecontents = $row['service_name'];
 $servicecharge = $row['price'];
 $save_path = $row['img_path'];

 $target_data = array($servicename,
 $servicecontents,
 $servicecharge,
 $save_path

 );
 return $target_data;
}

//特定情報の更新
function upDateFixfile(
    $post_id,
    $post_lineup, 
    $post_servicecontents,
    $post_price,
    $post_save_path
){
    $result = False;
    $sql = 'UPDATE service_table SET line_up = :line_up,
    service_name = :service_name,
    price = :price,
    img_path = :img_path WHERE id = :id';
    try {
        $stmt = dbc()->prepare($sql);
        $result = $stmt->execute([
            ':id' => $post_id,
            ':line_up' => $post_lineup,
            ':service_name' => $post_servicecontents,
            ':price' => $post_price,
            ':img_path' => $post_save_path
        ]);
        return $result;
    } catch (PDOException $e) {
        echo $e->getMessage();
        die();
    }
}

//特定情報の削除
function deletefile($get_id){
    $result = false;

    $sqlSelect = "SELECT img_path FROM service_table WHERE id = :id";
    try {
        $stmtSelect = dbc()->prepare($sqlSelect);
        $stmtSelect->bindParam(":id", $get_id);
        $stmtSelect->execute();
        $row = $stmtSelect->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "画像パス取得エラー: " . $e->getMessage();
        die();
    }
    
    $sqlDelete = "DELETE FROM service_table WHERE id = :id";
    try {
        $stmtDelete = dbc()->prepare($sqlDelete);
        $stmtDelete->bindParam(":id", $get_id);
        $result = $stmtDelete->execute();
    } catch (PDOException $e) {
        echo "レコード削除エラー: " . $e->getMessage();
        die();
    }

    if ($result && !empty($row['img_path'])) {
        $imgPass = str_replace('./up-images/', '', $row['img_path']);
        $filePath = __DIR__ . '/up-images/' . $imgPass;
        if (file_exists($filePath)) {
            unlink($filePath);
        } else {
            echo "エラー: ファイルが存在しません - " . $filePath;
        }
    } elseif ($result) {
        echo "正常に削除されました";
    }
}

//エスケープ処理
function h($s){
 return htmlspecialchars($s,ENT_QUOTES,"UTF-8");
}
?>