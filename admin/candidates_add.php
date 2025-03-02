<?php
	include 'includes/session.php';

	$sql = "SELECT * FROM candidates where email='".$_POST['email']."'";
	$vquery = $conn->query($sql);
	if($vquery->num_rows > 0){
		$_SESSION['error'] = $_POST['email'].' email is already exists.';
		header('location: candidates.php');
		die;
	}

	if(isset($_POST['add'])){
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
		$photoname = $_FILES['photo']['name'];
		if(!empty($photoname)){
			$extension = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);
			$name=rand(100000000000,10000000000000000);
			$photoname = $name.".".$extension;			
			move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$photoname);	
		}
		$merit_evidence = $_FILES['merit_evidence']['name'];
		if(!empty($merit_evidence)){
			$extension = pathinfo($_FILES["merit_evidence"]["name"], PATHINFO_EXTENSION);
			$name=rand(100000000000,10000000000000000);
			$merit_evidence = $name.".".$extension;	
			move_uploaded_file($_FILES['merit_evidence']['tmp_name'], '../images/'.$merit_evidence);	
		}
		$sports_evidence = $_FILES['sports_evidence']['name'];
		if(!empty($sports_evidence)){
			$extension = pathinfo($_FILES["sports_evidence"]["name"], PATHINFO_EXTENSION);
			$name=rand(100000000000,10000000000000000);
			$sports_evidence = $name.".".$extension;				
			move_uploaded_file($_FILES['sports_evidence']['tmp_name'], '../images/'.$sports_evidence);	
		}
		$cocurricular_evidence = $_FILES['cocurricular_evidence']['name'];
		if(!empty($cocurricular_evidence)){
			$extension = pathinfo($_FILES["cocurricular_evidence"]["name"], PATHINFO_EXTENSION);
			$name=rand(100000000000,10000000000000000);
			$cocurricular_evidence = $name.".".$extension;			
			move_uploaded_file($_FILES['cocurricular_evidence']['tmp_name'], '../images/'.$cocurricular_evidence);	
		}

		$sql = "INSERT INTO candidates (position_id, firstname, lastname, photo, email, house, merit_achievements,sports_achievements,cocurricular_achievements,merit_evidence,sports_evidence,cocurricular_evidence,description1,description2) VALUES ('$position', '$firstname', '$lastname', '$photoname','$email', '$house', '$merit_achievements','$sports_achievements','$cocurricular_achievements','$merit_evidence','$sports_evidence','$cocurricular_evidence','$description1','$description2')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Candidate added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: candidates.php');
?>