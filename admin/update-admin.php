<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin </h1>
        <br><br>
        
        <?php 
        //Get the id of selected admin
        $id=$_GET['id'];
        //create sql query to get the details of admin
        $sql="SELECT * FROM tbl_admin WHERE id=$id";
        //Execute the Query
        $res=mysqli_query($conn,$sql);
        //check whether the query is executed or not
        if($res==TRUE){
            //Check whether the data is available or not
            $count=mysqli_num_rows($res);
            //Check whether we have admin data or not
            if($count==1){
                $rows=mysqli_fetch_assoc($res);
                $full_name=$rows['full_name'];
                $username=$rows['username'];

            }
            else
        {
        
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        }
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
            <tr>
                    <td>ID:</td>
                    <td>
                        <input type="number" name="id" placeholder="id" value="<?php echo $id;?>" required>
                    </td>
                </tr>
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Your Name" value="<?php echo $full_name;?>" required>
                    </td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" placeholder="Your Username" value="<?php echo $username;?>" required>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
                </tr>

            </table>

        </form>

    </div>
</div>
<?php 
    //Check whether the submit button is clicked or not
    if(isset($_POST['submit'])){
        //Get all the values from form to update
        $id=$_POST['id'];
        $full_name=$_POST['full_name'];
        $username=$_POST['username'];
        //create sql query to update Admin
        $sql="UPDATE tbl_admin SET
        full_name='$full_name',
        username='$username'
        WHERE id='$id'
        ";
        //execute the query
        $res=mysqli_query($conn,$sql);
            if($res==TRUE){
                $_SESSION['update'] = "<div class='success'>Admin Updated Successfully.</div>";
                header('location:'.SITEURL.'admin/manage-admin.php');

            }
            else{
                $_SESSION['update']="<div class='error'>Failed to  Update Admin.Try Again Later.</div>";
                header('location:'. SITEURL .'admin/manage-admin.php');

            }
        }
    
?>

<?php include('partials/footer.php');?>