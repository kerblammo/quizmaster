<?php

require_once '../db/resultsAccessor.php';

//check which verb sent and act accordingly
$method = filter_input(INPUT_SERVER, "REQUEST_METHOD");
if ($method === "GET") {
    doGet();
} else if ($method === "POST") {
    doPost();
}

function doGet() {
    if (filter_has_var(INPUT_GET, "userid")) {
        //user results
        if (filter_has_var(INPUT_GET, 'title')) {
            userGetByTitle();
        } else if (filter_has_var(INPUT_GET, 'tags')) {
            userGetByTag();
        } else if (filter_has_var(INPUT_GET, 'from')){
            userGetByDate();
        } else if (filter_has_var(INPUT_GET, 'min')){
            userGetByScore();
        }
    } else {
        //all results
        if (filter_has_var(INPUT_GET, 'title')){
            getByTitle();
        } else if (filter_has_var(INPUT_GET, 'quiztag')){
            getByQuizTag();
        } else if (filter_has_var(INPUT_GET, 'text')){
            getByQuestion();
        } else if (filter_has_var(INPUT_GET, 'questiontag')){
            getByQuestionTag();
        } else if (filter_has_var(INPUT_GET, 'from')){
            getByDate();
        } else {
            getAll();
        }
    }
}

function userGetByTitle(){
    try {
        $userId = filter_input(INPUT_GET, 'userid');
        $title = filter_input(INPUT_GET, 'title');
        $acc = new ResultsAccessor();
        $results = jsone_encode($acc->getUserResultsByQuizTitle($userId, $title));
        echo $results;
    } catch (Exception $ex) {
        echo "ERROR: " . $ex->getMessage();
    }
}

function userGetByTag(){
    try {
        $userId = filter_input(INPUT_GET, 'userid');
        $tag = filter_input(INPUT_GET, 'tags');
        $acc = new ResultsAccessor();
        $results = jsone_encode($acc->getUserResultsByQuizTag($userId, $tag));
        echo $results;
    } catch (Exception $ex) {
        echo "ERROR: " . $ex->getMessage();
    }
}

function userGetByDate(){
    try {
        $userId = filter_input(INPUT_GET, 'userid');
        $from = filter_input(INPUT_GET, 'from');
        $to = filter_input(INPUT_GET, 'to');
        $acc = new ResultsAccessor();
        $results = jsone_encode($acc->getUserResultsByDate($userId, $from, $to));
        echo $results;
    } catch (Exception $ex) {
        echo "ERROR: " . $ex->getMessage();
    }
}

function userGetByScore(){
    try {
        $userId = filter_input(INPUT_GET, 'userid');
        $min = filter_input(INPUT_GET, 'min');
        $max = filter_input(INPUT_GET, 'max');
        $acc = new ResultsAccessor();
        $results = jsone_encode($acc->getUserResultsByScore($userId, $min, $max));
        echo $results;
    } catch (Exception $ex) {
        echo "ERROR: " . $ex->getMessage();
    }
}

function getByTitle(){
    try {
        $title = filter_input(INPUT_GET, 'title');
        $acc = new ResultsAccessor();
        $results = jsone_encode($acc->getResultsByQuizTitle($title));
        echo $results;
    } catch (Exception $ex) {
        echo "ERROR: " . $ex->getMessage();
    }
}

function getByQuizTag(){
    try {
        $tag = filter_input(INPUT_GET, 'quiztag');
        $acc = new ResultsAccessor();
        $results = jsone_encode($acc->getResultsByQuizTag($tag));
        echo $results;
    } catch (Exception $ex) {
        echo "ERROR: " . $ex->getMessage();
    }
}

function getByQuestion(){
    try {
        $title = filter_input(INPUT_GET, 'text');
        $acc = new ResultsAccessor();
        $results = jsone_encode($acc->getResultsByQuestionTitle($title));
        echo $results;
    } catch (Exception $ex) {
        echo "ERROR: " . $ex->getMessage();
    }
}

function getByQuestionTag(){
    try {
        $tag = filter_input(INPUT_GET, 'questiontag');
        $acc = new ResultsAccessor();
        $results = json_encode($acc->getResultsByQuestionTag($tag));
        echo $results;
    } catch (Exception $ex) {
        echo "ERROR: " . $ex->getMessage();
    }
}

function getByDate(){
    try {
        $from = filter_input(INPUT_GET, 'from');
        $to = filter_input(INPUT_GET, 'to');
        $acc = new ResultsAccessor();
        $results = jsone_encode($acc->getResultsByDate($from, $to));
        echo $results;
    } catch (Exception $ex) {
        echo "ERROR: " . $ex->getMessage();
    }
}

function getAll(){
    try {
        $acc = new ResultsAccessor();
        $results = json_encode($acc->getAllResults());
        echo $results;
    } catch (Exception $ex) {
        echo "ERROR: " . $ex->getMessage();
    }
}

function doPost() {
    $body = file_get_contents('php://input');
    $contents = json_decode($body, true);
    $quiz = new QuizResults($contents['id'], $contents['userid'], $contents['quizid'], $contents['starttime'], $contents['endtime'], $contents['answers'], $contents['scores'], $contents['total']);
    try {
        $acc = new ResultsAccessor(); 
        $results = json_encode($acc->insertResult($quiz));
        echo $results;
    } catch (Exception $ex) {
        echo "ERROR: " . $ex->getMessage();
    }
}
