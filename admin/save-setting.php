<?php
include "config.php";
if(empty($_FILES['logo']['name'])){
$file_name = $_POST['old_logo'];
}else{
    $errors = array();

    $file_name =$_FILES['logo']['name'];
    $file_size =$_FILES['logo']['size'];
    $file_tmp =$_FILES['logo']['tmp_name'];
    $file_type =$_FILES['logo']['type'];
    $ext=explode('.',$file_name);

    $file_ext =end($ext);
    $extensions = array("jpeg","jpg","png");
    //in-array ka matalab hota hay ki ,esme do array ki file ki jarurat hotihay pahali array ki file ke data ko dusari file ke data me serch kiya jata hay ki usme ho hay ki nhi//

    if(in_array($file_ext,$extensions) === false){
        $errors[]= "this extension file not allow,please choose a jpg or png file,";
        
    }
    if ($file_size>2097152){
        $errors[]="file size must be 2mb or lower ";
    }
    if(empty($errors)===true){
        move_uploaded_file($file_tmp,"images/".$file_name);
    }else{
        print_r($errors);
        die();
    }
    
}
$post_title=$_POST['website_name'];
$description=$_POST['footer_desc'];

$image_name=$file_name;


 $sql1 = "UPDATE settings1 SET websitename='{$post_title}',footerdesc='{$description}',logo='{$file_name}'";
 

$result=mysqli_query($conn,$sql1);

if($result){
    header("location:{$hostname}/admin/settings.php");
}else{
    echo "Query Failed";
}


?>