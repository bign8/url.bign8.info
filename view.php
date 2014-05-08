<?php 
// http://www.programmableweb.com/category/screenshots/apis?category=20375

error_reporting(E_ALL);
ini_set('display_errors', '1');

$db = new PDO('sqlite:db.db');
$sth = $db->prepare("SELECT * FROM url WHERE hash=?;");
$sth->execute(array(substr($_SERVER['REQUEST_URI'], 1)));
$result = $sth->fetch(PDO::FETCH_ASSOC);
if (!$result) die(header('Location: /'));

print_r($result);

// TODO: create preview from $result

