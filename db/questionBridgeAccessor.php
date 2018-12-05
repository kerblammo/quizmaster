<?php

require_once 'ConnectionManager.php';
require_once ('../entity/questionQuizBridge.php');

class QuestionBridgeAccessor {

    //CRUD Strings
    private $getByQuizStatementString = "SELECT * FROM quizquestion WHERE quizid = :quizid";
    private $insertStatementString = "INSERT INTO quizquestion VALUES (:quizid, :questionid, :value)";
    private $updateStatementString = "UPDATE quizquestion SET value = :value WHERE quizid = :quizid AND questionid = :questionid";
    private $deleteStatementString = "DELETE FROM quizquestion WHERE quizid = :quizid AND questionid = :questionid";
    private $conn = NULL;
    private $getByQuizStatement = NULL;
    private $insertStatement = NULL;
    private $updateStatement = NULL;
    private $deleteStatement = NULL;

    public function __construct() {
        //connect
        $cm = new ConnectionManager();
        $this->conn = $cm->connect_db();
        if (is_null($this->conn)) {
            throw new Exception("No connection");
        }

        //prepare statements
        $this->getByQuizStatement = $this->conn->prepare($this->getByQuizStatementString);
        if (is_null($this->getByQuizStatement)) {
            throw new Exception("Could not prepare statement: " . $this->getByQuizStatementString);
        }
        $this->insertStatement = $this->conn->prepare($this->insertStatementString);
        if (is_null($this->insertStatement)) {
            throw new Exception("Could not prepare statement: " . $this->insertStatementString);
        }
        $this->updateStatement = $this->conn->prepare($this->updateStatementString);
        if (is_null($this->updateStatement)) {
            throw new Exception("Could not prepare statement: " . $this->updateStatementString);
        }
        $this->deleteStatement = $this->conn->prepare($this->deleteStatementString);
        if (is_null($this->deleteStatement)) {
            throw new Exception("Could not prepare statement: " . $this->deleteStatementString);
        }
    }

    /**
     * Executes a query to select questions. Returns an array of question objects
     * @param string $statement
     * @return array
     */
    public function getRecordssByQuery($statement) {
        $result = [];

        try {
            $stmt = $this->conn->prepare($statement);
            $stmt->execute();
            $dbResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($dbResults as $r) {
                $quizId = $r['QuizId'];
                $questionId = $r['QuestionId'];
                $value = $r['Value'];

                $question = new QuestionQuizBridge($quizId, $questionId, $value);
                array_push($result, $question);
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

    public function getAllRecords() {
        return $this->getQuestionsByQuery("SELECT * FROM quizquestion");
    }

    public function getRecordByQuizId($quizId) {
        $result = [];

        try {
            $this->getByQuizStatement->bindParam(":quizid", $quizId);
            $this->getByQuizStatement->execute();
            $dbResult = $this->getByQuizStatement->fetchAll(PDO::FETCH_ASSOC);
            foreach($dbResult as $r) {
                $quizId = $r['QuizId'];
                $questionId = $r['QuestionId'];
                $value = $r['value'];
                $obj = new QuestionQuizBridge($quizId, $questionId, $value);
                array_push($result, $obj); 
            }
            
        } catch (Exception $ex) {
            $result = [];
        } finally {
            if (!is_null($this->getByQuizStatement)) {
                $this->getByQuizStatement->closeCursor();
            }
        }
        return $result;
    }

    public function deleteQuestion($record) {

        $quiz = $record->getQuizId();
        $question = $record->getQuestionId();

        try {
            $this->deleteStatement->bindParam(":quizid", $quiz);
            $this->deleteStatement->bindParam(":questionid", $question);
            $this->deleteStatement->execute();
            $rc = $this->deleteStatement->rowCount();
            $success = $rc > 0;
        } catch (Exception $ex) {
            $success = false;
        } finally {
            if (!is_null($this->deleteStatement)) {
                $this->deleteStatement->closeCursor();
            }
        }

        return $success;
    }

    public function insertQuestion($record) {

        $questionId = $record->getQuestionId();
        $quizId = $record->getQuizId();
        $value = $record->getValue();
        try {
            $this->insertStatement->bindParam(":questionText", $questionId);
            $this->insertStatement->bindParam(":description", $quizId);
            $this->insertStatement->bindParam(":choices", $value);
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

    public function updateQuestion($record) {

        $questionId = $record->getQuestionId();
        $quizId = $record->getQuizId();
        $value = $record->getValue();

        try {
            $this->insertStatement->bindParam(":questionText", $questionId);
            $this->insertStatement->bindParam(":description", $quizId);
            $this->insertStatement->bindParam(":choices", $value);
            $success = $this->updateStatement->execute();
        } catch (Exception $ex) {
            $success = $ex->getMessage();
        } finally {
            if (!is_null($this->updateStatement)) {
                $this->updateStatement->closeCursor();
            }
        }

        return $success;
    }

}
