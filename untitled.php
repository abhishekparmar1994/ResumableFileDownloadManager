<?
$storage = $_GET['storage_path'];
        $query = "SELECT * FROM files WHERE storage_path = \"$storage\"";
        $result = $db->query( $query );
        $result = $result->fetch_assoc();
        $storage_loc = $result['url'];
        print_r($storage_loc);
        /*print_r($storage_loc);
        die();*/


//https://www.win-rar.com/fileadmin/winrar-versions/wrar540al.exe