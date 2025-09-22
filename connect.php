<?php

// var_dump($_SERVER['HTTP_HOST']);
//後からだと大変なので､各ファイルからrequireで読み込み
if( $_SERVER['HTTP_HOST'] == 'localhost'){
  $host   = 'localhost';
  $dbname = 'shop2'; 
  $user   = 'root';
  $pswd   = 'wert3333';
  
} else {
  $host   = 'localhost';
  $dbname = 'ichiro';  // xserverで変わる情報
  $user   = 'ichiro'; 
  $pswd   = 'wert3333'; 
}

// 例外的なエラーをキャッチして自動分岐します
try{
  $pdo = new PDO(
    "mysql:host=$host;dbname=$dbname;charset=utf8",
    $user, 
    $pswd 
  );
} catch (Exception $e) {
  echo 'どれかまちがってる';
}