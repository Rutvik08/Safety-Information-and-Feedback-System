
<html>
<head lang="en">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.css" rel="stylesheet">

	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">

    <title>Admin Login</title>
</head>
<style>
    .login-panel {
        margin-top: 20px;
}
.lgo-panel {
        margin-bottom: 10px;
}
</style>

<body>

    <div style="height: 100vh">
        <div class="flex-center flex-column">
         

<h1 class="animated fadeIn mb-4">SAFETY INFORMATION & FEEDBACK SYSTEM</h1>
<img src="san_logo.png" class="lgo-panel">
        <div class=" card card-cascade ">
     
   <div class="view overlay">
            <img src="logo.png"  class="mx-auto d-block login-panel  hoverable" alt="">

        </div>

            <div class="view gradient-card-header blue-gradient login-panel ">
                    <h4 class="card-title text-center">Sign In</h4>
                    <h6 class="indigo-text  text-center"><strong>ADMIN PANEL</strong></h6>
                <div class="card-body">
                    <form role="form" method="post" action="admin_login.php">
                        <fieldset>
                       
                            <div class="form-group"  >
                                <input class="form-control" placeholder="Name" aria-describedby="basic-addon3" name="admin_name" type="text" autofocus>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password"  name="admin_pass" type="password" value="">
                            </div>


                            <input class="btn btn-outline-info waves-effect btn-block" type="submit" value="login" name="admin_login" >

                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
	
    </div>

        </div>
 

</body>
	
</html>

<?php

include("database/db_conection.php");

if(isset($_POST['admin_login']))//this will tell us what to do if some data has been post through form with button.
{
    $admin_name=$_POST['admin_name'];
    $admin_pass=$_POST['admin_pass'];

	$temp = md5($admin_pass);
	
    $admin_query="select * from admin where admin_name='$admin_name' AND admin_pwd='$temp'";

    $run_query=mysqli_query($dbcon,$admin_query);

    if(mysqli_num_rows($run_query)>0)
    {

        echo "<script>window.open('view_feedback.php','_self')</script>";
        
    }
    else {echo"<script>alert('Admin Details are incorrect..!')</script>";}

}

?>