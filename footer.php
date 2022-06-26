<div id ="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <?php
        include "config.php";
        
          //niche diye gaye tarki ke madat se ham given div me data ki limit ko tay kar sakte hay//
          $sql="SELECT * FROM settings1 "; 
        

            $result=mysqli_query($conn,$sql) or die("query_faild");
            if(mysqli_num_rows($result) > 0){
                while($row=mysqli_fetch_assoc($result)){
                    ?>
                <span><?php echo $row['footerdesc'];?></span>
                <?php
                }
            }
                ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
