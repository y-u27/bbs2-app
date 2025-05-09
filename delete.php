<?php
require('db_connect.php');

$stmt = $pdo->prepare('delete from post where id=?');
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$stmt->execute([$id]);

header('Location: bbs.php');

?>