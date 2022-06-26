<?php include "header.php";
if($_SESSION["user_role"]=='1'){
    header("Location:$hostname/admin/users.php");
}


?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Users</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-user.php">add user</a>
              </div>
              <div class="col-md-12">
                  <?php
                 
                 //yaha es liye es method ka use kiya gaya kuki get method ka use kol <li> ke 123 button per hi ho rha hay wapas se user per click karne per get method ka use nhi ho payega kuki hamni keol <li> per hilink diya hay//
                  //by get method ham diye gaye <li>ki href link se id valu ko le sakte hay//
                 include "config.php";

                  $limit=3;
                 if(isset($_GET['page'])){
                     $page=$_GET['page'];
                 }else{
                     $page=1;
                 }
                 
                  $offset=($page-1)*$limit;
                  //niche diye gaye tarki ke madat se ham given div me data ki limit ko tay kar sakte hay//
                  $sql="SELECT *FROM user ORDER BY user_id DESC LIMIT $offset,$limit";
                  $result=mysqli_query($conn,$sql) or die("query_faild");
                  if(mysqli_num_rows($result) > 0){
                      ?>
                      
                  <table class ="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Full Name</th>
                          <th>User Name</th>
                          <th>Role</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                          <!--yha while loop ki madat se har id ke liye data fetch karte hay--->
                      <?php while($row=mysqli_fetch_assoc($result)){
                          ?>

                          <tr>
                              <td class='id'><?php echo $row['user_id']; ?></td>
                              <td><?php echo $row['first_name']. " " .$row['last_name'];?> </td>
                              <td><?php echo $row['username']?></td>
                              <td>
                                  <?php
                            if  ($row['role']==1){
                                echo"Admin";
                            }else{
                            echo"normal";
                            }
                                  
                                  ?></td>
                              <td class='edit'><a href='update-user.php?id=<?php echo $row["user_id"];?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-user.php?id=<?php echo $row["user_id"];?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                     <?php }?>
                         
                      </tbody>
                  </table>
                  <?php

                      }else{
                          echo"<h3>no result found .</h3>";

                      }
                      
                      $sql1="SELECT * FROM user";
                      $result1=mysqli_query($conn,$sql1) or die("connection failed");
                      if(mysqli_num_rows($result1)>0){
                          $total_records=mysqli_num_rows($result1);

                          $limit=3;
                          $total_page= ceil($total_records/$limit);
//pagination //
                       echo '<ul class="pagination admin-pagination">';
                       if($page>1){
                           echo '<li><a href="users.php?page='.($page-1).'">PREV</a></li>';
                       }

                          for($i=1;$i<=$total_page;$i++){
                              if($i==$page){
                                  $active="active";
                              }else{
                                  $active="";
                              }
                              echo '<li class="'.$active.'"><a href="users.php?page='.$i.'">'.$i.'</a></li>';

                          }
                          if($total_page>$page){
                          echo'<li><a href="users.php?page='.($page+1).'">NEXT</a>';
                          }
                          echo '</ul>';
                        }
                        ?>

                      
                      
        
                      <!--<li class="active"><a>1</a></li>-->
                      
                
                  
              </div>
          </div>
      </div>
  </div>
  

<?php include "header.php"; ?>
