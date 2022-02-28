<?php
    include('../config/constants.php');
    //echo "Delete page"
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //echo "Get value delete";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        if($image_name != "")
        {
            $path = "../images/category/".$image_name;
            $remove = unlink($path);
            if($remove==FALSE)
            {
                $_SESSION['remove'] = "<div class = 'error'>Faile to remove category image.</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
                die();
            }
        }

        $sql = "DELETE FROM tbl_categories WHERE id=$id";

        $res = mysqli_query($conn, $sql);

        if($res==TRUE)
        {
            $_SESSION['delete'] = "<div class='success'>Category Delete Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Category.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
    }
    else
    {
        header('location:'.SITEURL.'admin/manage-category.php');
    }

?>