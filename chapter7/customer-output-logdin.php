<?php session_start(); ?>
<?php require '../header.php'; ?>
<?php require 'menu.php'; ?>
<?php
$pdo=new PDO('mysql:host=localhost;dbname=shop;charset=utf8', 'staff', 'password');

$id = $_SESSION['customer']['id']; // 顧客ID

$query = 'SELECT * FROM customer 
WHERE id != ? AND login = ?';
// idが違って、ログイン名が等しい(他人がいるか)
$sql=$pdo->prepare($query);
// ログイン名変更しようとした場合の処理
$sql->execute([$id, $_REQUEST['login']]);



// fetch はDBの戻り値を配列に変える関数
// 上のSQL文でカラならばtrue 
if (empty($sql->fetchAll())) {
		// login名は使われてない
		$sql=$pdo->prepare(
			'UPDATE customer SET 
			name=?, 
			address=?, 
			email=?, 
			login=?, 
			password=? 
			WHERE id=?'
		);
		$sql->execute([
			$_REQUEST['name'], 
			$_REQUEST['address'], 
			$_REQUEST['email'], 
			$_REQUEST['login'], 
			$_REQUEST['password'], 
			$id]);
		// 更新された顧客情報をセッションに入れ直し
		$_SESSION['customer']=[
			'id'=>$id, 
			'name'=>$_REQUEST['name'], 
			'address'=>$_REQUEST['address'], 
			'email'=>$_REQUEST['email'], 
			'login'=>$_REQUEST['login'], 
			'password'=>$_REQUEST['password']
		];
		echo 'お客様情報を更新しました。';

} else {
	echo 'ログイン名がすでに使用されていますので、変更してください。';
}
?>
<?php require '../footer.php'; ?>
