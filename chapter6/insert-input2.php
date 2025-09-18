<?php require '../header.php'; ?>
<p>商品を追加します。</p>
<form action="insert-output2.php" method="post" enctype="multipart/form-data">
    <p>商品名: <input type="text" name="name">
    <p>価格: <input type="text" name="price">
    <p>商品画像<input type="file" name="file"></p>
    <input type="submit" value="追加">
</form>
<?php require '../footer.php'; ?>
