<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$house = $_POST['house'];
		$position = implode(',',$_POST['position']);
		$merit_achievements = $_POST['merit_achievements'];
		$sports_achievements = $_POST['sports_achievements'];
		$cocurricular_achievements = $_POST['cocurricular_achievements'];
		$description1 = $_POST['description1'];
		$description2 = $_POST['description2'];

		$sql = "UPDATE candidates SET firstname = '$firstname', lastname = '$lastname', position_id = '$position', email = '$email' , house = '$house', merit_achievements = '$merit_achievements', sports_achievements = '$sports_achievements', cocurricular_achievements = '$cocurricular_achievements', description1 = '$description1', description2 = '$description2' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Candidate updated successfully';
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