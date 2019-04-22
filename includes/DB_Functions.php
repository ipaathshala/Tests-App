<?php
    class DB_Functions{
        private $conn;
        function __construct(){
            require_once 'DB_Connect.php';
            $db = new Db_Connect();
            $this->conn = $db->connect();
        }
        function __destruct(){

        }

        /*Create new admin*/
        public function adminRegs($username, $password){
            $uuid = uniqid('', true);
            $hash = $this->hashSSHA($password);
            $encrypted_password = $hash["encrypted"];
            $salt = $hash["salt"];

            $stmt = $this->conn->prepare("INSERT INTO `master_admin`(`unique_id`, `email`, `encrypted_password`, `salt`) VALUES (?,?,?,?)");
            $stmt->bind_param("ssss", $uuid, $username, $encrypted_password, $salt);
            $result = $stmt->execute();
            $stmt->close();

            if($result){
                $stmt = $this->conn->prepare("SELECT * FROM `master_admin` WHERE email = ?");
                $stmt->bind_param("s", $username);
                $stmt->execute();
                $user = $stmt->get_result()->fetch_assoc();
                $stmt->close();
                return $user;
            }
            else{
                return false;
            }
        }

        /* Check if username is already exist */
        public function adminExist($username){
            $stmt = $this->conn->prepare("SELECT `email` FROM `master_admin` WHERE `email` = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();
            if($stmt->num_rows > 0){
                $stmt->close();
                return true;
            }
            else{
                $stmt->close();
                return false;
            }
        }
        
        /*Admin login*/
        public function adminLogin($username, $password){
            $stmt = $this->conn->prepare("SELECT `admin_id`, `unique_id`, `email`, `encrypted_password`, `salt` FROM `master_admin` WHERE `email` = ?");
            $stmt->bind_param("s",$username);
            
            if($stmt->execute()) {
                $user = $stmt->get_result()->fetch_assoc();
                $stmt->close();

                $salt = $user['salt'];
                $encrypted_password = $user['encrypted_password'];
                $hash = $this->checkhashSSHA($salt, $password);
                
                if($encrypted_password == $hash){
                    return $user;
                }
            }
            else{
                return NULL;
            }
        }

        /*Create new exam*/
        public function saveNewExam($newexam){
            $stmt = $this->conn->prepare("INSERT INTO `exams`(`etitle`) VALUES (?)");
            $stmt->bind_param("s",$newexam);
            $result = $stmt->execute();
            $stmt->close();

            if($result){
                $stmt = $this->conn->prepare("SELECT * FROM `exams` WHERE `etitle` = ?");
                $stmt->bind_param("s", $newexam);
                $stmt->execute();
                $user = $stmt->get_result()->fetch_assoc();
                $stmt->close();
                return $user;
            }
            else{
                return false;
            }
        }

        /*Check if exam exist*/
        public function ifExamExist($newexam){
            $stmt = $this->conn->prepare("SELECT `eid`, `etitle` FROM `exams` WHERE `etitle` = ?");
            $stmt->bind_param("s", $newexam);
            $stmt->execute();
            $stmt->store_result();
            if($stmt->num_rows > 0){
                $stmt->close();
                return true;
            }
            else{
                $stmt->close();
                return false;
            }
        }

        /*Load exam list on page*/
        public function examList(){
            $stmt = $this->conn->prepare("SELECT `eid`, `etitle` FROM `exams`");
            $stmt->execute();
            $stmt->bind_result($exam_id, $examtitle);
            $examArray = array();
            while($stmt->fetch()){
                $temp = array();
                $temp['eid'] = $exam_id;
                $temp['etitle'] = $examtitle;
                array_push($examArray, $temp);
            }
            return $examArray;
        }

        /*Save question & answer*/
        public function saveNewTest($exam, $fileName, $answer, $plus, $minus){
            $stmt = $this->conn->prepare("INSERT INTO `qusans`(`ex_id`, `que_img`, `answer`, `plusmarks`, `minusmarks`) VALUES (?,?,?,?,?)");
            $stmt->bind_param("sssss", $exam, $fileName, $answer, $plus, $minus);
            $result = $stmt->execute();
            $stmt->close();
        }

        /*Load batch list to activate batch test*/
        public function batchList(){
            $stmt = $this->conn->prepare("SELECT `batch_id`, `batch_title` FROM `batch`");
            $stmt->execute();
            $stmt->bind_result($batch_id, $batch_title);
            $batchArray = array();
            while($stmt->fetch()){
                $temp = array();
                $temp['batch_id'] = $batch_id;
                $temp['batch_title'] = $batch_title;
                array_push($batchArray, $temp);
            }
            return $batchArray;
        }

        /*Load exams list to activate batch test*/
        public function examDropdown(){
            $stmt = $this->conn->prepare("SELECT `eid`, `etitle` FROM `exams`");
            $stmt->execute();
            $stmt->bind_result($exam_id, $exam_title);
            $examArray = array();
            while($stmt->fetch()){
                $temp = array();
                $temp['eid'] = $exam_id;
                $temp['etitle'] = $exam_title;
                array_push($examArray, $temp);
            }
            return $examArray;
        }

        /*Create new batch test*/
        public function SetAllBatchTest($newbatch, $newexam, $date1, $date2, $time1, $time2){
            $stmt = $this->conn->prepare("INSERT INTO `master_batch_test`(`batch_id`, `exam_id`, `start_date`, `end_date`, `start_time`, `end_time`) VALUES (?,?,?,?,?,?)");
            $stmt->bind_param("ssssss", $newbatch, $newexam, $date1, $date2, $time1, $time2);
            $result = $stmt->execute();
            $stmt->close();
        }

        /*Check if batch test exist*/
        public function ifBatchTestExist($newbatch, $newexam, $date1, $date2, $time1, $time2){
            $stmt = $this->conn->prepare("SELECT * FROM `master_batch_test` WHERE `batch_id` = ? AND `exam_id` = ? AND `start_date` = ? AND `end_date` = ? AND `start_time` = ? AND `end_time` = ?");
            $stmt->bind_param("ssssss",$newbatch, $newexam, $date1, $date2, $time1, $time2);
            $stmt->execute();
            $stmt->store_result();
            if($stmt->num_rows > 0){
                $stmt->close();
                return true;
            }
            else{
                $stmt->close();
                return false;
            }
        }

        /*Create new exam*/
        public function saveNewBatch($newbatch){
            $stmt = $this->conn->prepare("INSERT INTO `batch` (`batch_title`) VALUES (?)");
            $stmt->bind_param("s",$newbatch);
            $result = $stmt->execute();
            $stmt->close();

            if($result){
                $stmt = $this->conn->prepare("SELECT * FROM `batch` WHERE `batch_title` = ?");
                $stmt->bind_param("s", $newbatch);
                $stmt->execute();
                $user = $stmt->get_result()->fetch_assoc();
                $stmt->close();
                return $user;
            }
            else{
                return false;
            }
        }

        /*Check if exam exist*/
        public function ifexistBatchList($newbatch){
            $stmt = $this->conn->prepare("SELECT `batch_id` FROM `batch` WHERE `batch_title` = ?");
            $stmt->bind_param("s", $newbatch);
            $stmt->execute();
            $stmt->store_result();
            if($stmt->num_rows > 0){
                $stmt->close();
                return true;
            }
            else{
                $stmt->close();
                return false;
            }
        }

        /*Existing batch list*/
        public function existBatchList(){
            $stmt = $this->conn->prepare("SELECT `batch_id`, `batch_title` FROM `batch`");
            $stmt->execute();
            $stmt->bind_result($batch_id, $batch_title);
            $batchArray = array();
            while($stmt->fetch()){
                $temp = array();
                $temp['batch_id'] = $batch_id;
                $temp['batch_title'] = $batch_title;
                array_push($batchArray, $temp);
            }
            return $batchArray;
        }

        /*Import student csv file*/
        public function studentRegs($batch, $fn, $ln, $username, $password, $status){
            $uuid = uniqid('', true);
            $hash = $this->hashSSHA($password);
            $encrypted_password = $hash["encrypted"];
            $salt = $hash["salt"];

            $stmt = $this->conn->prepare("INSERT INTO `master_students`(`unique_id`, `batchid`, `fn`, `ln`, `email`, `encrypted_password`, `salt`, `status`) VALUES (?,?,?,?,?,?,?,?)");
            $stmt->bind_param("ssssssss", $uuid, $batch, $fn, $ln, $username, $encrypted_password, $salt, $status);
            $result = $stmt->execute();
            $stmt->close();
        }

        /*Load exams list to activate batch test*/
        public function studentDropdown($batch){
            $stmt = $this->conn->prepare("SELECT `stdid`, `fn`, `ln` FROM `master_students` WHERE `batchid` = ? AND `status` = 1");
            $stmt->bind_param("s",$batch);
            $stmt->execute();
            $stmt->bind_result($stdid, $fn, $ln);
            $stdArray = array();
            while($stmt->fetch()){
                $temp = array();
                $temp['stdid'] = $stdid;
                $temp['fn'] = $fn;
                $temp['ln'] = $ln;
                array_push($stdArray, $temp);
            }
            return $stdArray;
        }

        /*Create new student test*/
        public function studentExam($batchName, $examName, $val, $date1, $date2, $time1, $time2, $status){
            $stmt = $this->conn->prepare("INSERT INTO `master_student_exams`(`std_batch`, `std_exam`, `student_id`, `exam_start_date`, `exam_end_date`, `exam_start_time`, `exam_end_time`, `exam_status`) VALUES (?,?,?,?,?,?,?,?)");
            $stmt->bind_param("ssssssss", $batchName, $examName, $val, $date1, $date2, $time1, $time2, $status);
            $result = $stmt->execute();
            $stmt->close();
        }

        /*Check if student exam exist*/
        public function ifStudentExamExist($batchName, $examName, $val, $date1, $date2, $time1, $time2){
            $stmt = $this->conn->prepare("SELECT `std_exam_id` FROM `master_student_exams` WHERE `std_batch` = ? AND `std_exam` = ? AND `student_id` = ? AND `exam_start_date` = ? AND `exam_end_date` = ? AND `exam_start_time` = ? AND `exam_end_time` = ? AND `exam_status` = '1'");
            $stmt->bind_param("sssssss",$batchName, $examName, $val, $date1, $date2, $time1, $time2);
            $stmt->execute();
            $stmt->store_result();
            if($stmt->num_rows > 0){
                $stmt->close();
                return true;
            }
            else{
                $stmt->close();
                return false;
            }
        }

        /*Student List*/
        public function studentList($username){
            $stmt = $this->conn->prepare("SELECT * FROM `master_admin` WHERE email = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $user;
        }

        /*Student login*/
        public function studentLogin($username, $password){
            $stmt = $this->conn->prepare("SELECT `stdid`, `unique_id`, `email`, `encrypted_password`, `salt` FROM `master_students` WHERE `email` = ?");
            $stmt->bind_param("s",$username);
            if ($stmt->execute()) {
                $user = $stmt->get_result()->fetch_assoc();
                $stmt->close();
                $salt = $user['salt'];
                $encrypted_password = $user['encrypted_password'];
                $hash = $this->checkhashSSHA($salt, $password);
                if($encrypted_password == $hash){
                    return $user;
                }
            }
            else{
                return NULL;
            }
        }

        /**
        * Encrypting password
        * @param password
        * returns salt and encrypted password
        */
        public function hashSSHA($password){
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
        public function checkhashSSHA($salt, $password){
            $hash = base64_encode(sha1($password . $salt, true) . $salt);
            return $hash;
        }
    }
?>