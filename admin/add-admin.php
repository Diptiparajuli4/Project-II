<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>
        <?php 
            if(isset($_SESSION['add'])){//Checkin whether the session is set or not
                echo ($_SESSION['add']);//Displaying session message if set
                unset ($_SESSION['add']);//Remove session message
            }
        ?>
        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Your Name" required>
                    </td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" placeholder="Your Username" required>
                    </td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" name="password" placeholder="Your Password" required>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>


<?php include('partials/footer.php');?>
<?php 
//Process the value from Form and save it to Database
//Check whether the submit button is clicked or not
if(isset($_POST['submit'])){//This function checks whether the value on submit is passed through postmethod or not
 //Button Clicked
    // echo"Button Clicked";
    //1.Get Data from form
     $full_name = $_POST['full_name'];
     $username = $_POST['username'];
     $password = md5($_POST['password']);//password encryption with md5
     //2.SQL Query to save data in database
     $sql = "INSERT INTO tbl_admin SET 
        full_name = '$full_name',
        username = '$username',
        password = '$password' 
     ";
     
     //3.Execute Query and save data in database
     $res=mysqli_query($conn,$sql) or die(mysqli_error());
    //4.Check whether the(Query is Executed) data is  inserted or not and display appropriate message
        if($res==TRUE){
            //DATA INSERTED
            // echo"Data Inserted Successfully";
            //Create a session variable to display message
            $_SESSION['add']="<div class='success'>Admin Added Successfully.</div>"."<br>";
            //Redirect page to manage admin
            header("location:".SITEURL.'admin/manage-admin.php');

        }
        else{
            //FAILED TO INSERT DATA
            // echo"Failed to  insert data";
            $_SESSION['add']="<div class='error'>Failed to  Add Admin .</div>"."<br>";
            //Redirect page to add admin
            header("Location:".SITEURL.'admin/manage-admin.php');

        }

    }



?>