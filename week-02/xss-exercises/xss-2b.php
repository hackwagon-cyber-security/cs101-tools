
<?php
	$value = "Maybe you can think of closing the tag!";
	if (isset($_REQUEST['name'])) {
		$value = $_REQUEST['name'];
	}

	echo '<input type="text" size="35" name="fname" value="' . $value . '">';
	echo '<br>';
	echo 'Similar to the previous exercise! Use the "name" URL parameter!';
?>


