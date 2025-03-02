<?php
	include 'includes/session.php';

	$sql = "DELETE FROM voters";
	if($conn->query($sql)){
		$_SESSION['success'] = "Voters reset successfully";
	}
	else{
		$_SESSION['error'] = "Something went wrong in reseting";
	}

	header('location: voters.php');
?>