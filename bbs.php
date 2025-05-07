<?php

// db_connect.phpファイルの読み込み
require_once('db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // 投稿機能
  if (isset($_POST['posts'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $category = $_POST['category'];
    $post = $_POST['post'];

    $pdo = new PDO('mysql:host=localhost;dbname=bbs-app2', $user, $pass);
    // SQL文準備
    $stmt = $pdo->query("insert into post(post) value(?)");
    $posts = $stmt->fetchAll();
    $stmt->execute();
  }
}


?>

<!-- HTML部分 -->
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="bbs2.css">
</head>

<body>
  <h1>掲示板</h1>
  <h2>新規投稿</h2>
  <div class="container">
    <form action="bbs.php" method="post">
      <div>
        <label>名前：</label>
        <input type="text">
      </div>
      <div class="post_content">
        <label>投稿内容：</label>
        <input type="text">
      </div>
      <button type="submit">投稿</button>
    </form>
  </div>

  <h2>投稿内容一覧</h2>
  <?php echo htmlspecialchars($posts)?>
</body>

</html>