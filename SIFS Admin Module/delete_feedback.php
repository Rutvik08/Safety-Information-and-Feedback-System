<?php

include("database/db_conection.php");
$delete_id=$_GET['del'];
$delete_query="update feedback SET isActive=0 WHERE id='$delete_id'";//delete query
$run=mysqli_query($dbcon,$delete_query);
if($run)
{
//javascript function to open in the same window
    echo "<script>window.open('view_feedback.php?deleted=feedback has been deleted','_self')</script>";
}

?>