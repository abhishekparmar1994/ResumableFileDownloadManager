<?php
	/*
	 *	This script will create the directory and set up database when the
	 *  manager is first launched
	 */
	
	// making the necessary directories for downloading the files
	$allDirectory = [
						'Downloads',
						'Downloads/Document',
						'Downloads/Compressed',
						'Downloads/Music',
						'Downloads/Video',
						'Downloads/Application',
						'tmp'
					];
	
	$totalDirectory = count( $allDirectory );

	for( $i = 0; $i < $totalDirectory; $i++ )
	{
		if( !is_dir( $allDirectory[$i] ) )
		{
			if( !mkdir( $allDirectory[$i] ) )
			{
				echo "Cannot Make Directory Restricted Access";
			}
		}
	}

	$settings = json_decode(file_get_contents("php/.conf.json"), true);
	$ip = $settings['ip'];
	$sharefoldername = $settings['sharefoldername'];
	$username = $settings['username'];
	$password = $settings['password'];
	$location_id = $settings['location_id'];

	if($ip == "" || $sharefoldername == "" || $username == "" || $password == "" || $location_id == ""){
		header("Location: setup.php");
	}
?>
