<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$can_reg_start_time = $_POST['can_reg_start_time'];
		$can_reg_end_time = $_POST['can_reg_end_time'];
		$can_reg_grade = $_POST['can_reg_grade'];
		$sql = "UPDATE admin SET can_reg_start_time = '$can_reg_start_time', can_reg_end_time = '$can_reg_end_time', can_reg_grade = '$can_reg_grade' WHERE 1";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Registration settings updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location: candidates.php');

?>