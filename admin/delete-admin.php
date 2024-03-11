<?php 
//Include constants.php file here
include('../config/constants.php'); 
//1.get the id of admin to be deleted
echo $id =$_GET['id'];
//2.create sql query to delete admin
$sql="DELETE FROM tbl_admin WHERE id=$id";
//Execute the query
$res=mysqli_query($conn,$sql);
//Check whether the query executed successfully or not
if($res==TRUE){
//Quert executed successfully and admin is deleted
// echo "Successfully Deleted Admin";
//Create session variable to display message
$_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully.</div>";
//Redirect to manage admin page
header('location:'.SITEURL.'admin/manage-admin.php');

}
else{
//Failed to delete admin
// echo"Failed to Delete Admin";
$_SESSION['delete']="<div class='error'>Failed to  Delete Admin.Try Again Later.</div>";
//Redirect to manage admin page
header('location:'. SITEURL .'admin/manage-admin.php');

}
//3.redirect to manage admin page with message(success/error)
?>