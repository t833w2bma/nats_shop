<?php

$host     = 'localhost';
$dbname = 'shop';
$user     = 'root';
$password ='wert3333';
// 普通はこんな感じに変数にします
$pdo=new PDO("mysql:host=$host;dbname=$dbname;charset=utf8" , $user, $password );
// ユーザー名を受け取る
if (isset($_POST['username'])) {
    $username = htmlspecialchars($_POST['username']);
    
    // ユーザー名の重複チェック
    $sql = "SELECT * FROM customer WHERE login = '$username'";
    $result = $pdo->query($sql);
    
    if ( !empty($result->fetch()) > 0) {
        // 重複している場合
        echo 'exists';
    } else {
        // 重複していない場合
        echo $username;
    }
}