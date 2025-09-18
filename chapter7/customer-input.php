<?php session_start(); ?>
<?php require '../header.php'; ?>
<?php require 'menu.php'; ?>
<?php
$is_logdin = isset($_SESSION['customer']);
// ログイン判定
if ($is_logdin) {
	$name=$_SESSION['customer']['name'];
	$address=$_SESSION['customer']['address'];
	$email=$_SESSION['customer']['email'];
	$login=$_SESSION['customer']['login'];
	$password=$_SESSION['customer']['password'];
	echo '<form id="entry" action="customer-output-logdin.php" method="post">'; //更新専用
}else{
	$name=$address=$login=$password=$email='';
	echo '<form id="entry" action="customer-output-logoff.php" method="post">'; // 新規登録専用
}

echo '<table>';
echo '<tr><td>お名前</td><td>';
echo '<input type="text" name="name" value="', $name, '">';
echo '</td></tr>';
echo '<tr><td>ご住所</td><td>';
echo '<input type="text" name="address" value="', $address, '">';
echo '</td></tr>';
echo '<tr><td>メールアドレス</td><td>';
echo '<input type="email" name="email" value="', $email, '">';
echo '</td></tr>';
echo '<tr><td>ログイン名</td><td>';
echo '<input type="text" name="login" autocomplete="off" value="', $login, '">';
echo '<div id="username-error" style="display:none">⚠このログイン名は誰かに使われてます</div>';
echo '</td></tr>';
echo '<tr><td>パスワード</td><td>';
echo '<input type="password" name="password" id="pswd1" value="', $password, '">';
echo '</td></tr>';

echo '<tr><td>パスワード確認</td><td>';
echo '<input type="password" name="password" id="pswd2" >';
echo '</td></tr>';

echo '</table>';
echo '<input type="button" value="確定" onclick="check()">';
echo '</form>';
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
// 要素の読み込みを待ってから
 $(document).ready(function() {

	// ユーザー名入力時にAJAXで重複チェック
	$('[name="login"]').on('change', function() {
		//入力値の取得
		var username = $(this).val();
		if (username !== "") {
			$.ajax({
				url: 'check_username.php', // サーバー側で重複をチェックするPHPファイル
				type: 'POST',
				data: { 'username': username },
			})
			.done(function(response) {  // AJAX成功時に実行される
				// php からの戻り値↑が入ってる
				if (response === 'exists') {
					$('#username-error').show();  // 重複があればエラーメッセージを表示
					$('#username').attr('disabled',true);
				} else {
					$('#username-error').hide();  // 重複していなければエラーメッセージを非表示
					$('#username').removeAttr('disabled',false);
				}
			})
			.fail(function() {  // AJAX失敗時のエラーハンドリング
				alert('エラーが発生しました。');
			});
		}
	});
});


  function check(){
    // hapter7/customer-input.php に照合機能を追加してください
    const pswd_elm1 = document.querySelector("#pswd1");
    pswd_text1 = pswd_elm1.value;

    const pswd_elm2 = document.querySelector("#pswd2");
    pswd_text2 = pswd_elm2.value;

    console.log(pswd_text1)
    console.log(pswd_text2)

	if (pswd_text1 == pswd_text2){
		const form = document.querySelector("#entry");
		form.submit();
	}else{
		alert('パスワードが一致しません')
	}

  }
</script>

<?php require '../footer.php'; ?>
