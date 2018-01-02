<?php
	if( isset($_GET['filename']) )
	{
		$filename = $_GET['filename'];
		include 'connection.php';

		$query = "SELECT * FROM files WHERE filename = \"$filename\"";
		$result = $db->query( $query );
		$result = $result->fetch_assoc();
		
		$url = $result['url'];
		$storage = $result['storage_path'];
		$filesize = byteTo($result['filesize'],2);
		$status = ($result['complete'] == 'y') ? 'Done' : 'Not Complete';
		$ext = substr($result['ext'], 1);
		$date = date( "D M j Y G:i:s", strtotime( $result['added_on'] ) );
		$saveTo = '';
		
		$type = $result['type'];
		if( $type === 'doc' )
		{
			$saveTo = $storage;
			$type = 'Document';
		}
		elseif( $type === 'aud' )
		{
			$saveTo = $storage;
			$type = 'Music';
		}
		elseif( $type === 'com' )
		{
			$saveTo = $storage;
			$type = 'Compressed';
		}
		elseif( $type === 'vid' )
		{
			$saveTo = $storage;
			$type = 'Video';
		}
		elseif( $type === 'app' )
		{
			$saveTo = $storage;
			$type = 'Application';
		}

		$output = "<span class=\"close\"></span>
				<div>
					<div class=\"head afterClear\">
						<div class=\"icon left\" style=\"background-image:url(image/fileicon/$ext.png)\" ></div>
						<div class=\"name left\"><p>$filename</p></div>
					</div>
					<table cellpadding=\"0\" cellspacing=\"0\">
						<tbody>
							<tr>
								<td class=\"c1\">Type</td>
								<td class=\"c2\">$type</td>
							</tr>
							<tr>
								<td>Added On</td>
								<td>$date</td>
							</tr>
							<tr>
								<td>Status</td>
								<td>$status</td>
							</tr>
							<tr>
								<td>Size</td>
								<td>$filesize</td>
							</tr>
							<tr>
								<td>Save To</td>
								<td>$saveTo</td>
							</tr>
							<tr>
								<td>From</td>
								<td><input type=\"text\" value=\"$url\"></td>
							</tr>
						</tbody>
					</table>
				</div>";
			echo "$output";
	}

function byteTo( $bytes, $decimalPlaces )
	{
		if( $bytes < 0 )
		{
			return "Unknown";
		}

		$unit = 'bytes';
		
		if( $bytes >= 1000 )
		{
			$bytes /= 1024;
			$unit = 'KB';
		}

		if( $bytes >= 1000 )
		{
			$bytes /= 1024;
			$unit = 'MB';
		}

		if( $bytes >= 1000 )
		{
			$bytes /= 1024;
			$unit = 'GB';
		}

		return sprintf('%.'.$decimalPlaces.'f', $bytes ).' '.$unit;
	}

?>