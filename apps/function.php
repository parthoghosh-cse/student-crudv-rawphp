<?php
/**
 * data create & data insert to database
 */

 function create($sql){
    connect()->query($sql);
 }

 /**
 * data select all
 */

function all($table,$order='DESC'){
    return connect()->query("SELECT * FROM $table ORDER BY id $order"); 
}

/**
 * single data create/find edit student data
 */

function find($table,$id){
  $data = connect()->query("SELECT * FROM students WHERE id='$id'");
  return $data->fetch_object();


  
     
}

/**
 * data update
 */

function update($sql){

  connect()->query($sql);
   
}
/**
 * data check function
 */
function datacheck($table,$column,$data){

  $data = connect()->query("SELECT $column FROM $table WHERE $column='$data'");

if($data->num_rows > 0){

  return true;
}else{

  return false;
}

}




/**
 * data delete
 */

function delete($table,$id){

  connect()->query("DELETE FROM students WHERE id='$id'");
     
}









/**
 * validate function for error message
 */
function validate($msg,$type='danger'){

  return  "<p class=\" alert alert-$type \"> $msg ! <button class=\"close\" data-dismiss=\"alert\">&times;</button> </p>";
}

/**
 * file uploading function 
 */

 function move($file,$location ='/',array $type=['jpg','png','gif','jpeg']){

//file management
$file_name=$file['name'];
$file_name_tmp=$file['tmp_name'];
$file_arr=explode('.',$file_name);
$file_ext=end($file_arr);
$unique_name=md5(time() . rand()) . '.' . $file_ext;

$msg='';

if(in_array($file_ext,$type)==false){
  $msg=validate('Invail file format');
}else{

  //upload file
  move_uploaded_file($file_name_tmp, $location . $unique_name);
}



return [
 'unique_name' => $unique_name,
 'err_msg'     => $msg

];

 }


?>