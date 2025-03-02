<?php
	include 'includes/session.php';

	$sql = "DELETE FROM positions";
	if($conn->query($sql)){
		$_SESSION['success'] = "Positions reset successfully";
	}
	else{
		$_SESSION['error'] = "Something went wrong in reseting";
	}

	header('location: positions.php');
?>