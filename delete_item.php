<?php
require_once "./dbc.php";
$get_id = $_GET['id'];
$result = deletefile($get_id);
?>

<!DOCTYPE html>
<html lang="jp">
<?php include 'header.php'; ?>
<body class=display>
    <h2 class=f_h2>削除画面</h2>

<div class=f_text>
<?php if ($result): ?>
    <p>正常に削除できました。</p>
<?php else: ?>
    <p>削除に失敗しました。</p>
<?php endif; ?>

</div>

<a href="./manage.php" class=f_button>管理画面に戻る</a>


<!--　フッター -->
<?php include 'footer.php'; ?>

</body>
</html>
