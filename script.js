
document.getElementById('up_img').addEventListener('change', function(e) {
    var file = e.target.files[0]; // 選択されたファイルを取得
    var reader = new FileReader();
    reader.onload = function(e) {
        var img = new Image();
        img.src = e.target.result;
        img.width = 100; // 表示する画像の幅を指定（必要に応じて）
        document.getElementById('image_preview').innerHTML = ''; // 以前のプレビューをクリア
        document.getElementById('image_preview').appendChild(img); // 画像を表示
    }
    reader.readAsDataURL(file); // ファイルを Data URL として読み込む
});