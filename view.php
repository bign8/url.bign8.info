<?php 
// http://www.programmableweb.com/category/screenshots/apis?category=20375

error_reporting(E_ALL);
ini_set('display_errors', '1');

try {
	$db = new PDO('sqlite:db.db');
	$hash = substr($_SERVER['REQUEST_URI'], 5); // TODO: convert to 1 on production
	// $urlID = base_convert($hash, 36, 10);

	$sth = $db->prepare("SELECT * FROM url WHERE hash=?;");
	$sth->execute(array($hash));
	// $sth = $db->prepare("SELECT * FROM url WHERE urlID=?;");
	// $sth->execute(array($urlID));
	$result = $sth->fetch(PDO::FETCH_ASSOC);

	$db->prepare("UPDATE url SET count=? WHERE urlID=?;")->execute(array($result['count']+1, $result['urlID']));
} catch (Exception $e) {
	// TODO: pretty print errors
	throw $e;
	// header('Location: /url/'); // TODO?
}

?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>SURL</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
		<div class="container">
			<div class="page-header">
				<h1><a href="/url/">SURL</a> <small>Slim URLs</small></h1>
			</div>

			<p class="lead">Need some shorter url's with crazy statistics?  SURL is the place for you!</p>

			<p>SURL combines legendary URL shrinking advances with stunning analytics.  When these two forces combine, you get a top notch web experience.</p>

			<div class="row">
				<div class="col-lg-6 col-lg-offset-3 col-md-10 col-md-offset-1">
					<div class="well clearfix">
						<a href="<?=$result['url']; ?>" class="thumbnail pull-right" style="margin-bottom:0">
							<img src="http://api.webthumbnail.org?width=300&screen=1280&format=png&url=<?=$result['url']; ?>" />
						</a>
						<h3>Your SURL <small><?=$result['count']; ?> views</small></h3>
						<p>
							<a href="<?=$result['url']; ?>"><?=$result['url']; ?></a>
						</p>
					</div>
				</div>
			</div>

			<!-- <pre><?php print_r($result); ?></pre> -->
		</div>
	</body>
</html>