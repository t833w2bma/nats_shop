<?php require '../header.php'; ?>
<table>
<tr><th>商品番号</th><th>商品名</th><th>価格</th></tr>
<?php
$pdo=new PDO('mysql:host=localhost;dbname=shop;charset=utf8', 
	'staff', 'password');

//DBにSQL文を先に渡して構文チェックしてもらってる
// ? プレースホルダ(入れ物)を用意してる
$sql = $pdo->prepare('select * from product where name like ?');
// ここでプリペアしたSQL文を実行して、変数を後追いで渡してる
$sql->execute(['%'.$_REQUEST['keyword'].'%']);
//$sqlにはテーブル構造のオブジェクトが戻って来る
// ↓ これはオブジェクトも回せます
foreach ($sql as $row) {
	// 表から一行ずつ配列に変えて取り出してる
	echo '<tr>';
	echo '<td>', $row['id'], '</td>';
	echo '<td>', $row['name'], '</td>';
	echo '<td>', $row['price'], '</td>';
	echo '</tr>';
	echo "\n"; // ←ソースコードの改行(無くていい)
}
?>
</table>
<?php require '../footer.php'; ?>
DBに入れられたくない文字
- , ; ' " スペース () 
これらの文字は htmlspesialchars が置換しない
PDOのbaindvalueが1度にまとめて置換します