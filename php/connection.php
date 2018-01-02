<?php
	@$db = new mysqli('localhost', 'root', 'devindia', 'kink');
	//print_r($db);

	if(mysqli_connect_errno())
	{
		//echo mysqli_connect_errno();
		print_f("Connection Failed: %s\n",mysqli_connect_error());
		//echo "Failed to connect to Server";
		exit;
	}		
?>