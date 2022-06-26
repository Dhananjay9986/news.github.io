<?php
include "config.php";
if(empty($_FILES['new-image']['name'])){
$new_name = $_POST['old-image'];
}else{
    $errors = array();

    $file_name =$_FILES['new-image']['name'];
    $file_size =$_FILES['new-image']['size'];
    $file_tmp =$_FILES['new-image']['tmp_name'];
    $file_type =$_FILES['new-image']['type'];

    $file_ext =(end(explode('.',$file_name)));
    $extensions = array('jpeg','jpg','png');
    //in-array ka matalab hota hay ki ,esme do array ki file ki jarurat hotihay pahali array ki file ke data ko dusari file ke data me serch kiya jata hay ki usme ho hay ki nhi//

    if(in_array($file_ext,$extensions) === false){
        $errors[]= "this extension file not allow,please choose a jpg or png file,";
        
    }
    if ($file_size>2097152){
        $errors[]="file size must be 2mb or lower ";
    }
    $new_name=time()."-".basename($target);
    
    $target="upload/".time()."-".basename($target);
    if(empty($errors)===true){
        move_uploaded_file($file_tmp,$target);
    }else{
        print_r($errors);
        die();
    }
    
}
$post_title=$_POST['post_title'];
$description=$_POST['postdesc'];
$category=$_POST['category'];
$image_name=$new_name;
$post_id=$_POST['post_id'];

  $sql1 = "UPDATE post SET title='{$post_title}',description='{$description}',category=$category,post_img='{$image_name}' 
 WHERE post_id={$post_id} ;";
 if($_POST['old_category']!== $_POST['category']){

 
  $sql1.="UPDATE category SET post=post-1 WHERE category_id={$_POST['old_category']};";

$sql1.="UPDATE category SET post=post+1 WHERE category_id={$_POST['category']}";
 }

$result=mysqli_multi_query($conn,$sql1);

if($result){
    header("location:{$hostname}/admin/post.php");
}else{
    echo "Query Failed";
}


