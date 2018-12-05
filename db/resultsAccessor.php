<?php

$projectRoot = filter_input(INPUT_SERVER, "DOCUMENT_ROOT") . '/QuizMasterBackend';
require_once 'ConnectionManager.php';
require_once ($projectRoot . '/entity/quizResults.php');

class ResultsAccessor {
    
    //CRUD strings
    //user specific
    private $getUserResultsStatementString = "SELECT * FROM quizresult WHERE userid = :userid";
    private $getUserResultsByQuizTitleStatementString = "SELECT * FROM quizresult r JOIN quiz q ON q.id = r.quizid WHERE r.userid = :userid AND q.title LIKE :title";
    private $getUserResultsByQuizTagStatementString = "SELECT * FROM quizresult r JOIN quiz q ON q.id = r.quizid WHERE r.userid = :userid AND q.tags LIKE :tags";
    private $getUserResultsByDateStatementString = "SELECT * FROM quizresult WHERE userid = :userid AND (endtime BETWEEN :start AND :end)";
    private $getUserResultsByScoreStatementString = "SELECT * FROM quizresult WHERE userid = :userid AND (score BETWEEN :min AND :max)";
    //all results
    private $getResultsByQuizTitleStatementString = "SELECT * FROM quizresult r JOIN quiz q ON q.id = r.quizid WHERE q.title LIKE :title";
    private $getResultsByQuizTagStatementString = "SELECT * FROM quizresult r JOIN quiz q ON q.id = r.quizid WHERE q.tags LIKE :tags";
    private $getResultsByQuestionNameStatementString = "SELECT * FROM quizresult WHERE quizid IN (SELECT quizid FROM quizquestion WHERE questionid IN (SELECT id FROM Question WHERE questionText LIKE :questiontext))";  
    private $getResultsByQuestionTagStatementString = "SELECT * FROM quizresult WHERE quizid IN (SELECT quizid FROM quizquestion WHERE questionid IN (SELECT id FROM question WHERE tags LIKE :tags))";
    private $getResultsByDateStatementString = "SELECT * FROM quizresult WHERE (endtime BETWEEN :start AND :end)";
    
    private $insertStatementString = "INSERT INTO quizresult (userid, quizid, starttime, endtime, answers, scores, total) VALUES (:userid, :quizid, :startime, NOW(), :answers, :scores, :total";
    
    //connection
    private $conn = null;
    
    //statements
    private $getUserResultsStatement = null;
    private $getUserResultsByQuizTitleStatement = null;
    private $getUserResultsByQuizTagStatement = null;
    private $getUserResultsByDateStatement = null;
    private $getUserResultsByScoreStatement = null;
    private $getResultsByQuizTitleStatement = null;
    private $getResultsByQuizTagStatement = null;
    private $getResultsByQuestionNameStatement = null;
    private $getResultsByQuestionTagStatement = null;
    private $getResultsByDateStatement = null;
    private $insertStatement = null;
    
    public function __construct() {
        //connect
        $cm = new ConnectionManager();
        $this->conn = $cm->connect_db();
        if (is_null($this->conn)) {
            throw new Exception("No connection");
        }
        
        //prepare statements
        $this->getUserResultsStatement = $this->conn->prepare($this->getUserResultsStatementString);
        if (is_null($this->getUserResultsStatement)) {
            throw new Exception("Could not prepare statement: " . $this->getUserResultsStatementString);
        }
        $this->getUserResultsByQuizTitleStatement = $this->conn->prepare($this->getUserResultsByQuizTitleStatementString);
        if (is_null($this->getUserResultsByQuizTitleStatement)) {
            throw new Exception("Could not prepare statement: " . $this->getUserResultsByQuizTitleStatementString);
        }
        $this->getUserResultsByQuizTagStatement = $this->conn->prepare($this->getUserResultsByQuizTagStatementString);
        if (is_null($this->getUserResultsByQuizTagStatement)) {
            throw new Exception("Could not prepare statement: " . $this->getUserResultsByQuizTagStatementString);
        }
        $this->getUserResultsByDateStatement = $this->conn->prepare($this->getUserResultsByDateStatementString);
        if (is_null($this->getUserResultsByDateStatement)) {
            throw new Exception("Could not prepare statement: " . $this->getUserResultsByDateStatementString);
        }
        $this->getUserResultsByScoreStatement = $this->conn->prepare($this->getUserResultsByScoreStatementString);
        if (is_null($this->getUserResultsByScoreStatement)) {
            throw new Exception("Could not prepare statement: " . $this->getUserResultsByScoreStatementString);
        }
        $this->getResultsByQuizTitleStatement = $this->conn->prepare($this->getResultsByQuizTitleStatementString);
        if (is_null($this->getResultsByQuizTitleStatement)) {
            throw new Exception("Could not prepare statement: " . $this->getResultsByQuizTitleStatementString);
        }
        $this->getResultsByQuizTagStatement = $this->conn->prepare($this->getResultsByQuizTagStatementString);
        if (is_null($this->getResultsByQuizTagStatement)) {
            throw new Exception("Could not prepare statement: " . $this->getResultsByQuizTagStatementString);
        }$this->getResultsByQuestionNameStatement = $this->conn->prepare($this->getResultsByQuestionNameStatementString);
        if (is_null($this->getResultsByQuestionNameStatement)) {
            throw new Exception("Could not prepare statement: " . $this->getResultsByQuestionNameStatementString);
        }
        $this->getResultsByQuestionTagStatement = $this->conn->prepare($this->getResultsByQuestionTagStatementString);
        if (is_null($this->getResultsByQuestionTagStatement)) {
            throw new Exception("Could not prepare statement: " . $this->getResultsByQuestionTagStatementString);
        }
        $this->getResultsByDateStatement = $this->conn->prepare($this->getResultsByDateStatementString);
        if (is_null($this->getResultsByDateStatement)) {
            throw new Exception("Could not prepare statement: " . $this->getResultsByDateStatementString);
        }
        $this->insertStatement = $this->conn->prepare($this->insertStatementString);
        if (is_null($this->insertStatement)) {
            throw new Exception("Could not prepare statement: " . $this->insertStatementString);
        }
        
    }
    
    
    public function getResultsByQuery($statement) {
        $result = [];

        try {
            $stmt = $this->conn->prepare($statement);
            $stmt->execute();
            $dbResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($dbResults as $r) {
                $id = $r['Id'];
                $userId = $r['UserId'];
                $quizId = $r['QuizId'];
                $startTime = $r['StartTime'];
                $endTime = $r['EndTime'];
                $answers = $r['Answers'];
                $scores = $r['Scores'];
                $total = $r['Total'];
                $obj = new QuizResults($id, $userId, $quizId, $startTime, $endTime, $answers, $scores, $total);
                array_push($result, $obj);
            }
        } catch (Exception $ex) {
            $result = [];
        } finally {
            if (!is_null($stmt)) {
                $stmt->closeCursor();
            }
        }
        return $result;
    }
    
    public function getAllResults(){
        return $this->getResultsByQuery("SELECT * FROM quizresult");
    }
    
    public function getUserResults($userId){
        $result = [];

        try {
            $this->getUserResultsStatement->bindParam(":userid", $userId);
            $this->getUserResultsStatement->execute();
            $dbResults = $this->getUserResultsStatement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($dbResults as $r) {
                $id = $r['Id'];
                $userId = $r['UserId'];
                $quizId = $r['QuizId'];
                $startTime = $r['StartTime'];
                $endTime = $r['EndTime'];
                $answers = $r['Answers'];
                $scores = $r['Scores'];
                $total = $r['Total'];
                $obj = new QuizResults($id, $userId, $quizId, $startTime, $endTime, $answers, $scores, $total);
                array_push($result, $obj);
            }
        } catch (Exception $ex) {
            $result = [];
        } finally {
            if (!is_null($stmt)) {
                $stmt->closeCursor();
            }
        }
        return $result;
    }
    
    public function getUserResultsByQuizTitle($userId, $title){
        $result = [];

        try {
            $this->getUserResultsByQuizTitleStatement->bindParam(":userid", $userId);
            $this->getUserResultsByQuizTitleStatement->bindParam(":title", $title);
            $this->getUserResultsByQuizTitleStatement->execute();
            $dbResults = $this->getUserResultsByQuizTitleStatement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($dbResults as $r) {
                $id = $r['Id'];
                $userId = $r['UserId'];
                $quizId = $r['QuizId'];
                $startTime = $r['StartTime'];
                $endTime = $r['EndTime'];
                $answers = $r['Answers'];
                $scores = $r['Scores'];
                $total = $r['Total'];
                $obj = new QuizResults($id, $userId, $quizId, $startTime, $endTime, $answers, $scores, $total);
                array_push($result, $obj);
            }
        } catch (Exception $ex) {
            $result = [];
        } finally {
            if (!is_null($stmt)) {
                $stmt->closeCursor();
            }
        }
        return $result;
    }
    
    public function getUserResultsByQuizTag($userId, $tag){
        $result = [];

        try {
            $this->getUserResultsByQuizTagStatement->bindParam(":userid", $userId);
            $this->getUserResultsByQuizTagStatement->bindParam(":tags", $tag);
            $this->getUserResultsByQuizTagStatement->execute();
            $dbResults = $this->getUserResultsByQuizTagStatement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($dbResults as $r) {
                $id = $r['Id'];
                $userId = $r['UserId'];
                $quizId = $r['QuizId'];
                $startTime = $r['StartTime'];
                $endTime = $r['EndTime'];
                $answers = $r['Answers'];
                $scores = $r['Scores'];
                $total = $r['Total'];
                $obj = new QuizResults($id, $userId, $quizId, $startTime, $endTime, $answers, $scores, $total);
                array_push($result, $obj);
            }
        } catch (Exception $ex) {
            $result = [];
        } finally {
            if (!is_null($stmt)) {
                $stmt->closeCursor();
            }
        }
        return $result;
    }
    
    public function getUserResultsByDate($userId, $from, $to){
        $result = [];

        try {
            $this->getUserResultsByDateStatement->bindParam(":userid", $userId);
            $this->getUserResultsByDateStatement->bindParam(":start", $from);
            $this->getUserResultsByDateStatement->bindParam(":end", $to);
            $this->getUserResultsByDateStatement->execute();
            $dbResults = $this->getUserResultsByDateStatement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($dbResults as $r) {
                $id = $r['Id'];
                $userId = $r['UserId'];
                $quizId = $r['QuizId'];
                $startTime = $r['StartTime'];
                $endTime = $r['EndTime'];
                $answers = $r['Answers'];
                $scores = $r['Scores'];
                $total = $r['Total'];
                $obj = new QuizResults($id, $userId, $quizId, $startTime, $endTime, $answers, $scores, $total);
                array_push($result, $obj);
            }
        } catch (Exception $ex) {
            $result = [];
        } finally {
            if (!is_null($stmt)) {
                $stmt->closeCursor();
            }
        }
        return $result;
    }
    
    
    public function getUserResultsByScore($userId, $min, $max){
        $result = [];

        try {
            $this->getUserResultsByDateStatement->bindParam(":userid", $userId);
            $this->getUserResultsByDateStatement->bindParam(":min", $min);
            $this->getUserResultsByDateStatement->bindParam(":max", $max);
            $this->getUserResultsByDateStatement->execute();
            $dbResults = $this->getUserResultsByDateStatement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($dbResults as $r) {
                $id = $r['Id'];
                $userId = $r['UserId'];
                $quizId = $r['QuizId'];
                $startTime = $r['StartTime'];
                $endTime = $r['EndTime'];
                $answers = $r['Answers'];
                $scores = $r['Scores'];
                $total = $r['Total'];
                $obj = new QuizResults($id, $userId, $quizId, $startTime, $endTime, $answers, $scores, $total);
                array_push($result, $obj);
            }
        } catch (Exception $ex) {
            $result = [];
        } finally {
            if (!is_null($stmt)) {
                $stmt->closeCursor();
            }
        }
        return $result;
    }
    
    public function getResultsByQuizTitle($title){
        $result = [];

        try {
            $this->getResultsByQuizTitleStatement->bindParam(":title", $title);
            $this->getResultsByQuizTitleStatement->execute();
            $dbResults = $this->getResultsByQuizTitleStatement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($dbResults as $r) {
                $id = $r['Id'];
                $userId = $r['UserId'];
                $quizId = $r['QuizId'];
                $startTime = $r['StartTime'];
                $endTime = $r['EndTime'];
                $answers = $r['Answers'];
                $scores = $r['Scores'];
                $total = $r['Total'];
                $obj = new QuizResults($id, $userId, $quizId, $startTime, $endTime, $answers, $scores, $total);
                array_push($result, $obj);
            }
        } catch (Exception $ex) {
            $result = [];
        } finally {
            if (!is_null($stmt)) {
                $stmt->closeCursor();
            }
        }
        return $result;
    }
    
    
    public function getResultsByQuizTag($tag){
        $result = [];

        try {
            $this->getResultsByQuestionTagStatement->bindParam(":tags", $tag);
            $this->getResultsByQuestionTagStatement->execute();
            $dbResults = $this->getResultsByQuestionTagStatement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($dbResults as $r) {
                $id = $r['Id'];
                $userId = $r['UserId'];
                $quizId = $r['QuizId'];
                $startTime = $r['StartTime'];
                $endTime = $r['EndTime'];
                $answers = $r['Answers'];
                $scores = $r['Scores'];
                $total = $r['Total'];
                $obj = new QuizResults($id, $userId, $quizId, $startTime, $endTime, $answers, $scores, $total);
                array_push($result, $obj);
            }
        } catch (Exception $ex) {
            $result = [];
        } finally {
            if (!is_null($stmt)) {
                $stmt->closeCursor();
            }
        }
        return $result;
    }
    
    public function getResultsByQuestionTitle($title){
        $result = [];

        try {
            $this->getResultsByQuestionTagStatement->bindParam(":questiontext", $title);
            $this->getResultsByQuestionTagStatement->execute();
            $dbResults = $this->getResultsByQuestionTagStatement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($dbResults as $r) {
                $id = $r['Id'];
                $userId = $r['UserId'];
                $quizId = $r['QuizId'];
                $startTime = $r['StartTime'];
                $endTime = $r['EndTime'];
                $answers = $r['Answers'];
                $scores = $r['Scores'];
                $total = $r['Total'];
                $obj = new QuizResults($id, $userId, $quizId, $startTime, $endTime, $answers, $scores, $total);
                array_push($result, $obj);
            }
        } catch (Exception $ex) {
            $result = [];
        } finally {
            if (!is_null($stmt)) {
                $stmt->closeCursor();
            }
        }
        return $result;
    }
    
    
    public function getResultsByQuestionTag($tag){
        $result = [];

        try {
            $this->getResultsByQuestionTagStatement->bindParam(":tags", $tag);
            $this->getResultsByQuestionTagStatement->execute();
            $dbResults = $this->getResultsByQuestionTagStatement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($dbResults as $r) {
                $id = $r['Id'];
                $userId = $r['UserId'];
                $quizId = $r['QuizId'];
                $startTime = $r['StartTime'];
                $endTime = $r['EndTime'];
                $answers = $r['Answers'];
                $scores = $r['Scores'];
                $total = $r['Total'];
                $obj = new QuizResults($id, $userId, $quizId, $startTime, $endTime, $answers, $scores, $total);
                array_push($result, $obj);
            }
        } catch (Exception $ex) {
            $result = [];
        } finally {
            if (!is_null($stmt)) {
                $stmt->closeCursor();
            }
        }
        return $result;
    }
    
    public function getResultsByDate($from, $to){
        $result = [];

        try {
            $this->getResultsByDateStatement->bindParam(":start", $from);
            $this->getResultsByDateStatement->bindParam(":end", $to);
            $this->getResultsByDateStatement->execute();
            $dbResults = $this->getResultsByDateStatement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($dbResults as $r) {
                $id = $r['Id'];
                $userId = $r['UserId'];
                $quizId = $r['QuizId'];
                $startTime = $r['StartTime'];
                $endTime = $r['EndTime'];
                $answers = $r['Answers'];
                $scores = $r['Scores'];
                $total = $r['Total'];
                $obj = new QuizResults($id, $userId, $quizId, $startTime, $endTime, $answers, $scores, $total);
                array_push($result, $obj);
            }
        } catch (Exception $ex) {
            $result = [];
        } finally {
            if (!is_null($stmt)) {
                $stmt->closeCursor();
            }
        }
        return $result;
    }
    
    public function insertResult($result) {

        $quizId = $result->getQuizId();
        $userId = $result->getUserId();
        $scores = $result->getScores();
        $answers = $result->getAnswers();
        $total = $result->getTotal();
        $startTime = $result->getStartTime();
        try {
            $this->insertStatement->bindParam(":quizid", $quizId);
            $this->insertStatement->bindParam(":userid", $userId);
            $this->insertStatement->bindParam(":scores", $scores);
            $this->insertStatement->bindParam(":answers", $answers);
            $this->insertStatement->bindParam(":total", $total);
            $this->insertStatement->bindParam(":starttime", $startTime);
            $success = $this->insertStatement->execute();
        } catch (Exception $ex) {
            echo $ex->getMessage();
            $success = false;
        } finally {
            if (!is_null($this->insertStatement)) {
                $this->insertStatement->closeCursor();
            }
        }
        return $success;
    }
    
}

