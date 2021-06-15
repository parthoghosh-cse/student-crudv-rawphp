<?php
include_once "autoload.php";


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

 $id=$_GET['edit_id'];


 /**
  * form validation
  */
 if(empty($name)||empty($email)||empty($cell)||empty($username)||empty($location)||empty($age)||empty($gender)||empty($dept)){
	$msg = validate('All fields are required')  ;
 }else if(filter_var($email,FILTER_VALIDATE_EMAIL)==false){
	$msg =  validate('Invalid email address');

 } else {
     //edit photo
	if(!empty($_FILES['new_photo']['name'])){
		$data = move($_FILES['new_photo'],'photos/');
		$photo_name =$data['unique_name'];
		unlink('photos/' . $_POST['old_photo']);
	}else{
		$photo_name = $_POST['old_photo'];
	}
	
	
	$updated_at = date('Y-m-d g:i:h',time());
	update("UPDATE students SET name='$name',email='$email',cell='$cell',username='$username',location='$location',age='$age',gender='$gender',dept='$dept',photo='$photo_name', updated_at='$updated_at' WHERE id='$id'");
	
   header('location:index.php');


	
 }

}




/**
 * find edit student data
 */

 if(isset($_GET['edit_id'])){
	$id=$_GET['edit_id'];

	$edit_data =find('students',$id);

 }


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Edit Data</title>
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
				<div class="col-lg-6 mx-auto mt-5">
				<a class="btn btn-primary btn-sm"href="index.php">Back</a>
					<br>
					<br>
					<div class="card">
						<div class="card-body">
						  <h2>Student data edit</h2>
						  <?php
	                 	    if(isset($msg)){
			                 echo $msg;		
	                    	}
	                       ?>
						   <hr>
						<form action="" method="POST" enctype="multipart/form-data">
					   <div class="form-group">
					   		<label for="">Student Name</label>
							 <input name="name" class="form-control" value="<?php echo $edit_data->name;?>" type="text">  
					   </div>

					   <div class="form-group">
					   		<label for="">Email</label>
							 <input   value="<?php echo $edit_data->email;?>" name="email" class="form-control" type="text">  
					   </div>

					   <div class="form-group">
					   		<label for="">Cell</label>
							 <input value="<?php echo $edit_data->cell;?>" name="cell" class="form-control"  type="text">  
					   </div>

					   <div class="form-group">
					   		<label for="">Username</label>
							 <input value="<?php echo $edit_data->username;?>" name="username" class="form-control"  type="text">  
					   </div>

					   <div class="form-group">
					   		<label for="">Location</label>
							 <select class="form-control" name="location" id="">
							     <option value="">-select-</option>
								 <option <?php echo ($edit_data->location=='Mirpur') ? 'selected' : ''; ?> value="Mirpur">Mirpur</option>
								 <option <?php echo ($edit_data->location=='Dhanmondi') ? 'selected' : ''; ?> value="Dhanmondi">Dhanmondi</option>
								 <option <?php echo ($edit_data->location=='Shyamoli') ? 'selected' : ''; ?> value="Shyamoli">Shyamoli</option>
								 <option <?php echo ($edit_data->location=='Uttra') ? 'selected' : ''; ?>   value="Uttara">Uttara</option>
								 <option <?php echo ($edit_data->location=='Badda') ? 'selected' : ''; ?>   value="Badda">Badda</option>
								 <option <?php echo ($edit_data->location=='Gazipur') ? 'selected' : ''; ?> value="Gazipur">Gazipur</option>
								 <option <?php echo ($edit_data->location=='Banani') ? 'selected' : ''; ?> value="Banani">Banani</option>
							 </select>
					   </div>

					   <div class="form-group">
					   		<label for="">Age</label>
							 <input value="<?php echo $edit_data->age;?>" name="age" class="form-control"  type="text">  
					   </div>

					   <div class="form-group">
					   		<label for="">Gender</label> <br>
							 <input name="gender" type="radio" <?php echo ($edit_data->gender =='Male') ? 'checked' : ''; ?>  value="Male" id="Male"> <label for="Male">Male</label> 
							 <input name="gender" type="radio" <?php echo ($edit_data->gender=='Female') ? 'checked' : ''; ?> value="Female" id="Female" > <label for="Female">Female</label> 
					   </div>


					   <div class="form-group">
					   		<label for="">Dept</label>
							 <select class="form-control" name="dept" id="">
							     <option value="">-select-</option>
								 <option <?php echo ($edit_data->dept=='CSE') ? 'selected' : ''; ?>     value="CSE">CSE</option>
								 <option <?php echo ($edit_data->dept=='BBA') ? 'selected' : ''; ?>     value="BBA">BBA</option>
								 <option <?php echo ($edit_data->dept=='EEE') ? 'selected' : ''; ?>     value="EEE">EEE</option>
								 <option <?php echo ($edit_data->dept=='ENGLISH') ? 'selected' : ''; ?> value="ENGLISH">ENGLISH</option>
								 <option <?php echo ($edit_data->dept=='BANGLA') ? 'selected' : ''; ?>  value="BANGLA">BANGLA</option>
								 <option <?php echo ($edit_data->dept=='ET') ? 'selected' : ''; ?>      value="ET">ET</option>
								 <option <?php echo ($edit_data->dept=='IT') ? 'selected' : ''; ?>      value="IT">IT</option>
							 </select>
					   </div>

					   
					   <div class="form-group">
					   		<label for="">Profile Photo</label>
							   <br>
									<img id="load_student_photo_edit" style="max-width:50%" src="photos/<?php echo $edit_data->photo; ?>" alt="">

							   <br>
							<label for="student_photo_edit"> <img width="100" src="assets/media/img/up.gif" alt=""></label>
							<input name="new_photo" id="student_photo_edit" style="display:none;" class="form-control" type="file"> 
							 <input type="hidden" value="<?php echo $edit_data->photo ;?>" name="old_photo">
					   </div>


					   <div class="form-group">
					   		<label for=""></label>
							 <input name="stc" class="btn btn-primary" type="submit" value="update student">  
					   </div>
					   
					  
					 

					  
					</form>
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
		$('#student_photo_edit').change(function(e){
		
		let file_url= URL.createObjectURL(e.target.files[0]);
			$('#load_student_photo_edit').attr('src',file_url);
			
		});


</script>

</body>
</html>