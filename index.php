<?php

if (isset($_REQUEST['act'])) switch ($_REQUEST['act']) {
	case 'add':
		echo 'adding to db';
		break;
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
