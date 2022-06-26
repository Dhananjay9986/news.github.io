<?php include "header.php"; ?>
<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading">Update Post</h1>
    </div>
    <div class="col-md-offset-3 col-md-6">
        <?php
        include "config.php";
        
          //niche diye gaye tarki ke madat se ham given div me data ki limit ko tay kar sakte hay//
          $sql="SELECT * FROM settings1 "; 
        

            $result=mysqli_query($conn,$sql) or die("query_faild");
            if(mysqli_num_rows($result) > 0){
                while($row=mysqli_fetch_assoc($result)){
                    
                    
                
                
         ?>
        <!-- Form for show edit-->
        <form action="save-setting.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <!--for attributes represent the id ,which is define for label-->
                <label for="website_name">Website Name</label>
                <input type="text" name="website_name" class="form-control" autocomplete="off" value="<?php echo $row['websitename'];?>" required>
                </div>
                <div class ="form-group">
                    <label for ="logo">Website Logo </label>
                    <input type="file" name ="logo">
                    <img src="images/<?php echo $row['logo'];?>" height="150px">
                    <input type="hidden" name="old_logo" value="<?php echo $row['logo'];?>">
                </div>
                <div class="from-group">
                    <label for ="footer_desc">Footer Description</label>
                    <textarea name="footer_desc" class="from-control" rows="5" colom="5" required>
                        <?php echo $row['footerdesc'];?>
                    </textarea>
                </div>
                <input type="submit" value="save" name="submit" class="btn btn-primary" required/>
                </from>
                <?php
                }
            }
            ?>
            </div>
            </div>
      </div>
  </div>
<?php include "footer.php"; ?>
                
