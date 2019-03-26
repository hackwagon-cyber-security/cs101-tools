<?php
	if (isset($_REQUEST['name'])) {
		echo "Your name is: " . $_REQUEST['name'];
	} else {
		echo "Maybe you try hacking this demo page by telling me your name in the HTTP parameter!";
	}
?>