<?php
include_once "autoload.php";

/**
 * show single student
 */
if(isset($_GET['show_id'])){
	$id = $_GET['show_id'];



	$student = find('students',$id);

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $student-> name ;?></title>
<!-- ALL CSS FILES  -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">	
</head>
<body>

	<div class="container">
		<div class="row">
			<div class="col-lg-7 mx-auto mt-5">
				<div class="card p-5">
				  <img class="simg shadow"  width="300"  src="photos/<?php echo $student->photo ;?>" alt="">
					 <div class="card-body">
					 <h2 class="text-center"><?php echo $student-> name ;?></h2>
						<br>
						<table class="table">
							<tr>
								<td>Name</td>	
								<td><?php echo $student-> name ;?></td>
							</tr>
							<tr>
								<td>Email</td>	
								<td><?php echo $student-> email ;?></td>
							</tr>
							<tr>
								<td>Cell</td>	
								<td><?php echo $student-> cell ;?></td>
							</tr>
							<tr>
								<td>Username</td>	
								<td><?php echo $student-> username ;?></td>
							</tr>
							<tr>
								<td>Gender</td>	
								<td><?php echo $student-> gender ;?></td>
							</tr>
							<tr>
								<td>Dept</td>	
								<td><?php echo $student-> dept ;?></td>
							</tr>
							<tr>
								<td>Location</td>	
								<td><?php echo $student-> location ;?></td>
							</tr>
						</table>
						<a class="btn btn-primary btn-sm" href="index.php">Back</a>	
					 </div>
				</div>
			</div>
		</div>
	</div>


 
	<!-- JS FILES  -->


<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>



</script>

</body>
</html>