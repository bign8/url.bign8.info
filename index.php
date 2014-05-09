<?php

if (isset($_REQUEST['act'])) switch ($_REQUEST['act']) {
	case 'add':
		echo 'adding to db';
		break;
}


class Hash {
	public static $alphalbet = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','0','1','2','3','4','5','6','7','8','9');

	public static function convert($str) {
		$hash = '';
		$dividend = (int) $str;
		$size = count( App::$alphalbet );

		while ( $dividend > 0 ) {
			$hash .= App::$alphalbet[ $dividend % $size ];
			$dividend = floor( $dividend / $size );
		}

		return $hash;
	}
}

?>

Awesome URL Shortener<br />

<pre>
<?php print_r($_REQUEST); ?>
</pre>

<form method="POST">
	<input type="text" name="url" required placeholder="URL" />
	<button type="submit" name="act" value="add">Shorten</button>
</form>
