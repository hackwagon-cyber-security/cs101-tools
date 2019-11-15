<?php
	header("Content-Security-Policy: default-src 'none';");
	echo '<script>alert()</script>'; 
	if (isset($_REQUEST['name'])) {
		echo "Your name is: " . $_REQUEST['name'];
	} else {
		echo "Maybe you try hacking this demo page by telling me your name in the HTTP parameter!";
	}

	echo "<br><br> This is exactly the same exercise as 2A but with a little improvement!";
	echo "<br> Can you figure out why it doesn't work?";
?>
