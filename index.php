<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

function convert($dividend) {
	// http://www.ietf.org/rfc/rfc3986.txt  2.3
	$alphalbet = array(
		'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z',
		'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
		'0','1','2','3','4','5','6','7','8','9',
		'-','.','_','~'//,'(',')','*','&','$','!','@'
	);

	$hash = '';
	$size = count( $alphalbet );

	while ( $dividend > 0 ) {
		$hash .= $alphalbet[ $dividend % $size ];
		$dividend = floor( $dividend / $size );
	}

	return $hash;
}

if (isset($_REQUEST['act'])) switch ($_REQUEST['act']) {
	case 'add':
		echo 'adding to db';
		echo '"' . convert($_REQUEST['url']) . '"';
		break;
}

?>

<!-- <pre> -->
<!--<?php print_r($_REQUEST); ?>-->
<!-- </pre> -->

<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>SURL</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
		<!-- // <script language="javascript" src="library/all.js"></script> -->
		<!-- <link rel="stylesheet" type="text/css" href="library/all.css" /> -->
	</head>
	<body>
		<div class="container">
			<div class="page-header">
				<h1>SURL <small>Slim URLs</small></h1>
			</div>

			<p class="lead">Need some shorter url's with crazy statistics?  SURL is the place for you!</p>

			<p>SURL combines legendary URL shrinking advances with stunning analytics.  When these two forces combine, you get a top notch web experience.</p>

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
	</body>
</html>