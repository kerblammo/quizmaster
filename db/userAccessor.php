<?php


$projectRoot = filter_input(INPUT_SERVER, "DOCUMENT_ROOT") . '/QuizMasterBackend';
require_once 'ConnectionManager.php';



class UserAccessor{
    
    //CRUD strings
    private $getByIdStatementString = "SELECT * FROM users WHERE id = :id";
    private $getByUsernameStatementString = "SELECT * FROM users WHERE username LIKE :username";
    private $verifyUserLoginStatementString = "SELECT * FROM users WHERE username = :username AND password = :password";
    private $deleteStatementString = "DELETE FROM users WHERE id = :id";
    private $insertStatementString = "INSERT INTO users (permissionId, username, password) values (:permissionId, :username, :password)";
    private $updatePasswordStatementString = "UPDATE users SET password = :password WHERE id = :id";
    private $updateDeactivatedStatementString = "UPDATE users SET deactivated = :deactivated WHERE id = :id";
    
    //connection
    private $conn = NULL;
    
    //statements
    private $getByIdStatement = NULL;
    private $getByUsernameStatement = NULL;
    private $verifyUserLoginStatement = NULL;
    private $deleteStatement = NULL;
    private $insertStatement = NULL;
    private $updatePasswordStatement = NULL;
    private $updateDeactivatedStatement = NULL;
    
    /**
     * Prepare the connection manager and future query statements
     * Will throw exception if there is a problem with ConnectionManager
     * (bad credentials possibly) or query strings
     * @throws Exception
     */
    public function __construct() {
        //connect to database
        $cm = new ConnectionManager();
        $this->conn = $cm->connect_db();
        if (is_null($this->conn)){
            throw new Exception("No connection");
        }
        
        //prepare statements
        $this->getByIdStatement = $this->conn->prepare($this->getByIdStatementString);
        if (is_null($this->getByIdStatement)){
            throw new Exception("Could not prepare statement: " . $this->getByIdStatementString);
        }
        $this->getByUsernameStatement = $this->conn->prepare($this->getByUsernameStatementString);
        if (is_null($this->getByUsernameStatement)){
            throw new Exception("Could not prepare statement: " . $this->getByUsernameStatementString);
        }
        $this->verifyUserLoginStatement = $this->conn->prepare($this->verifyUserLoginStatementString);
        if (is_null($this->verifyUserLoginStatement)){
            throw new Exception("Could not prepare statement: " . $this->verifyUserLoginStatementString);
        }
        $this->deleteStatement = $this->conn->prepare($this->deleteStatementString);
        if (is_null($this->deleteStatement)){
            throw new Exception("Could not prepare statement: " . $this->deleteStatementString);
        }
        $this->insertStatement = $this->conn->prepare($this->insertStatementString);
        if (is_null($this->insertStatement)){
            throw new Exception("Could not prepare statement: " . $this->insertStatementString);
        }
        $this->updatePasswordStatement = $this->conn->prepare($this->updatePasswordStatementString);
        if (is_null($this->updatePasswordStatement)){
            throw new Exception("Could not prepare statement: " . $this->updatePasswordStatementString);
        }
        $this->updateDeactivatedStatement = $this->conn->prepare($this->updateDeactivatedStatementString);
        if (is_null($this->updateDeactivatedStatement)){
            throw new Exception("Could not prepare statement: " . $this->updateDeactivatedStatementString);
        }
    }
    
    /**
     * Executes a query to select users. Returns an array of user objects
     * @param string $selectString
     * @return array
     */
    public function getUsersByQuery($selectString){
        $result = [];
        
        try {
            $stmt = $this->conn->prepare($selectString);
            $stmt->execute();
            $dbResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($dbResults as $r){
                $id = $r['Id'];
                $permissionId = $r['PermissionId'];
                $username = $r['Username'];
                $password = $r['Password'];
                $deactivated = $r['Deactivated'];
                $obj = new User($id, $permissionId, $username, $password, $deactivated);
                array_push($result, $obj);
            }
        
        } catch (Exception $ex) {
            $result = [];
        } finally {
            if (!is_null($stmt)){
                $stmt->closeCursor();
            }
        }
        
        return $result;
    }
    
    /**
     * Gets all users
     * 
     * @return array User objects, possibly empty
     */
    public function getAllUsers(){
        return $this->getUsersByQuery("SELECT * FROM users");
    }
    
    /**
     * Select a user from the database which matches the id supplied
     * 
     * @param integer $id the id of the desired user
     * @return User entity, possibly null
     */
    public function getUserById($id){
        $result = NULL;
        
        try {
            $this->getByIdStatement->bindParam(":id", $id);
            $this->getByIdStatement->execute();
            $dbResult = $this->getByIdStatement->fetch(PDO::FETCH_ASSOC);
            
            if ($dbResult){
                $userid = $dbResult['Id'];
                $permissionId = $dbResult['PermissionId'];
                $username = $dbResult['Username'];
                $password = $dbResult['Password'];
                $deactivated = $dbResult['Deactivated'];
                $result = new User($userid, $permissionId, $username, $password, $deactivated);
                
            }
        } catch (Exception $ex) {
            $result = NULL;
        } finally {
            if (!is_null($this->getByIdStatement)){
                $this->getByIdStatement->closeCursor();
            }
        }
        
        return $result;
    }
    
    /**
     * Retrieve a user from the database that matches
     * the username supplied
     * 
     * @param String $name the username matching user
     * @return User entity, possibly null
     */
    public function getUserByUsername($name){
        $result = [];
        //today I learned that the wildcards have to be added here, before binding the parameter
        $name = '%'.$name.'%';
        try {
            $this->getByUsernameStatement->bindParam(":username", $name);
            $this->getByUsernameStatement->execute();
            $dbResult = $this->getByUsernameStatement->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($dbResult as $r){
                $id = $r['Id'];
                $permissionId = $r['PermissionId'];
                $username = $r['Username'];
                $password = $r['Password'];
                $deactivated = $r['Deactivated'];
                $obj = new User($id, $permissionId, $username, $password, $deactivated); 
                array_push($result, $obj);
            }
            if ($dbResult){
                
            }
        } catch (Exception $ex) {
            $result = [];
        } finally {
            if (!is_null($this->getByUsernameStatement)){
                $this->getByUsernameStatement->closeCursor();
            }
        }
        
        return $result;
    }
    
    /**
     * Verify if username / password combination exists
     * on database
     * 
     * @param string $username username to log in with
     * @param string $password password to log in with
     * @return User entity matching credentials
     */
    public function verifyUserLogin($username, $password){
        $result = NULL;
        
        
        try {
            $this->verifyUserLoginStatement->bindParam(":username", $username);
            $this->verifyUserLoginStatement->bindParam(":password", $password);
            $this->verifyUserLoginStatement->execute();
            $dbResult = $this->verifyUserLoginStatement->fetch(PDO::FETCH_ASSOC);
            
            if ($dbResult){
                $id = $dbResult['Id'];
                $permissionId = $dbResult['PermissionId'];
                $name = $dbResult['Username'];
                $pass = $dbResult['Password'];
                $deactivated = $dbResult['Deactivated'];
                $result = new User($id, $permissionId, $name, $pass, $deactivated);
            }
        } catch (Exception $ex) {
            $result = NULL;
        } finally {
            if (!is_null($this->verifyUserLoginStatement)){
                $this->verifyUserLoginStatement->closeCursor();
            }
        }
        return $result;
    }
    
    /**
     * Attempt to delete a user from the database
     * 
     * @param User $user to be deleted
     * @return boolean true if at least one record deleted
     */
    public function deleteUser($user){
        //TODO: verify that delete works with a user that has taken a quiz

        $userid = $user->getId();
        
        try {
            $this->deleteStatement->bindParam(":id", $userid);
            $this->deleteStatement->execute();
            $rc = $this->deleteStatement->rowCount();
            $success = $rc > 0;
        } catch (Exception $ex) {
            $success = false;
        } finally {
            if (!is_null($this->deleteStatement)){
                $this->deleteStatement->closeCursor();
            }
        }
        return $success;
    }
    
    /**
     * Attempt to insert a user into the database
     * 
     * @param User $user entity to insert
     * @return boolean true if record inserted
     */
    public function insertUser($user){
        
        $permissionId = $user->getPermissionId();
        $username = $user->getUsername();
        $password = $user->getPassword();
        
        try {
            $this->insertStatement->bindParam(":permissionId", $permissionId);
            $this->insertStatement->bindParam(":username", $username);
            $this->insertStatement->bindParam(":password", $password); 
            $success = $this->insertStatement->execute();
        } catch (Exception $ex) { 
            $success = false;
        } finally {
            if (!is_null($this->insertStatement)){
                $this->insertStatement->closeCursor();
            }
        }
        return $success;
    }
    
    /**
     * Attempt to modify a user's password
     * 
     * @param User $user user to be updated
     * @return boolean true if password modified
     */
    public function updatePassword($user){
        
        $id = $user->getId();
        $password = $user->getPassword();
        
        try {
            $this->updatePasswordStatement->bindParam(":id", $id);
            $this->updatePasswordStatement->bindParam(":password", $password);
            $this->updatePasswordStatement->execute();
            $success = $this->updatePasswordStatement->rowCount() > 0;
        } catch (Exception $ex) {
            $success = false;
        } finally {
            if (!is_null($this->updatePasswordStatement)){
                $this->updatePasswordStatement->closeCursor();
            }
        }
        return $success;
        
    }
    
    
    public function deactivateUser($user){
        
        $id = $user->getId();
        $deactivated = $user->getDeactivated;
        
        try{
            $this->updateDeactivatedStatement->bindParam(":id", $id);
            $this->updateDeactivatedStatement->bindParam(":deactivated", $deactivated);
            $this->updateDeactivatedStatement->execute();
            $success = $this->updateDeactivatedStatement->rowCount() > 0;
        } catch (Exception $ex) {
            $success = false;
        } finally {
            if (!is_null($this->updateDeactivatedStatement)){
                $this->updateDeactivatedStatement->closeCursor();
            }
        }
        return $success;
    }
    
}