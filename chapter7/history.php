<?php 
session_start();
require '../header.php';
require 'menu.php';

if (isset($_SESSION['customer'])) {
	$pdo=new PDO('mysql:host=localhost;dbname=shop;charset=utf8', 
		'staff', 'password');

	// 顧客名がいらないのでcustomerはつなげなくていい
	$sql_purchase=$pdo->prepare(
		'SELECT `product_id`, p.name, count, `price`, 
		`price` * count AS subtotal
		FROM `purchase_detail` 
		LEFT JOIN `product` AS p ON p.id = `product_id`
		LEFT JOIN `purchase` AS c ON c.id = `purchase_id`
		WHERE customer_id = ? ORDER BY c.id DESC'
	);
	// 一人の顧客IDで絞り込む
	$sql_purchase->execute([$_SESSION['customer']['id']]);
	
	echo '<table>';
	echo '<tr><th>商品番号</th><th>商品名</th>', 
		'<th>価格</th><th>個数</th><th>小計</th></tr>';
	$total=0;
	// 行だけ回せばいいのでループは1回
	foreach ($sql_purchase as $row) {
		echo '<tr>';
		echo '<td>', $row['product_id'], '</td>';
		echo '<td><a href="detail.php?id=', $row['product_id'], '">', 
			$row['name'], '</a></td>';
		echo '<td>', $row['price'], '</td>';
		echo '<td>', $row['count'], '</td>';
		$subtotal = $row['price'] * $row['count'];
		echo '<td>', $subtotal, '</td>';
		echo '</tr>';

		$total += $subtotal;
	}

	echo '<tr><td>合計</td><td></td><td></td><td></td><td>', 
		$total, '</td></tr>';
	echo '</table>';
	echo '<hr>';
} else {
	echo '購入履歴を表示するには、ログインしてください。';
}
?>
<?php require '../footer.php'; ?>
