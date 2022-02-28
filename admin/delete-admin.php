<?php
    include('../config/constants.php');
    $id = $_GET['id'];
    $sql = "DELETE FROM tbl_admin WHERE id=$id";
    $res = mysqli_query($conn, $sql);
    if($res==TRUE)
    {
        //echo "Admin Deleted";
        $_SESSION['delete'] = "<div class ='success'>Admin Deleted</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        //echo "Failed to Delete Admin";
        $_SESSION['delete']= "<div class ='error'>Failed to Delete admin. Try again</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
?>