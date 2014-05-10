<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

try {
	if (isset($_REQUEST['act']) && $_REQUEST['act'] == 'add') {
		if (!filter_var($_REQUEST['url'], FILTER_VALIDATE_URL)) throw new Exception("Invalid URL format", 1);
		
		$db = new PDO('sqlite:db.db');
		if ($db->prepare("INSERT INTO url (url) VALUES (?);")->execute(array($_REQUEST['url']))) { // Add new hash
			$urlID = $db->lastInsertID();
			$hash = base_convert($urlID, 10, 36);
			if (!$db->prepare("UPDATE url SET hash=? WHERE urlID=?;")->execute(array($hash, $urlID))) throw new Exception(print_r($db->errorInfo()[2], true), 1);
		} else { // url already exists
			$sth = $db->prepare("SELECT hash FROM url WHERE url=? LIMIT 1;");
			if (!$sth->execute(array($_REQUEST['url']))) throw new Exception(print_r($db->errorInfo()[2], true), 1);
			$hash = $sth->fetchColumn();
		}
		
		if ($hash === false) throw new Exception("Something went very wrong!", 1);
		
		// Redirect to preview page
		// exit(header('Location: /url/' . $hash));
		echo $hash;
	}
} catch (Exception $e) {
	// TODO: pretty print errors
	throw $e;
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
				<h1>SURL <small>Slim URLs</small></h1>
			</div>

			<p class="lead">Need some shorter url's with crazy statistics?  SURL is the place for you!</p>

			<p>SURL combines legendary URL shrinking advances with stunning analytics.  When these two forces combine, you get a top notch web experience.</p>

			<div class="row">
				<div class="col-lg-6 col-lg-offset-3 col-md-10 col-md-offset-1">
					<form method="POST" name="add" class="well">
						<fieldset>
							<legend>SURL Submission</legend>
							<div class="form-group" style="margin-bottom:0">
								<div class="input-group">
									<label for="url" class="input-group-addon">URL: </label>
									<input id="url" name="title" placeholder="http://" type="text" size="50" class="form-control">
									<span class="input-group-btn">
										<button type="submit" name="act" value="add" class="btn btn-default">Slim this URL</button>
									</span>
								</div>
							</div>
						</fieldset>
					</form>
				</div>
			</div>

			<!-- <pre><?php print_r($_REQUEST); ?></pre> -->
		</div>
	</body>
</html>