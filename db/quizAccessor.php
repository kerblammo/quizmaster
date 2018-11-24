<?php

$projectRoot = filter_input(INPUT_SERVER, "DOCUMENT_ROOT") . '/QuizMasterBackend';
require_once 'ConnectionManager.php';
require_once ($projectRoot . '/entity/quiz.php');

class QuizAccessor {
    
    //CRUD strings
    private $getByIdStatementString = "SELECT * FROM quiz WHERE id = :id";
    private $getByNameStatementString = "SELECT * FROM quiz WHERE title LIKE :title";
    private $getByTagStatementString = "SELECT * FROM quiz WHERE tags LIKE :tags";
    private $deleteStatementString = "DELETE FROM quiz WHERE id = :id";
    private $insertStatementString = "INSERT INTO quiz (authorId, title, description, tags) VALUES (:authorId, :title, :description, :tags";
    private $updateStatementString = "UPDATE quiz SET title = :title, description = :description, tags = :tags WHERE id = :id";
    
    //connection
    private $conn = NULL;
    
    //statements
    private $getByIdStatement = NULL;
    private $getByNameStatement = NULL;
    private $getByTagStatement = NULL;
    private $deleteStatement = NULL;
    private $insertStatement = NULL;
    private $updateStatment = NULL;
    
    public function __construct() {
        //connect
        $cm = new ConnectionManager();
        $this->conn = $cm->connect_db();
        if (is_null($this->conn)){
            throw new Exception("No connection");
        }
        
        //prepare statements
        $this->getByIdStatement = $this->conn->prepare($this->getByIdStatementString);
        if (is_null($this->getByIdStatement)){
            throw new Exception("Failed to prepare statement");
        }
    }
    
    
}



