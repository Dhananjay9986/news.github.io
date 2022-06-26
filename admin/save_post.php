<?php
include "config.php";
if(isset($_FILES["fileToUpload"])){
    $errors=array();
    
    $file_name =$_FILES['fileToUpload']['name'];
    $file_size =$_FILES['fileToUpload']['size'];
    $file_tmp =$_FILES['fileToUpload']['tmp_name'];
    $file_type =$_FILES['fileToUpload']['type'];
    $file_ext =(end(explode('.',$file_name)));
    $extensions = array("jpeg","jpg","png");
    //in-array ka matalab hota hay ki ,esme do array ki file ki jarurat hotihay pahali array ki file ke data ko dusari file ke data me serch kiya jata hay ki usme ho hay ki nhi//

    if(in_array($file_ext,$extensions) === false){
        $errors[]= "this extension file not allow,please choose a jpg or png file,";
        
    }
    if ($file_size>2097152){
        $errors[]="file size must be 2mb or lower than";

    }
    $new_name=time()."-".basename($file_name);
    $target="upload/".time()."-".basename($file_name);
    if(empty($error)===true){
        move_uploaded_file($file_tmp,$target);
    }else{
        print_r($errors);
        die();
    }
    

}
session_start();
$title=mysqli_real_escape_string($conn,$_POST["post_title"]);
$description=mysqli_real_escape_string($conn,$_POST["postdesc"]);
$category=mysqli_real_escape_string($conn,$_POST["category"]);
$date= date("d,M,Y");
$author=$_SESSION["user_id"];

$sql="INSERT INTO post(title,description,category,post_date,author,post_img)
VALUES('$title','$description','$category','$date','$author','$new_name');";
$sql.="UPDATE category SET post = post + 1 WHERE category_id = '$category'";


if(mysqli_multi_query($conn,$sql)){
    header("location:{$hostname}/admin/post.php");
}else{
    echo "<div class ='alert alert-danger'> Query Failed.</div>";
}

