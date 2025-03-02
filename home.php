<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	<?php 
		$sql = "SELECT * FROM admin";
		$query = $conn->query($sql);
		$status = 1;
		while($row = $query->fetch_assoc()){
			$can_reg_grade = $row['can_reg_grade'];
        }
	?>

	 
	  <div class="content-wrapper">
	    <div class="container">

	      <!-- Main content -->
	      <section class="content">
	      	<?php
	      		$parse = parse_ini_file('admin/election_title.ini', FALSE, INI_SCANNER_RAW);
    			$title = $parse['election_title'];
	      	?>
	      	<h1 class="page-header text-center title"><b><?php echo strtoupper($title); ?></b></h1>
	        <div class="row">
	        	<div class="col-sm-10 col-sm-offset-1">
				<?php
				        if(isset($_SESSION['error'])){
				        	?>
				        	<div class="alert alert-danger alert-dismissible">
				        		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<h4><i class='icon fa fa-check'></i> Error!</h4>
								<?php echo $_SESSION['error']; ?>
					        </div>
				        	<?php
				         	unset($_SESSION['error']);

				        }
				        if(isset($_SESSION['success'])){
				          	echo "
				            	<div class='alert alert-success alert-dismissible'>
				              		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				              		<h4><i class='icon fa fa-check'></i> Success!</h4>
				              	".$_SESSION['success']."
				            	</div>
				          	";
				          	unset($_SESSION['success']);
				        }

				    ?>
 
				    <div class="alert alert-danger alert-dismissible" id="alert" style="display:none;">
		        		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			        	<span class="message"></span>
			        </div>
					
					<div class="row">
						<div class="col-xs-12">
							<div class="box box-solid">
								<div class="box-body" style="height: 200px;">
									<div class="text-center" style="margin-top:65px">
										<a class="btn btn-primary btn-flat" id="preview" href="register.php" style="margin-right: 10px;"><?php echo "Register as a candidate (Only ".$can_reg_grade."th grade)" ?></a>
										<a class="btn btn-primary btn-flat" href="positions.php">Vote</a>
									</div>
								</div>

							</div>
						</div>
					</div>
				    

	        	</div>
	        </div>
	      </section>
	     
	    </div>
	  </div>
  
  	<?php include 'includes/footer.php'; ?>
  	<?php include 'includes/ballot_modal.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
</body>
</html>