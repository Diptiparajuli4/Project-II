<?php include("partials/menu.php");?>
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1><br><br> 
        <?php 
        if(isset($_SESSION['add'])){//Checkin whether the session is set or not
            echo ($_SESSION['add']);//Displaying session message if set
            unset ($_SESSION['add']);//Remove session message
        } 
        if(isset($_SESSION['remove'])){//Checkin whether the session is set or not
            echo ($_SESSION['remove']);//Displaying session message if set
            unset ($_SESSION['remove']);//Remove session message
        } 
       
        if(isset($_SESSION['delete'])){//Checkin whether the session is set or not
            echo ($_SESSION['delete']);//Displaying session message if set
            unset ($_SESSION['delete']);//Remove session message
        } 
        if(isset($_SESSION['no-category-found'])){//Checkin whether the session is set or not
            echo ($_SESSION['no-category-found']);//Displaying session message if set
            unset ($_SESSION['no-category-found']);//Remove session message
        } 
        if(isset($_SESSION['update'])){//Checkin whether the session is set or not
            echo ($_SESSION['update']);//Displaying session message if set
            unset ($_SESSION['update']);//Remove session message
        } 
        if(isset($_SESSION['upload'])){//Checkin whether the session is set or not
            echo ($_SESSION['upload']);//Displaying session message if set
            unset ($_SESSION['upload']);//Remove session message
        } 
        if(isset($_SESSION['failed-remove'])){//Checkin whether the session is set or not
            echo ($_SESSION['failed-remove']);//Displaying session message if set
            unset ($_SESSION['failed-remove']);//Remove session message
        }
        ?>
        <br><br>
        <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a><br><br><br>  
                
            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
                <?php  
                //Query to get all category from database
                $sql ="SELECT * FROM tbl_category";
                //execute query
                $res=mysqli_query($conn,$sql);
                //count the rows
                $count=mysqli_num_rows($res);
                //create serial numbering variable
                $sn=1;

                //to check whether we have data in database or not
                if($count>0){
                    while($rows=mysqli_fetch_assoc($res)){
                        $id= $rows['id'];
                        $title= $rows['title'];
                        $image_name= $rows['image_name'];
                        $featured= $rows['featured'];
                        $active= $rows['active'];
?>

    <tr>
    <td><?php echo $sn++;?>.</td>
    <td><?php echo $title ;?></td>

    <td>
        <?php  
        //check whether the image name is available or not
        if($image_name!=""){
            ?>
            <img class="images" src="<?php echo SITEURL;?>images/<?php echo $image_name;?>" width="100px">
        <?php
        }
        else{
            echo "<div class='error'>Image not added .</div>"."<br>";
        }
        ?>
    </td>

    <td><?php echo $featured ;?></td>
    <td><?php echo $active ;?></td>
  
   
    <td>
        <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
        <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id?> & image_name=<?php echo $image_name?>" class="btn-danger">Delete Category</a>
    </td>
</tr>
<?php

                    }
                }
                else{

                
                ?>
                
                <tr>
                    <td colspan="6"><div class='error'>No Category Added.</td>
                </tr>
                <?php
                }
                ?>

            
            
            </table>  
            </div>
</div>


<?php include("partials/footer.php");?>