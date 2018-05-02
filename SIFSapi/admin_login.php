<?php
header('Access-Control-Allow-Origin: *');
require_once '../SIFSapi/DB_Functions.php';
$db = new DB_Functions();
error_reporting(E_ALL & ~E_NOTICE);
// json response array
//$obj = json_decode(stripcslashes($_POST['r']));

$response = array("error" => FALSE);
$obj = json_decode(file_get_contents('php://input'));
 $admin_email = $obj->admin_email;
 $admin_pwd = $obj->admin_pwd;
 
    // get the user by admin_email and admin_pwd
    $user = $db->getUserByEmailAndPassword($admin_email, $admin_pwd);
 header('Content-Type: application/json');
    if ($user != false) {
        // use is found
        $response["error"] = FALSE;
        $response["user"]["id"] = $user["id"];
        $response["user"]["admin_name"] = $user["admin_name"];
        $response["user"]["admin_email"] = $user["admin_email"];
      
        echo json_encode($response);
    } else {
        // user is not found with the credentials
        $response["error"] = TRUE;
        $response["error_msg"] = "Login credentials are wrong. Please try again!";
        echo json_encode($response);
    }

?>