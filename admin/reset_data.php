<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$sql = "DELETE FROM positions WHERE 1";
		$conn->query($sql);
		$sql = "DELETE FROM candidates WHERE 1";
		$conn->query($sql);
		$sql = "DELETE FROM voters WHERE 1";
		$conn->query($sql);
		$sql = "DELETE FROM votes WHERE 1";
		$conn->query($sql);
	}
	else{
		$_SESSION['error'] = 'Select item to delete first';
	}

	header('location: index.php');
	
?>