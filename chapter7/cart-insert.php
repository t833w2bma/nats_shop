<?php session_start(); ?>
<?php require '../header.php'; ?>
<?php require 'menu.php'; ?>
<?php
/*
 カートには一つずつしか入れられない
*/
$id = $_REQUEST['id'];

// 不要(値が入ってない場合にカラにしてる)
// if (!isset($_SESSION['cart'])) {
// 	$_SESSION['cart']=[];
// }

$count=0;
if (isset($_SESSION['cart'][$id])) {
	// 特定の商品の数量を取り出して
	$count = $_SESSION['cart'][$id]['count'];
}

// 3次元配列 ここのnameは商品名
$_SESSION['cart'][$id] = [
	'name' => $_REQUEST['name'], 
	'price' => $_REQUEST['price'], 
	'count'=> $count + $_REQUEST['count'] // カートに加算
];
echo '<p>カートに商品を追加しました。</p>';
echo '<hr>';
require 'cart.php';
?>
<?php require '../footer.php'; ?>
