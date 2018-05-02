<?php
 
class DB_Functions {
 
    private $conn;
 
    // constructor
    function __construct() {
        require_once '../SIFSapi/DB_Connect.php';
        // connecting to database
        $db = new Db_Connect();
        $this->conn = $db->connect();
    }
 
    // destructor
    function __destruct() {  
    }
 
    /**
     * Storing new feedback
     */
    public function storeFeedback($fid,$ftitle, $fname, $flname, $fsgender,$fsdate,$fstime,$freason,$frate,$flat,$flog) {
       
        $stmt = $this->conn->prepare("INSERT INTO feedback(f_id,f_fname,f_lname,f_sgender,f_sdate,f_stime,f_reason,f_rate,f_latitude,f_longitude,f_title) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)");
        $stmt->bind_param("sssssssssss",$fid, $fname, $flname, $fsgender,$fsdate,$fstime,$freason,$frate,$flat,$flog,$ftitle);
        $result = $stmt->execute();
        $stmt->close();
 
        // check for successful store
        if ($result) {
            $stmt = $this->conn->prepare("SELECT * FROM feedback WHERE f_reason = ? && isActive = 1");
            $stmt->bind_param("s", $freason);
            $stmt->execute();
            $feedback = $stmt->get_result()->fetch_assoc();
            $stmt->close();
 
            return $feedback;
        } else {
            return false;
        }
    }
	
	
    public function getUserByEmailAndPassword($admin_email, $admin_pwd) {
 
        $stmt = $this->conn->prepare("SELECT * FROM admin WHERE admin_email = ?");
 
        $stmt->bind_param("s", $admin_email);
 
        if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
 
           
            $encrypted_password = $user['admin_pwd'];
            // check for password equality
            if ($encrypted_password == $admin_pwd) {
                // user authentication details are correct
                return $user;
            } else {
            return NULL;
        }
        } else {
            return NULL;
        }
    }
 
    public function isUserExisted($email) {
        $stmt = $this->conn->prepare("SELECT admin_email from admin WHERE admin_email = ?");
 
        $stmt->bind_param("s", $email);
 
        $stmt->execute();
 
        $stmt->store_result();
 
        if ($stmt->num_rows > 0) {
            // user existed 
            $stmt->close();
            return true;
        } else {
            // user not existed
            $stmt->close();
            return false;
        }
    }
 
    /**
     * Encrypting password
     * @param password
     * returns salt and encrypted password
     */
    public function hashSSHA($password) {
 
        $salt = sha1(rand());
        $salt = substr($salt, 0, 10);
        $encrypted = base64_encode(sha1($password . $salt, true) . $salt);
        $hash = array("salt" => $salt, "encrypted" => $encrypted);
        return $hash;
    }
 
    /**
     * Decrypting password
     * @param salt, password
     * returns hash string
     */
    public function checkhashSSHA($salt, $password) {
 
        $hash = base64_encode(sha1($password . $salt, true) . $salt);
 
        return $hash;
    }
 
}
 
?>