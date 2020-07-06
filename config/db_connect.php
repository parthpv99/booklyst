<?php

	$conn = mysqli_connect('localhost', 'admin', 'password', 'booklyst');

	if(!$conn) {
		echo 'Connection error: '. mysqli_connect_error();
	}
	 
?>