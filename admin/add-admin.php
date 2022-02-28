<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        
        <br><br>
        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>FullName:</td>
                    <td><input type="text" name="full_name" placeholder="Enter your name"></td>
                </tr>
                <tr>
                    <td>UserName: </td>
                    <td><input type="text" name="username" placeholder="Enter UserName"></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="Your Password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-sec">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php
    if(isset($_POST['submit']))
    {
        //get data
        $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = md5($_POST['password']);

        //sql save data
        $sql = "INSERT INTO tbl_admin SET
            full_name='$full_name',
            username='$username',
            password='$password'
        ";
        //saving in database
        $res = mysqli_query($conn, $sql) or die(mysqli_error());
        //check
        if($res==TRUE)
        {
            //echo "Data Insert";
            $_SESSION['add'] = "<div class='success'>Admin Added successfully</div>";
            //redirect
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else
        {
            $_SESSION['add'] = "<div class='error'>Failed to ADD</div>";
            //redirect
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        
    }
?>