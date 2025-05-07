<?php
$host = 'localhost';
$dbname = 'bbs-app2';
$user = 'root';
$pass = 'root';

try {
  $pdo = new PDO('mysql:host=localhost;dbname=bbs-app2', $user, $pass);
  // エラーモードを例外に設定
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  // 接続エラーが起きたら表示して終了
  echo '接続失敗：' . $e->getMessage();
  exit();
}
?>