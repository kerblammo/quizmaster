<?php

require_once ('../db/QuestionAccessor.php');
require_once ('../entity/Question.php');

$method = filter_input(INPUT_SERVER, "REQUEST_METHOD");
if ($method === "GET"){
    doGet();
} else if ($method === "DELETE"){
    doDelete();
} else if ($method === "POST"){
    doPost();
} else if ($method === "PUT"){
    doPut();
}

function doGet(){
    if (filter_has_var(INPUT_GET, "id")){
        getId();
    } else if (filter_has_var(INPUT_GET, "title")){
        getTitle();
    } else if (filter_has_var(INPUT_GET, "choice")){
        getChoice();
    } else if (filter_has_var(INPUT_GET, "tags")){
        getTag();
    } else {
        getAll();
    }
}

function getId(){
        
    try {
        $id = filter_input(INPUT_GET, 'id');
        $acc = new QuestionAccessor();
        $results = json_encode($acc->getQuestionById($id));
        echo $results;
    } catch (Exception $ex) {
        echo "ERROR: " . $ex->getMessage();
    }
}

function getTitle(){
    try {
        $name = filter_input(INPUT_GET, 'title');
        $acc = new QuestionAccessor();
        $results = json_encode($acc->getQuestionsByName($name));
        echo $results;
    } catch (Exception $ex) {
        echo "ERROR: " . $ex->getMessage();
    }
}

function getChoice(){
    try {
        $choice = filter_input(INPUT_GET, 'choice');
        $acc = new QuestionAccessor();
        $results = json_encode($acc->getQuestionsByChoices($choice));
        echo $results;
    } catch (Exception $ex) {
        echo "ERROR: " . $ex->getMessage();
    }
}

function getTag(){
    try {
        $tag = filter_input(INPUT_GET, 'tags');
        $acc = new QuestionAccessor();
        $results = json_encode($acc->getQuestionsByTag($tag));
        echo $results;
    } catch (Exception $ex) {
        echo "ERROR: " . $ex->getMessage();
    }
}

function getAll(){
    try {
        $acc = new QuestionAccessor();
        $results = json_encode($acc->getAllQuestions());
        echo $results;
    } catch (Exception $ex) {
        echo "ERROR: " . $ex->getMessage();
    }
}

function doDelete(){
    if (filter_has_var(INPUT_GET, "id")){
        $id = filter_input(INPUT_GET, "id");
        $question = new Question($id, "", "", "", "", "");
        try {
            $acc = new QuestionAccessor();
            $results = json_encode($acc->deleteQuestion($question));
            echo $results;
        } catch (Exception $ex) {
            echo "ERROR: " . $ex->getMessage();
        }
    } else {
        echo "ERROR: ID of question to be deleted not supplied";
    }
}

function doPost(){
    $body = file_get_contents('php://input');
    $contents = json_decode($body,true);
    $question = new Question($contents['id'], $contents['questionText'], $contents['description'], $contents['choices'], $contents['answer'], $contents['tags']);
    try {
        $acc = new QuestionAccessor();
        $results = json_encode($acc->insertQuestion($question));
        echo $results;
    } catch (Exception $ex) {
        echo "ERROR:" . $ex->getMessage();
    }
}

function doPut(){
    $body = file_get_contents('php://input');
    $contents = json_decode($body,true);
    $question = new Question($contents['id'], $contents['questionText'], $contents['description'], $contents['choices'], $contents['answer'], $contents['tags']);
    try {
        $acc = new QuestionAccessor();
        $results = json_encode($acc->updateQuestion($question));
        echo $results;
    } catch (Exception $ex) {
        echo "ERROR:" . $ex->getMessage();
    }
}

