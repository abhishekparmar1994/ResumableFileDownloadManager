<?php
	header('Content-Type: application/json');
	$cmd = $_POST['cmd'];
	
	if($cmd == "save"){
		extract($_POST);
		if($ip == "" || $sharefoldername == "" || $username == "" || $password == "" || $location_id == ""){
			echo "{ \"error\":\"Something went wrong.\" }";
			exit;
		}
		$settings = array("ip" => $ip, "sharefoldername" => $sharefoldername, "username" => $username, "password" => $password, "location_id" => $location_id);
		system("smbclient //".$ip."/".$sharefoldername." -U ".$username."%".$password." -E", $res);
		if(!$res){
			if(file_put_contents('.conf.json', json_encode($settings))){
				echo "{ \"data\":\"Settings Saved.\" }";
				exit;
			}else{
				echo "{ \"error\":\"Something went wrong.\" }";
				exit;
			}
		}else{
			echo "{ \"error\":\"Something went wrong.\" }";
			exit;
		}
	}
	
	if($cmd == "test"){
		extract($_POST);
		system("smbclient //".$ip."/".$sharefoldername." -U ".$username."%".$password." -E", $res);
		if(!$res){
			echo "{ \"data\":\"Connection successful.\" }";
			exit;
		}else{
			echo "{ \"error\":\"Something went wrong.\" }";
			exit;
		}
	}
?>
