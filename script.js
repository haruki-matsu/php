//ファイル選択したときにその画像をテーブルに表示
document.getElementById('up_img').addEventListener('change', function(e) {
    var file = e.target.files[0]; 
    var reader = new FileReader();
    reader.onload = function(e) {
        var img = new Image();
        img.src = e.target.result;
        img.width = 100; 
        document.getElementById('image_preview').innerHTML = ''; 
        document.getElementById('image_preview').appendChild(img); 
    }
    reader.readAsDataURL(file); 
});