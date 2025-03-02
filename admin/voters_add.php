<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$voter = $_POST['voters_id'];
		$grade = $_POST['grade'];

		$sql = "INSERT INTO voters (voters_id, password, firstname, lastname, grade) VALUES ('$voter', '$password', '$firstname', '$lastname',  '$grade')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Voter added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: voters.php');
?>