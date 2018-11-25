<?php

$projectRoot = filter_input(INPUT_SERVER, "DOCUMENT_ROOT") . '/QuizMasterBackend';
require_once ($projectRoot . '/db/QuizAccessor.php');
require_once ($projectRoot . '/entity/Quiz.php');

//check which verb sent and act accordingly
$method = filter_input(INPUT_SERVER, "REQUEST_METHOD");
if ($method === "GET"){
    doGet();
} else if ($method === "POST"){
    doPost();
} else if ($method === "PUT"){
    doPut();
} else if ($method === "DELETE"){
    doDelete();
}


/**
 * Handle services which require GET method
 * This includes searching for all quizzes, getting a quiz
 * by its id, and searching for a quiz by either its name or
 * tags
 */
function doGet(){
    if (filter_has_var(INPUT_GET, 'id')){
        getId();
    } else if (filter_has_var(INPUT_GET, 'name')){
        getName();
    } else if (filter_has_var(INPUT_GET, 'tag')){
        getTag();
    } else {
        getAll();
    }
}

/**
 * Get the quiz whose ID matches the one supplied
 */
function getId(){
    
    try {
        $id = filter_input(INPUT_GET, 'id');
        $acc = new QuizAccessor();
        $results = json_encode($acc->getQuizById($id));
        echo $results;
    } catch (Exception $ex) {
        echo "ERROR: " . $ex->getMessage();
    }
}

/**
 * Get the quizzes whose names are similar to the 
 * key supplied
 */
function getName(){
    try {
        $name = filter_input(INPUT_GET, 'name');
        $acc = new QuizAccessor();
        $results = json_encode($acc->getQuizByName($name));
        echo $results;
    } catch (Exception $ex) {
        echo "ERROR: " . $ex->getMessage();
    }
}

/**
 * Get the quizzes whose tags are similar to the key supplied
 */
function getTag(){
    try {
        $tag = filter_input(INPUT_GET, 'tag');
        $acc = new QuizAccessor();
        $results = json_encode($acc->getQuizByTag($tag));
        echo $results;
    } catch (Exception $ex) {
        echo "ERROR: " . $ex->getMessage();
    }
}

/**
 * Get all quizzes from database
 */
function getAll(){
    try {
        $acc = new QuizAccessor();
        $results = json_encode($acc->getAllQuizzes());
        echo $results;
    } catch (Exception $ex) {
        echo "ERROR: " . $ex->getMessage();
    }
}

/**
 * Handle services which require POST method
 * This includes creating a new quiz
 */
function doPost(){
    $body = file_get_contents('php://input');
    $contents = json_decode($body, true);
    $quiz = new Quiz($contents['id'], $contents['authorId'], $contents['title'], $contents['description'], $contents['tags']);
    try {
        $acc = new QuizAccessor();
        $results = json_encode($acc->insertQuiz($quiz));
        echo $results;
    } catch (Exception $ex) {
        echo "ERROR: " . $ex->getMessage();
    } 
}

/**
 * Handle service which require PUT method
 * This includes updating a single quiz
 */
function doPut(){
    $body = file_get_contents('php://input');
    $contents = json_decode($body,true);
    $quiz = new Quiz($contents['id'], $contents['authorId'], $contents['title'], $contents['description'], $contents['tags']);
    try {
        $acc = new QuizAccessor();
        $results = json_encode($acc->updateQuiz($quiz));
        echo $results;
    } catch (Exception $ex) {
        echo "ERROR:" . $ex->getMessage();
    }
}

/**
 * Handle services which require DELETE method
 * This includes deleting a single quiz by its id
 */
function doDelete(){
    if (filter_has_var(INPUT_GET, "id")){
        $id = filter_input(INPUT_GET, "id");
        $quiz = new Quiz($id, 0, "", "", "");
        try {
            $acc = new QuizAccessor();
            $results = json_encode($acc->deleteQuiz($quiz));
            echo $results;
        } catch (Exception $ex) {
            echo "ERROR: " . $ex->getMessage();
        }
    } else {
        echo "ERROR: ID of quiz to be deleted not supplied";
    }
}