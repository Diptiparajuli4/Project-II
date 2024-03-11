<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1><br><br>  
        <?php 
         if(isset($_SESSION['add'])){//Checkin whether the session is set or not
            echo ($_SESSION['add']);//Displaying session message if set
            unset ($_SESSION['add']);//Remove session message
        }
        if(isset($_SESSION['upload'])){//Checkin whether the session is set or not
            echo ($_SESSION['upload']);//Displaying session message if set
            unset ($_SESSION['upload']);//Remove session message
        }
        
        ?>
        <br><br>
        <!-- Add category form start -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                    <input type="text" name="title" placeholder="Category Title"required >
                    </td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                    <input type="radio" name="featured" value="Yes" >Yes
                    <input type="radio" name="featured" value="No" >No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                    <input type="radio" name="active" value="Yes">Yes
                    <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                    <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
        <!-- Add category form ends -->
        <?php 
        //check whether the submit button is clicked or not
        if(isset($_POST['submit']))
        {
            //get value from thr category form
            $title=$_POST['title'];
            //for radio input type we need to check whether the button is selected or not 
            if(isset($_POST['featured'])){
                //get value from form
            $featured = $_POST['featured'];
            }
            else{   
                $featured = "No";
            }
            if(isset($_POST['active'])){
                //get value from form
            $active=$_POST['active'];
            }
            else{   
                $active = "No";
            }
            //check whether the image is selected or not and set the value for image name accordingly
            // print_r($_FILES['image']);
            //     die();//Break the code here
            if(isset($_FILES['image']['name'])){
                //to upload image we need image name, source path and destination path
            $image_name = $_FILES['image']['name'];
            //Upload image only if image is selected 
                if($image_name !="")
                {
                
                    //create session to rename our image
                    //Gey-t extension of our image(jpg,png,gif,etc) eg: "food.jpg"
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
                        header('location:'.SITEURL.'admin/add-category.php');
                        //stop the process
                        die();
                    }
                }

            }
            else{
                $image_name="";
            }
            
            //create sql query to insert category into database
            $sql="INSERT INTO tbl_category SET
                title='$title',
                image_name='$image_name',
                featured='$featured',
                active='$active'
            ";
            //execute the query and save in database
            $res = mysqli_query($conn,$sql);
            //check whether the query executed or not
            if($res==TRUE){
                $_SESSION['add']="<div class='success'>Category Added Successfully.</div>"."<br>";
                header('location:'.SITEURL.'admin/manage-category.php');
                }
            else{
                $_SESSION['add']="<div class='error'>Failed to Add Category.</div>"."<br>";
                header('location:'.SITEURL.'admin/add-category.php');
                

            }
        }
        
        ?>
       
    </div>
</div>

<?php include('partials/footer.php'); ?>