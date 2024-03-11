<?php  include('partials/menu.php');
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1><br><br> 
        <?php 
        if(isset($_GET['id']))
        {
            
            $id=$_GET['id'];
            $sql ="SELECT * FROM tbl_category WHERE id=$id";
            $res=mysqli_query($conn,$sql);
            $count=mysqli_num_rows($res);
            if($count==1){
                $rows=mysqli_fetch_assoc($res);
                $title=$rows['title'];
                $current_image=$rows['image_name'];
                $featured =$rows['featured'];
                $active=$rows['active'];
            }
            else
                {
                
                    $_SESSION['no-category-found'] = "<div class='error'>Category not found.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                
                }
                else{
                    header('location:' .SITEURL. 'admin/manage-category.php');
                }
                
                
        ?>
    <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-30">
            <tr>
                <td>Title:</td>
                <td>
                <input type="text" name="title" placeholder="Category Title" value="<?php echo $title; ?>">
                </td>
            </tr>
            <tr>
                <td>Current Image:</td>
                <td>
            <?php
                if($current_image!= "")
                {
                    ?>
                    <img src="<?php echo SITEURL; ?>images/<?php echo $current_image; ?>" width="75px" height="50px">
                    <?php
                }
                else
                {
                    echo "<div class='error'>Image not added</div>";
                }
            
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                    <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes" >Yes

                    <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No" >No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                    <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes" >Yes

                    <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No" >No
                    </td>
                </tr>
                <tr>
                    <td>
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">

                    <input type="hidden" name="id" value="<?php echo $id; ?>">



                    <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php 
            if(isset($_POST['submit']))
            {
                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];
                //updating new image if selected
                if(isset($_FILES['image']['name']))
                {
                    $image_name =$_FILES['image']['name'];
                    if($image_name!="")
                    {//1. upload the new image
                        $ext= end(explode('.',$image_name));

                        //rename the image
                        $image_name ="Food_Category_".rand(000,999).'.'.$ext;//our new image name is Food_Category_123.jpg
                        $source_path = $_FILES['image']['tmp_name'];
    
                        $destination_path = "../images/".$image_name;
                        //Finally upload the image
                        $upload = move_uploaded_file($source_path,$destination_path);
                        //check whether the image is uploaded or not
                        //And if the image is not uploaded then we will stop the process and redirect with error message
                        if($upload==false){
                            //set message
                            $_SESSION['upload']="<div class='error'>Failed to upload Image.</div>"."<br>";
                            header('location:'.SITEURL.'admin/manage-category.php');
                            //stop the process
                            die();
                        }  
                        //2.Remove the current image
                        if($current_image!=""){
                            $remove_path="../images/".$current_image;
                            $remove= unlink($remove_path);
                            if($remove==false){
                                $_SESSION['failed-remove']="<div class='error'>Failed to remove current image.</div>";
                                header('location:'.SITEURL.'admin/manage-category.php');
                                die();
                                
                            }
                        }
                    }
                    else
                    {
                        $image_name = $current_image;
                    }

                 }
                else
                {
                    $image_name = $current_image;
                }


                //update the database
                $sql2 = "UPDATE  tbl_category SET
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active'
                    WHERE id=$id
                ";
                //execute the query
                $res2 = mysqli_query($conn, $sql2);
                //redirect to manage category with message
                //first check executed or not
                    if($res2==true)
                    {
                        $_SESSION['update']="<div class='success'>Category Updated Successfully.</div>";
                        header('location:'.SITEURL.'admin/manage-category.php');
                    }
                    else
                    {
                        $_SESSION['update']="<div class='error'>Failed to  Update Category.</div>";
                        header('location:'.SITEURL.'admin/manage-category.php');
                    
                    }
                }

?>
    </div>
</div>



<?php  include('partials/footer.php');?>