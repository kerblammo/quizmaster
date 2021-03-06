<?php


require_once '../db/userAccessor.php';
//require_once '../entity/User.php';

//check which verb sent and act accordingly
$method = filter_input(INPUT_SERVER, "REQUEST_METHOD");
if ($method === "GET") {
    doGet();
} else if ($method === "DELETE") {
    doDelete();
} else if ($method === "POST") {
    doPost();
} else if ($method === "PUT") {
    doPut();
}

/**
 * Handle get requests
 */


function doGet() {
    //three ways to get: credentials, by id, and by username

    if (filter_has_var(INPUT_GET, "id")) {

        getById();

    } else if (filter_has_var(INPUT_GET, "password")) {

        attemptLogin();
    } else if (filter_has_var(INPUT_GET, "username")){

        getByUsername();
    } else {

	
        getAllUsers();
    }
}

/**
 * Get the users which match the id supplied
 */
function getById() {
    try {
        $id = filter_input(INPUT_GET, "id");
        $acc = new userAccessor();
        $results = json_encode($acc->getUserById($id), JSON_NUMERIC_CHECK);
        echo $results;
    } catch (Exception $ex) {
        echo 'ERROR: ' . $ex->getMessage();
    }
}

/**
 * Get the user which matches the username supplied
 */
function getByUsername() {
    try {
        $username = filter_input(INPUT_GET, 'username');
        $acc = new userAccessor();
        $results = json_encode($acc->getUserByUsername($username), JSON_NUMERIC_CHECK);
        echo $results;
    } catch (Exception $ex) {
        echo 'ERROR: ' . $ex->getMessage();
    }
}

/**
 * Get the user that matches the credentials supplied
 */
function attemptLogin() { 

    
    $username = filter_input(INPUT_GET, 'username');
    $password = filter_input(INPUT_GET, 'password');


   try {
//        //accessor
        $acc = new UserAccessor();

        $results = json_encode($acc->verifyUserLogin($username, $password), JSON_NUMERIC_CHECK);
        echo $results;

    } catch (Exception $ex) {
        echo "ERROR: " . $ex->getMessage();
    }
}

/**
 * Get all users from database
 */
function getAllUsers(){
    
    try {
        $acc = new userAccessor();
        $results = json_encode($acc->getAllUsers());
        echo $results;
    } catch (Exception $ex) {
        echo "ERROR: " . $ex->getMessage();
    }
}

/**
 * Attempt to delete a user from the database
 * If user has already taken a quiz, database integrity
 * should prevent it from being deleted. The user will
 * be flagged as deactivated instead
 */
function doDelete() {
    if (filter_has_var(INPUT_GET, 'id')){
        $id = filter_input(INPUT_GET, 'id');
        try {
            $acc = new userAccessor();
            $user = new User($id, 0, "", "", true);
            $results = $acc->deleteUser($user);
            if (!$results){
                $results = $acc->deactivateUser($user);
            }
            echo $results;
        } catch (Exception $ex) {
            echo "ERROR: " . $ex->getMessage();
        }
    } else {
        echo "ERROR: ID of user to delete / deactivate not supplied";
    }
}

/**
 * Attempt to change a user's password
 */
function doPut(){
    if (filter_has_var(INPUT_GET, 'id')){
        $body = file_get_contents('php://input');
        $contents = json_decode($body, true);
        $user = new User($contents['id'], $contents['permissionId'], $contents['username'], $contents['password'], $contents['deactivated']);
        $id = filter_input(INPUT_GET, 'id');
        try {
            $acc = new UserAccessor();
            $results = json_encode($acc->updatePassword($user));
            echo $results;
            
        } catch (Exception $ex) {
            echo "ERROR: " . $ex->getMessage();
        }
    } else {
        echo "ERROR: ID of user to modify not supplied";
    }
}

/**
 * Attempt to add a new user to the database
 */
function doPost(){
    $body = file_get_contents('php://input');
    $contents = json_decode($body, true);
    $user = new User($contents['id'], $contents['permissionId'], $contents['username'], $contents['password'], $contents['deactivated']);
    try {
        $acc = new UserAccessor();
        $results = json_encode($acc->insertUser($user));
        echo $results;
    } catch (Exception $ex) {
        echo "ERROR: " . $ex->getMessage();
    }
}
