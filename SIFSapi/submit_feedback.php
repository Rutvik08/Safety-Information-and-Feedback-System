<?php
 header('Access-Control-Allow-Origin: *');
require_once '../SIFSapi/DB_Functions.php';
include '../SIFSapi/ChromePhp.php';
error_reporting(0);
$db = new DB_Functions();

$obj = json_decode(file_get_contents('php://input'));

$fid = $obj->fid;
$fname = $obj->fname;
$flname = $obj->flname;
$fsgender = $obj->fsgender;
$fsdate = $obj->fsdate;
$fstime = $obj->fstime;
$freason = $obj->freason;
$frate = $obj->frate;
$ftitle = $obj->ftitle;
$flat = $obj->flat;
$flog = $obj->flog;
 
        // create a new feedback
        $feedback = $db->storeFeedback($fid,$ftitle, $fname, $flname, $fsgender,$fsdate,$fstime,$freason,$frate,$flat,$flog);
        if ($feedback) {
            // feedback stored successfully
            $response["error"] = FALSE;
            $response["error_msg"]= "Feedback Submitted Sucessfully.";
         
            echo json_encode($response);
        } else {
            // user failed to store
            $response["error"] = TRUE;
            $response["error_msg"] = "Unknown error occurred in Submitting Feedback!";
            echo json_encode($response);
        }

?>