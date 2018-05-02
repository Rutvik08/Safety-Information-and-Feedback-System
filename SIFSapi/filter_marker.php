<?php
 
 header('Access-Control-Allow-Origin: *');
require_once '../SIFSapi/DB_Functions.php';
include '../SIFSapi/ChromePhp.php';

$db = new DB_Functions();
 error_reporting(E_ALL & ~E_NOTICE);
// json response array
$response = array("error" => FALSE);
 
$obj = json_decode(file_get_contents('php://input'));
 $time = $obj->fstime;
 $gender = $obj->fgender;
 $rate = $obj->frate;
 
  
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
        
	 $query = "SELECT * FROM feedback WHERE isActive =1 AND ";
     $conditions = array();


    if(! empty($time) && $time !='Select Time') {
      $conditions[] = "f_stime='$time'";
    }
	
    if(! empty($rate) && $rate !='Select Rating') {
      $conditions[] = "f_rate='$rate'";
    }
	
    if(! empty($gender) && $gender != 'a') {
      $conditions[] = "f_sgender='$gender'";
    }
       
    $sql = $query;
    if (count($conditions) > 0) {
      $sql .= implode(' AND ', $conditions);
    }	
		

		mysqli_select_db($conn, $my_db);
		$retval = mysqli_query( $conn, $sql );
		if(! $retval )
		{
			die('Could not get data: ' . mysqli_error($conn));
		}
		$transaction = $retval;
			
           
		 header('Content-Type: application/json');
        if($transaction){
					$return_arr = array();
			 $response["error"] = FALSE;
   while ($row = mysqli_fetch_array($transaction)) {
           
            $feedback["title"] = $row["f_title"];
            $feedback["reason"] = $row["f_reason"];
            $feedback["rate"] = $row["f_rate"];
            $feedback["date"] = $row["f_sdate"];
            $feedback["time"] = $row["f_stime"];
            $feedback["latitude"] = $row["f_latitude"];
			$feedback["longitude"] = $row["f_longitude"];
			$feedback["id"] = $row["id"];
			
			array_push($return_arr,$feedback);
}
   $response["feedback"] = $return_arr;
	echo json_encode($response);
	} else {
            // user failed to store
            $response["error"] = TRUE;
            $response["error_msg"] = "Unknown error occurred in fetching Feedbacks!";
            echo json_encode($response);
        }
	

?>