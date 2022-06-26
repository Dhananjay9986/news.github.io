<?php
include "config.php";
$post_id=$_GET['id'];
$cat_id=$_GET['catid'];
$sql1="SELECT * FROM post WHERE post_id={$post_id}";
$result=mysqli_query($conn,$sql1) or die("query fail:select");
$row=mysqli_fetch_assoc($result);
//yha unlink hi folder me say image ko delete kar rha ahy//
unlink("upload/".$row['post_img']);


$sql="DELETE FROM post where post_id={$post_id};";
$sql.="UPDATE category SET post=<post-1 WHERE category_id={$cat_id}";
if(mysqli_multi_query($conn,$sql)){
    header("location:{$hostname}/admin/post.php");
}else{
    echo "QUERRY FAILED.";
}
?>