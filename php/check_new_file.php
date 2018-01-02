<?php
	header('Content-Type: application/json');
	include 'connection.php';
	$query_resume = "SELECT file_id FROM files WHERE complete = 'n' LIMIT 3";
	$result_resume = $db->query( $query_resume );
	$row_cnt = $result_resume->num_rows;
	if($row_cnt != 0){
		$tmparr_resume = $result_resume->fetch_assoc();
		echo json_encode(array("msg"=>"resume","data"=>$tmparr_resume['file_id']));
	}else{
		$query = "SELECT id, url FROM file_list WHERE status = 'n' LIMIT 3";
		$result =$db->query( $query );
		$count = $result->num_rows;
		if($count != 0){
			$tmpArr = $result->fetch_assoc();
			print_r($tmpArr);
			$query = "UPDATE file_list SET status = 'y' WHERE id = '".$tmpArr['id']."'";
			$result =$db->query( $query );
			for($i = 0; $i < $result; i++){
				return json_encode(array("msg"=>"new","data"=>$tmpArr['url']));
			}
			/*echo json_encode(array("msg"=>"new","data"=>$tmpArr['url']));*/
		}else{
			echo json_encode(array("msg"=>"startinterval","data"=>""));
		}
	}
	$db->close();
?>
