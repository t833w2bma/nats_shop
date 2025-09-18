<?php session_start(); ?>
<?php require '../header.php'; ?>
<?php require 'menu.php'; ?>
<?php
unset($_SESSION['customer']);

$pdo=new PDO('mysql:host=localhost;dbname=shop;charset=utf8', 
	'staff', 'password');

$sql=$pdo->prepare(  // 0 件か1件
	'SELECT COUNT(*) AS count FROM customer 
	 WHERE login=? AND password=?'
);

$sql->execute([$_REQUEST['login'], $_REQUEST['password']]);

/* int(0) 
PDOはデフォルトで、一つの結果を2種類のキーで返してきます
フィールド名と列番号
array(2) { 
	["count"] =>  int(0) ,
	[0] =>  int(0) 
	} 
※ 一つの結果に対して fetch は一回しか出来ません!!
*/
$row_count = $sql->fetch()["count"];

if (empty($row_count)) {
	echo 'ログイン名またはパスワードが違います。';
	exit();//処理の中断
}


$sql=$pdo->prepare( 
   'SELECT * FROM customer WHERE login=? AND password=?'
);
$sql->execute([$_REQUEST['login'], $_REQUEST['password']]);

$row = $sql->fetch();  
//↑ この結果は1行しかないのでループしなくていい
$_SESSION['customer']=[
	'id' => $row['id'], 
	'name' => $row['name'], 
	'address' => $row['address'], 
	'email' => $row['email'], 
	'login' => $row['login'], 
	'password' => $row['password']
];


echo 'いらっしゃいませ、', $_SESSION['customer']['name'], 'さん。';
var_dump($_SESSION['customer']);
?>
<script>
	location.href = "product.php"
</script>
<?php require '../footer.php'; ?>
