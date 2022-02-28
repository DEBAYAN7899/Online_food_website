<?php include('partials/menu.php'); ?>

<div class="main-conient">
    <div class="wrapper">
        <br>
        <h1>ADD Category</h1>
        <br><br>
        <?php
            
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

        ?>
        <br>
        

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-40">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
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
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="NO"> No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="NO"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-sec">
                    </td>
                </tr>
            </table>

        </form>

        <?php
            if(isset($_POST['submit']))
            {
                $title = $_POST['title'];
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured = "No";
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No";
                }

                //print_r($_FILES['image']);
                if(isset($_FILES['image']['name']))
                {
                    $image_name = $_FILES['image']['name'];
                    
                    if($image_name != "")
                    {

                        //Auto rename image
                        $ext = end(explode('.', $image_name));
                        $image_name = "Food_Category_".rand(000, 999).'.'.$ext;
                        

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/category/".$image_name;
                        $upload = move_uploaded_file($source_path, $destination_path);

                        if($upload==FALSE)
                        {
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                            header('location:'.SITEURL.'admin/add-category.php');
                            die();
                        }
                    }
                }
                else
                {
                    $image_name="";
                }
                

                $sql = "INSERT INTO tbl_categories SET
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                
                ";
                $res = mysqli_query($conn, $sql);
                if($res==TRUE)
                {
                    $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    $_SESSION['add'] = "<div class='error'>Failed to Added Successfully.</div>";
                    header('location:'.SITEURL.'admin/add-category.php');
                }

            }

        ?>


    </div>
</div>

<?php include('partials/footer.php'); ?>