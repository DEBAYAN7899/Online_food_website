<?php include('../config/constants.php') ?>

<html>
    <head>
        <title>Login - Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <style>
            body  {
            background-image:linear-gradient(65deg, #2f3542,transparent), url('../images/food_collage.jpg');
            background-repeat: no-repeat;
            background-size: 100% 100%;
            background-attachment: fixed;
            }
        </style>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    </head>

    <body>
        <div class="login">
            <h1 class="text-center">LOGIN</h1>

            <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>

            <br>
            <form action="" method="POST">
                <div class="form-group">
                    <label>UserName</label>
                    <input type="text" name="username" class="form-control" placeholder="Enter UserName">
                    
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter Password" id="exampleInputPassword1">
                </div>
                
                <button type="submit" name="submit" class="btn btn-success btn-lg btn-block">Submit</button>
            </form>
            <br>
            <p class="text-center ">Created by- <a href="https://linktr.ee/debayan" class="badge badge-light">Debayan Jana</a></p>
        </div>
    </body>

<html>


<?php
    if(isset($_POST['submit']))
    {
        
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = md5($_POST['password']);

        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);
        if($count==1)
        {
            $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
            $_SESSION['user'] = $username;
            
            header('location:'.SITEURL.'admin/');
        }
        else
        {
            $_SESSION['login'] = "  <div class='alert alert-danger' role='alert'>UserName or Password did not match.
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>
                                    </div>";
            header('location:'.SITEURL.'admin/login.php');
        }

    }


?>
