<?php
include "autoload.php";

/**
 * student data delete
 */
if(isset($_GET['delete_id'])){
 $delete_id=$_GET['delete_id'];
 $photo_name=$_GET['photo'];


 unlink('photos/'. $photo_name);

delete('students', $delete_id);
header("location:index.php");
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Student database</title>
<!-- ALL CSS FILES  -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">	
</head>
<body>
<?php
/**
 * isseting student add form
 */
if(isset($_POST['stc'])){
 //grt value
 $name= $_POST['name'];
 $email= $_POST['email'];
 $cell= $_POST['cell'];
 $username= $_POST['username'];
 $location= $_POST['location'];
 $age= $_POST['age'];
 $gender= $_POST['gender'];
 $dept= $_POST['dept'];


 /**
  * form validation
  */
 if(empty($name)||empty($email)||empty($cell)||empty($username)||empty($location)||empty($age)||empty($gender)||empty($dept)){
	$msg = validate('All fields are required')  ;
 }else if(filter_var($email,FILTER_VALIDATE_EMAIL)==false){
	$msg =  validate('Invalid email address');

	//email check
 }else if(datacheck('students','email',$email) ) {
	 $msg = validate('Email already exists ','warning');

	//user name check 
 }elseif(datacheck('students','username',$username)){
	 $msg = validate('Username already exists','warning');


 } else {
	
	
	
	 //upload profile photo

	 $data = move($_FILES['photo'],'photos/');


	//get function 
	 $unique_name=$data['unique_name'];
	 $err_msg=$data['err_msg'];


	if(empty($err_msg)){

		//data insert
		
		create("INSERT INTO students (name,email,cell,username,location,age,gender,dept,photo) VALUES('$name','$email','$cell','$username','$location','$age','$gender','$dept','$unique_name')");

	
		$msg =  validate('Data stable','success');

	}else{
		$msg=$err_msg;
	}	 
 }

}
?>



<div class="wrap-table ">
    <br>
	<a class="btn btn-primary btn-sm" data-toggle="modal" href="#add_student_modal">Add new student</a>
	<br>
	<br>
	<a href="../crudv_project/index.php" class="btn btn-primary">Back</a>
	
	<br>
	<?php
		if(isset($msg)){
			echo $msg;		
		}
	?>
	<br>
		<div class="card shadow">
			<div class="card-body">
				
			<form class="form-inline" action="" method="POST">
       
             <div class="form-group  mb-2">
               <label for="inputPassword2" class="sr-only">Search</label>
               <input name="search" type="search" class="form-control" id="inputPassword2" placeholder="Search">
             </div>
               <button name="searchbtn" type="submit" class="btn btn-primary mb-2">Search</button>

            </form>
				<h2>All students</h2>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Email</th>
							<th>Cell</th>
							<th>Username</th>
							<th>Photo</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php

						
						
							//search 
						if(isset($_POST['searchbtn'])){

							$search=$_POST['search'];

							$sql = "SELECT * FROM students WHERE name LIKE '%$search%'";
							$data =connect()->query($sql);
							
							
							
						}else{
							
							$data = all('students');
						}
						$i=1;

						while($student=$data->fetch_object()) :
						
						?>


						<tr>
							<td><?php echo $i;$i++; ?></td>
							<td><?php echo $student->name ?></td>
							<td><?php echo $student->email ?></td>
							<td><?php echo $student->cell ?></td>
							<td><?php echo $student->username ?></td>

							<td><img width="50" src="photos/<?php echo $student->photo?>" alt=""></td>
							<td>
								<a class="btn btn-sm btn-info" href="show.php ?show_id=<?php echo $student->id ?>">View</a>
								<a class="btn btn-sm btn-warning" href="edit.php? edit_id=<?php echo $student->id ?>">Edit</a>
								<a  class="btn btn-sm btn-danger delete_btn" href="?delete_id=<?php echo $student->id ?>&photo=<?php echo $student->photo ?>">Delete</a>
							</td>
						</tr>
						<?php endwhile;?>

					</tbody>
				</table>
			</div>
		</div>
	</div>
	
	<!-- student create modal -->

	<div id="add_student_modal" class="modal fade">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h3>Add new student</h3>
				</div>
				<div class="modal-body">
					<form action="" method="POST" enctype="multipart/form-data">
					   <div class="form-group">
					   		<label for="">Student Name</label>
							 <input name="name" class="form-control" type="text">  
					   </div>

					   <div class="form-group">
					   		<label for="">Email</label>
							 <input name="email" class="form-control" type="text">  
					   </div>

					   <div class="form-group">
					   		<label for="">Cell</label>
							 <input name="cell" class="form-control" type="text">  
					   </div>

					   <div class="form-group">
					   		<label for="">Username</label>
							 <input name="username" class="form-control" type="text">  
					   </div>

					   <div class="form-group">
					   		<label for="">Location</label>
							 <select class="form-control" name="location" id="">
							     <option value="">-select-</option>
								 <option value="Mirpur">Mirpur</option>
								 <option value="Dhanmondi">Dhanmondi</option>
								 <option  value="Shyamoli">Shyamoli</option>
								 <option value="Uttara">Uttara</option>
								 <option value="badda">badda</option>
								 <option value="Gazipur">Gazipur</option>
								 <option value="Banani">Banani</option>
							 </select>
					   </div>

					   <div class="form-group">
					   		<label for="">Age</label>
							 <input name="age" class="form-control" type="text">  
					   </div>

					   <div class="form-group">
					   		<label for="">Gender</label> <br>
							 <input name="gender" type="radio" checked  value="Male" id="Male"> <label for="Male">Male</label> 
							 <input name="gender" type="radio" value="Female" id="Female" > <label for="Female">Female</label> 
					   </div>


					   <div class="form-group">
					   		<label for="">Dept</label>
							 <select class="form-control" name="dept" id="">
							     <option value="">-select-</option>
								 <option value="CSE">CSE</option>
								 <option value="BBA">BBA</option>
								 <option value="EEE">EEE</option>
								 <option value="ENGLISH">ENGLISH</option>
								 <option value="BANGLA">BANGLA</option>
								 <option value="ET">ET</option>
								 <option value="IT">IT</option>
							 </select>
					   </div>

					   
					   <div class="form-group">
					   		<label for="">Profile Photo</label>
							   <br>
									<img id="load_student_photo" style="max-width:50%" src="" alt="">

							   <br>
							<label for="student_photo"> <img width="100" src="assets/media/img/up.gif" alt=""></label>
							<input name="photo" id="student_photo" style="display:none;" class="form-control" type="file">  
					   </div>


					   <div class="form-group">
					   		<label for=""></label>
							 <input name="stc" class="btn btn-primary" type="submit" value="add student">  
					   </div>
					   
					  
					 

					  
					</form>
				</div>
				<div class="modal-footer"></div>
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

	$('#student_photo').change(function(e){
		
	let file_url= URL.createObjectURL(e.target.files[0]);
		$('#load_student_photo').attr('src',file_url);
		
	});

	$('.delete_btn').click(function(){

		let confirmation = confirm('Are you sure ?');

		if(confirmation == true){
			return true;
		}else{
			return false;
		}

	});

	

	


</script>

</body>
</html>