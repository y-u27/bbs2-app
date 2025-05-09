<?php

// db_connect.phpファイルの読み込み
require_once('db_connect.php');

// DB接続
$pdo = new PDO('mysql:host=localhost;dbname=bbs-app2', $user, $pass);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // 投稿機能
  $category = $_POST['category'];
  $name = $_POST['name'];
  $post = $_POST['post'];

  // SQL文準備
  $stmt = $pdo->prepare("insert into post(category, name, post) value(?, ?, ?)");
  $stmt->execute([$category, $name, $post]);

  // リダイレクトで再読み込みを防止
  header("Location: bbs.php");
  exit();
}
// 投稿一覧取得
$stmt = $pdo->query("select * from post order by id desc");
$posts = $stmt->fetchAll();

?>

<!-- HTML部分 -->
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/bbs.css">
</head>

<body>
  <h1>掲示板</h1>
  <h2>新規投稿</h2>
  <div class="container">
    <form action="bbs.php" method="post">
      <div></div>
      <div>
        <label>カテゴリー：</label>
        <select name="category">
          <option value="勉強">勉強</option>
          <option value="仕事">仕事</option>
          <option value="その他">その他</option>
        </select>
        <label>名前：</label>
        <input type="text" name="name">
      </div>
      <div class="post_content">
        <label>投稿内容：</label>
        <input type="text" name="post">
      </div>
      <button type="submit">投稿</button>
    </form>
  </div>

  <h2>投稿内容一覧</h2>
  <div class="container">
    <?php if (!empty($posts)): ?>
      <ul class="post-list">
        <?php foreach ($posts as $p): ?>
          <li>カテゴリー：<?php echo $p['category']; ?></li>
          <li>No：<?php echo $p['id']; ?></li>
          <li>名前：<?php echo htmlspecialchars($p['name']); ?></li>
          <li>投稿内容：<?php echo htmlspecialchars($p['post']); ?></li>
          <a href="delete.php?id=<?php echo $p['id']; ?>">削除する</a>
          <hr align="left">
        <?php endforeach; ?>
      </ul>
    <?php else: ?>
      <p>投稿はまだありません</p>
    <?php endif; ?>
  </div>
</body>

</html>