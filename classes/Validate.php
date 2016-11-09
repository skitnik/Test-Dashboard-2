<?php

class Validate{
 
    //TODO EDIT FORM DO NOT DISPLAY ANY ERROR BUT IT'S WORKING
    //TODO ERROR HANDLING FOR ALL METHODS
    
    /**
     * 
     * @param string $fName
     * @param string $lName
     * @param string $email
     * @param string $password
     * @param string $rPassword
     * @return boolean
     */
    public function checkRegister($fName, $lName , $email, $password, $rPassword){
        //Check First Name
        if (!$this->checkString($fName) || !$this->checkStrlen($fName, 2)){
            echo "Invalid First Name";
            return false;
        }

        if(!$this->checkString($lName) || !$this->checkStrlen($lName, 2)){
            echo "Invalid Last Name";
            return false;
        }

        if(!$this->checkEmail($email)){
            echo "Invalid Email";
            return false;
        }

        if($this->checkEmailExist($email)){
            echo "This email already exist";
            return false;
        }

        if(!$this->checkStrlen($password, 8)){
            echo "Invalid Password";
            return false;
        }

        if($password !== $rPassword){
            echo "Password do not match";
            return false;
        }
        return true;
    }
    
    /**
     * 
     * @param string $email
     * @param string $password
     * @return boolean
     */
    public function checkLogin($email, $password){

        if(!($this->checkEmail($email)) || !($this->checkEmailExist($email))){
            echo "Wrong email or password";
            return false;
        }

        if(!$this->checkPassMatch($email, $password)){
            echo "Wrong email or password";
            return false;
        }
        return true;
    }
    
    /**
     * 
     * @param string $fName
     * @param string $lName
     * @param string $pass
     * @param string $newPass
     * @return boolean
     */
    public function checkEditForm($fName, $lName, $pass, $newPass) {
        if (!$this->checkString($fName) || !$this->checkStrlen($fName, 2)){
            echo "Invalid First Name";
            return false;
        }
        
        if(!$this->checkString($lName) || !$this->checkStrlen($lName, 2)){
            echo "Invalid Last Name";
            return false;
        }
        
        if (!$this->checkStrlen($newPass, 8)) {
            echo "Invalid Password";
            return false;
        }
        
        if(!$this->checkEditFormPassMatch($pass)){
            echo "Invalid Old Password";
            return false;
        }
        
        return true;
    }

    /**
     * 
     * @param string $str
     * @param int $min
     * @param int $max
     * @return bool
     */
    public function checkStrlen($str,$min,$max=null){
        
        $string  = strlen($str);
        
        if($max !== null){
            return $string >= $min && $string <= $max;
        }else{
            return $string >= $min;
        }
    }
    
    /**
     * 
     * @param string $email
     * @return bool
     */
    public function checkEmail($email){
        $regex = '/^([a-z0-9][a-z0-9\.\_\-]{1,64}[a-z0-9])@([a-z0-9][a-z0-9\.\-]+[a-z0-9]\.[a-z]{2,4})$/i';
	return (bool) preg_match($regex, $email); 
    }
    
    /**
     * 
     * @param string $email
     * @return bool
     */
    public function checkString($str){
        $regex = '/^[a-zA-Z]+$/';
        return (bool) preg_match($regex, $str);
    }
    
    /**
     * 
     * @param string $email
     * @return boolean
     */
    public function checkEmailExist($email){
        $db = Database::getInstance();
        if($db->checkQuery("SELECT email FROM users WHERE email = '$email'")){
            return true;
        }
    }
    
    /**
     * 
     * @param string $email
     * @param string $password
     * @return boolean
     */
    public function checkPassMatch($email,$password){
        $db = Database::getInstance();
        $result = $db->selectQuery("SELECT password FROM users WHERE email = '$email'");
        if(password_verify($password, $result[0]['password'])){
            return true;
        }
    }
    
    /**
     * 
     * @param string $password
     * @return boolean
     */
    public function checkEditFormPassMatch($password){
        $db = Database::getInstance();
        $result = $db->selectQuery("SELECT password FROM users WHERE id = '{$_SESSION['userId']}'");
        if(password_verify($password, $result[0]['password'])){
            return true;
        }
    }
    
    /**
     * 
     * @param str $input
     * @return boolean
     */
    public function checkEmptyInput($input){
        if(empty(Input::getInputData($input))){
            return true;
        }
    }
    
    /**
     * 
     * @param str $data
     * @return boolean
     */
    public function issetInput($data){
        if(isset($_POST[$data])){
            return true;
        }
        elseif(isset($_GET[$data])){
            return true;
        }
        else{
            return false;
        }
    }
    
//    public function checkUrlKeyValue($key1, $key2) {
//        
//        if ($_GET['type'] == $key1 && $_GET['action'] == $key2) {
//            return true;
//        }
//    }

    public function checkDirUrl() {
        
        if (isset($_GET['type']) && isset($_GET['action']) && isset($_GET['name'])) {
            return true;
        }
    }
    

}