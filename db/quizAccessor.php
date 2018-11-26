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
    private $insertStatementString = "INSERT INTO quiz (authorId, title, description, tags) VALUES (:authorId, :title, :description, :tags)";
    private $updateStatementString = "UPDATE quiz SET title = :title, description = :description, tags = :tags WHERE id = :id";
    
    //connection
    private $conn = NULL;
    
    //statements
    private $getByIdStatement = NULL;
    private $getByNameStatement = NULL;
    private $getByTagStatement = NULL;
    private $deleteStatement = NULL;
    private $insertStatement = NULL;
    private $updateStatement = NULL;
    
    /**
     * Prepare the connection manager and future query statements
     * Will throw exception if there is a problem with ConnectionManager
     * (bad credentials possibly) or query strings 
     * @throws Exception
     */
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
            throw new Exception("Could not prepare statement: " . $this->getByIdStatementString);
        }
        $this->getByNameStatement = $this->conn->prepare($this->getByNameStatementString);
        if (is_null($this->getByNameStatement)){
            throw new Exception("Could not prepare statement: " . $this->getByNameStatementString);
        }
        $this->getByTagStatement = $this->conn->prepare($this->getByTagStatementString);
        if (is_null($this->getByTagStatement)){
            throw new Exception("Could not prepare statement: " . $this->getByTagStatementString);
        }
        $this->deleteStatement = $this->conn->prepare($this->deleteStatementString);
        if (is_null($this->deleteStatement)){
            throw new Exception("Could not prepare statement: " . $this->deleteStatementString);
        }
        $this->insertStatement = $this->conn->prepare($this->insertStatementString);
        if (is_null($this->insertStatement)){
            throw new Exception("Could not prepare statement: " . $this->insertStatementString);
        }
        $this->updateStatement = $this->conn->prepare($this->updateStatementString);
        if (is_null($this->updateStatement)){
            throw new Exception("Could not prepare statement: " . $this->updateStatementString);
        }
        
    }
    
    /**
     * Executes a query to select users. Returns an array of user objects
     * @param string $statement
     * @return array
     */
    public function getQuizzesByQuery($statement){
        $result = [];
        
        try {
            $stmt = $this->conn->prepare($statement);
            $stmt->execute();
            $dbResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($dbResults as $r){
                $id = $r['Id'];
                $authorId = $r['AuthorId'];
                $title = $r['Title'];
                $description = $r['Description'];
                $tags = $r['Tags'];
                $quiz = new Quiz($id, $authorId, $title, $description, $tags);
                array_push($result, $quiz);
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
     * Get all quizzes from database
     * @return array
     */
    public function getAllQuizzes(){
        return $this->getQuizzesByQuery("SELECT * FROM quiz");
    }
    
    /**
     * Fetch the quiz which matches the supplied id
     * @param Integer $id
     * @return Quiz
     */
    public function getQuizById($id){
        $result = NULL;
        
        try {
            $this->getByIdStatement->bindParam(":id", $id);
            $this->getByIdStatement->execute();
            $dbResult = $this->getByIdStatement->fetch(PDO::FETCH_ASSOC);
            if ($dbResult){
                $id = $dbResult['Id'];
                $authorId = $dbResult['AuthorId'];
                $title = $dbResult['Title'];
                $description = $dbResult['Description'];
                $tags = $dbResult['Tags'];
                $result = new Quiz($id, $authorId, $title, $description, $tags);
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
     * Get all quizzes which contain the supplied name
     * @param string $name
     * @return array
     */
    public function getQuizByName($name){
        $results = [];
        
        try {
            $name = '%' . $name . '%';
            $this->getByNameStatement->bindParam(":title", $name);
            $this->getByNameStatement->execute();
            $dbResults = $this->getByNameStatement->fetchAll(PDO::FETCH_ASSOC);
            
            foreach($dbResults as $r){
                $id = $r['Id'];
                $authorId = $r['AuthorId'];
                $title = $r['Title'];
                $description = $r['Description'];
                $tags = $r['Tags'];
                $quiz = new Quiz($id, $authorId, $title, $description, $tags);
                array_push($results, $quiz);
            }
        } catch (Exception $ex) {
            $results = [];
        } finally {
            if (!is_null($this->getByNameStatement)){
                $this->getByNameStatement->closeCursor();
            }
        }
        return $results;
    }
    
    /**
     * Get all quizzes whose tags contain the supplied tag
     * @param string $tag
     * @return array
     */
    public function getQuizByTag($tag){
        $results = [];
        
        try {
            $tag = '%' . $tag . '%';
            $this->getByTagStatement->bindParam(":tags", $tag);
            $this->getByTagStatement->execute();
            $dbResults = $this->getByTagStatement->fetchAll(PDO::FETCH_ASSOC);
            
            foreach($dbResults as $r){
                $id = $r['Id'];
                $authorId = $r['AuthorId'];
                $title = $r['Title'];
                $description = $r['Description'];
                $tags = $r['Tags'];
                $quiz = new Quiz($id, $authorId, $title, $description, $tags);
                array_push($results, $quiz);
            }
        } catch (Exception $ex) {
            $results = [];
        } finally {
            if (!is_null($this->getByTagStatement)){
                $this->getByTagStatement->closeCursor();
            }
        }
        return $results;
    }
    
    /**
     * Delete the quiz whose id matches the supplied
     * quiz's id
     * @param Quiz $quiz
     * @return boolean
     */
    public function deleteQuiz($quiz){
        
        $id = $quiz->getId();
        try {
            $this->deleteStatement->bindParam(":id", $id);
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
     * Insert the supplied quiz into the database
     * @param Quiz $quiz
     * @return boolean
     */
    public function insertQuiz($quiz){
        
        $authorId = $quiz->getAuthorId();
        $title = $quiz->getTitle();
        $description = $quiz->getDescription();
        $tags = $quiz->getTags();
        try {
            $this->insertStatement->bindParam(":authorId", $authorId);
            $this->insertStatement->bindParam(":title", $title);
            $this->insertStatement->bindParam(":description", $description);
            $this->insertStatement->bindParam(":tags", $tags);
            $success = $this->insertStatement->execute();
        } catch (Exception $ex) {
            echo $ex->getMessage();
            $success = false;
        } finally {
            if (!is_null($this->insertStatement)){
                $this->insertStatement->closeCursor();
            }
        }
        return $success;
        
    }
    
    /**
     * Modify a quiz in the database. Supply a quiz with
     * matching ID to change all its parameters
     * @param Quiz $quiz
     * @return boolean
     */
    public function updateQuiz($quiz){
        
        $id = $quiz->getId();
        $title = $quiz->getTitle();
        $description = $quiz->getDescription();
        $tags = $quiz->getTags();
        try {
            $this->updateStatement->bindParam(":id", $id);
            $this->updateStatement->bindParam(":title", $title);
            $this->updateStatement->bindParam(":description", $description);
            $this->updateStatement->bindParam(":tags", $tags);
            $success = $this->updateStatement->execute();
        } catch (Exception $ex) {
            $success = false;
        } finally {
            if (!is_null($this->updateStatement)){
                $this->updateStatement->closeCursor();
            }
        }
        return $success;
    }
}



