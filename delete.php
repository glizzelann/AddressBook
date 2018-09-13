<?php

	require_once 'connection.php';
	
	if ($_REQUEST['delete']) {
		
		$pid = $_REQUEST['delete'];
		echo $pid;
		$query = "DELETE FROM tbl_add_info WHERE rec_id='".$pid."'";
		/*$stmt = $conn->prepare( $query );
		$stmt->execute(array(':pid'=>$pid));*/
		
		if ($conn->query( $query )) {
			echo "Product Deleted Successfully ...";
		}
		
	}
?>