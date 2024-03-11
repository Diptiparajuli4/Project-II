
<?php include('../config/constants.php') ?>
<html>
<head>
    <title>Login -Online Food Order System </title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="login">
            <h1 class="text-center">Login Here</h1>
            <br><br>
            <?php 
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset ($_SESSION['login']);
            }
            if(isset($_SESSION['no-login-message']))
            {
                echo $_SESSION['no-login-message'];
                unset ($_SESSION['no-login-message']);
            }
            ?>
            <br><br>
            <form action="#" method="POST" class="text-center">
                Username:<br>
                <input type="text" name="username"placeholder="Enter Your Username Here" required></br><br>
                Password:<br>
                <input type="password" name="password"placeholder="Enter Password Here" required></br><br>
                <input type="submit" name="submit" value= "Login" class="btn-primary" required>
                
            </form>
   
</div>
</body>

</html>

<?php
//check whether the submit button is clicked or not
if(isset($_POST['submit'])){
    //process for login
    //get data from logi form
    $username=$_POST['username'];
    $password=md5($_POST['password']);
    //swl to check whether the user with username or password exist or not
    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
    //execute the query
    $res= mysqli_query($conn,$sql);
    //count row to check whether the user exist or not
    $count=mysqli_num_rows($res);
    if($count==1){
        $_SESSION['login']="<div class='success'>Login Successful.</div>";
        $_SESSION['username']=$username;//to check whether the username is logged in or not and logout will unset it
        header('location:'.SITEURL.'admin/');
        exit();
    }   
    else{
        $_SESSION['login']="<div class='error text-center'>Incorrect Username or Password.</div>";
        header('location:'.SITEURL.'admin/login.php');
        exit();
    }
}




?>