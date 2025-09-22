<?php 
// エラーを出力する
ini_set('display_errors', "On");
require '../connect.php'; 
require '../header.php'; 
require 'menu.php'; 
?>

<div class="container">
	<form action="product.php" method="post">
		商品検索
		<input type="text" name="keyword">
		<input type="submit" value="検索">
	</form>
<hr>
<?php

$limit = 6;
if(!empty($_REQUEST['page']) ){
	$offset = ($_REQUEST['page'] -1) * $limit ;
} else{
	$offset = 0;
}
// ↑ テーブルを出すよりも先にやる
echo '<div class="row">';


if (isset($_REQUEST['keyword'])) {
	$query = "SELECT * FROM product 
	WHERE name LIKE ?
	LIMIT $limit OFFSET $offset ";
	$sql = $pdo->prepare($query);
	$sql->execute(['%'.$_REQUEST['keyword'].'%']);

} else {
	$query = "SELECT * FROM product 
	LIMIT $limit OFFSET $offset";
	$sql = $pdo->query($query);
}
foreach ($sql as $row) {
	$id = $row['id'];
	echo '<div class="col-6 col-md-4 col-lg-3 product">';
	echo "<p><img src='image/$id.jpg' class='object-fit-cover'></p>";
	echo '<p>商品番号: ', $id, '</p>';
	echo '<p>';
	echo '<a href="detail.php?id=', $id, '">商品名: ', $row['name'], '</a>';
	echo '</p>';
	echo '<p>価格: ', $row['price'], '</p>';
	echo '</div>';
}
echo '</div></div>';


$query = "SELECT COUNT(*) AS count FROM product ";
$sql = $pdo->query($query);
$item_count = $sql->fetch()['count'];
// var_dump($item_count);
$page_count = ceil($item_count / $limit);
// var_dump($page_count);

//現在のページを取得 三項演算子でfalse判定なら"1"を代入
$active_page = isset($_GET['page']) ? $_GET['page'] : "1"; 
$link_html = '';

for ($i = 1; $i <= $page_count; $i++) {
	
	if($active_page == $i) {
		// いまアクティブなページだよ
		$link_html .= "<li class='page-item active'>
			<span class='page-link'>
				$i
			</span></li>";
		$current = $i; //今のページ番号
	 }else{ //非アクティブなページ 

		$link_html .= "<li class='page-item '>
		<a class='page-link' href='?page=$i'>
			$i
		</a></li>";
 	} 
 } ?>

<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item <?= $current==1 ? 'disabled':'' ?> ">
      <a class="page-link" href="?page=<?=$current-1?>">Previous</a>
    </li>
 	<?= $link_html ?>
    <li class="page-item <?=$page_count == $current ? 'disabled':''?>">
      <a class="page-link" href="?page=<?=$current+1?>">Next</a>
    </li>
  </ul>
</nav>

<?php require '../footer.php'; ?>
