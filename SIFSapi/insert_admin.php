<?php
 
 header('Access-Control-Allow-Origin: *');
require_once '../SIFSapi/DB_Functions.php';
include '../SIFSapi/ChromePhp.php';

$db = new DB_Functions();
 error_reporting(E_ALL & ~E_NOTICE);
  
        // fetch transactions
		
		$dbhost = 'localhost';
		$my_db = "sifs";
		$dbuser = 'root';
		$dbpass = '';
		$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
		if(! $conn )
		{
			die('Could not connect: ' . mysqli_error());
        }
        $pwd = md5("rutvik");
	    $sql = "UPDATE admin set admin_pwd = '$pwd'  WHERE admin_name = 'admin'";
   
		mysqli_select_db($conn, $my_db);
		$retval = mysqli_query( $conn, $sql );
		if(! $retval )
		{
			die('Could not get data: ' . mysqli_error($conn));
		}
		$transaction = $retval;

        if($transaction){
			alert('Password Updated');
           }else {
            alert('Error occured in Password updation.');   
			}
?>