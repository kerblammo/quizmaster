<?php

$projectRoot = filter_input(INPUT_SERVER, "DOCUMENT_ROOT") . '/QuizMasterBackend';
require_once 'ConnectionManager.php';
require_once ($projectRoot . '/entity/question.php');

class QuestionAccessor {

    //CRUD Strings
    private $getByIdStatementString = "SELECT * FROM question WHERE id = :id";
    private $getByTitleStatementString = "SELECT * FROM question WHERE questionText LIKE :questionText";
    private $getByTagStatementString = "SELECT * FROM question WHERE tags LIKE :tags";
    private $getByChoiceStatementString = "SELECT * FROM question WHERE choices LIKE :choices";
    private $deleteStatementString = "DELETE FROM question WHERE id = :id";
    private $insertStatementString = "INSERT INTO question (questionText, description, choices, answer, tags) VALUES (:questionText, :description, :choices, :answer, :tags)";
    private $updateStatementString = "UPDATE quiz SET questionText = :questionText, description = :description, choices = :choices, answer = :answer, tags = :tags WHERE id = :id";
    //connection
    private $conn = NULL;
    //statements
    private $getByIdStatement = NULL;
    private $getByTitleStatement = NULL;
    private $getByTagStatement = NULL;
    private $getByChoiceStatement = NULL;
    private $deleteStatement = NULL;
    private $insertStatement = NULL;
    private $updateStatement = NULL;

    public function __construct() {
        //connect
        $cm = new ConnectionManager();
        $this->conn = $cm->connect_db();
        if (is_null($this->conn)) {
            throw new Exception("No connection");
        }

        //prepare statements
        $this->getByIdStatement = $this->conn->prepare($this->getByIdStatementString);
        if (is_null($this->getByIdStatement)) {
            throw new Exception("Could not prepare statement: " . $this->getByIdStatementString);
        }
        $this->getByTitleStatement = $this->conn->prepare($this->getByTitleStatementString);
        if (is_null($this->getByTitleStatement)) {
            throw new Exception("Could not prepare statement: " . $this->getByTitleStatementString);
        }
        $this->getByTagStatement = $this->conn->prepare($this->getByTagStatementString);
        if (is_null($this->getByTagStatement)) {
            throw new Exception("Could not prepare statement: " . $this->getByTagStatementString);
        }
        $this->getByChoiceStatement = $this->conn->prepare($this->getByChoiceStatementString);
        if (is_null($this->getByChoiceStatement)) {
            throw new Exception("Could not prepare statement: " . $this->getByChoiceStatementString);
        }
        $this->deleteStatement = $this->conn->prepare($this->deleteStatementString);
        if (is_null($this->deleteStatement)) {
            throw new Exception("Could not prepare statement: " . $this->deleteStatementString);
        }
        $this->insertStatement = $this->conn->prepare($this->insertStatementString);
        if (is_null($this->insertStatement)) {
            throw new Exception("Could not prepare statement: " . $this->insertStatementString);
        }
        $this->updateStatement = $this->conn->prepare($this->updateStatementString);
        if (is_null($this->updateStatement)) {
            throw new Exception("Could not prepare statement: " . $this->updateStatementString);
        }
    }

    /**
     * Executes a query to select questions. Returns an array of question objects
     * @param string $statement
     * @return array
     */
    public function getQuestionsByQuery($statement) {
        $result = [];

        try {
            $stmt = $this->conn->prepare($statement);
            $stmt->execute();
            $dbResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($dbResults as $r) {
                $id = $r['Id'];
                $questionText = $r['QuestionText'];
                $description = $r['Description'];
                $choices = $r['Choices'];
                $answer = $r['Answer'];
                $tags = $r['Tags'];
                $question = new Question($id, $questionText, $description, $choices, $answer, $tags);
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

    public function getAllQuestions() {
        return $this->getQuestionsByQuery("SELECT * FROM question");
    }

    public function getQuestionById($id) {
        $result = NULL;

        try {
            $this->getByIdStatement->bindParam(":id", $id);
            $this->getByIdStatement->execute();
            $dbResult = $this->getByIdStatement->fetch(PDO::FETCH_ASSOC);
            if ($dbResult) {
                $id = $dbResult['Id'];
                $questionText = $dbResult['QuestionText'];
                $description = $dbResult['Description'];
                $choices = $dbResult['Choices'];
                $answer = $dbResult['Answer'];
                $tags = $dbResult['Tags'];
                $result = new Question($id, $questionText, $description, $choices, $answer, $tags);
            }
        } catch (Exception $ex) {
            $result = NULL;
        } finally {
            if (!is_null($this->getByIdStatement)) {
                $this->getByIdStatement->closeCursor();
            }
        }

        return $result;
    }

    public function getQuestionsByTag($tag) {
        $results = [];

        try {
            $tag = '%' . $tag . '%';
            $this->getByTagStatement->bindParam(":tag", $tag);
            $this->getByTagStatement->execute();
            $dbResults = $this->getByTagStatement->fetchAll(PDO::FETCH_ASSOC);

            foreach ($dbResults as $r) {
                $id = $r['Id'];
                $questionText = $r['QuestionText'];
                $description = $r['Description'];
                $choices = $r['Choices'];
                $answer = $r['Answer'];
                $tags = $r['Tags'];
                $question = new Question($id, $questionText, $description, $choices, $answer, $tags);
                array_push($results, $question);
            }
        } catch (Exception $ex) {
            $results = [];
        } finally {
            if (!is_null($this->getByTagStatement)) {
                $this->getByTagStatement->closeCursor();
            }
        }
        return $results;
    }

    public function getQuestionsByName($name) {
        $results = [];

        try {
            $name = '%' . $name . '%';
            $this->getByTitleStatement->bindParam(":title", $name);
            $this->getByTitleStatement->execute();
            $dbResults = $this->getByTitleStatement->fetchAll(PDO::FETCH_ASSOC);

            foreach ($dbResults as $r) {
                $id = $r['Id'];
                $questionText = $r['QuestionText'];
                $description = $r['Description'];
                $choices = $r['Choices'];
                $answer = $r['Answer'];
                $tags = $r['Tags'];
                $question = new Question($id, $questionText, $description, $choices, $answer, $tags);
                array_push($results, $question);
            }
        } catch (Exception $ex) {
            $results = [];
        } finally {
            if (!is_null($this->getByTitleStatement)) {
                $this->getByTitleStatement->closeCursor();
            }
        }
        return $results;
    }

    public function getQuestionsByChoices($choices) {
        $results = [];

        try {
            $choices = '%' . $choices . '%';
            $this->getByChoiceStatement->bindParam(":choices", $choices);
            $this->getByChoiceStatement->execute();
            $dbResults = $this->getByChoiceStatement->fetchAll(PDO::FETCH_ASSOC);

            foreach ($dbResults as $r) {
                $id = $r['Id'];
                $questionText = $r['QuestionText'];
                $description = $r['Description'];
                $choices = $r['Choices'];
                $answer = $r['Answer'];
                $tags = $r['Tags'];
                $question = new Question($id, $questionText, $description, $choices, $answer, $tags);
                array_push($results, $question);
            }
        } catch (Exception $ex) {
            $results = [];
        } finally {
            if (!is_null($this->getByChoiceStatement)) {
                $this->getByChoiceStatement->closeCursor();
            }
        }
        return $results;
    }

    public function deleteQuestion($question) {

        $id = $question->getId();
        if (!$this->isQuestionUsedInQuiz($id)) {

            try {
                $this->deleteStatement->bindParam(":id", $id);
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
        } else {
            $success = false;
        }
        return $success;
    }

    public function insertQuestion($question) {

        $questionText = $question->getQuestionText();
        $description = $question->getDescription();
        $choices = $question->getChoices();
        $answer = $question->getAnswer();
        $tags = $question->getTags();
        try {
            $this->insertStatement->bindParam(":questionText", $questionText);
            $this->insertStatement->bindParam(":description", $description);
            $this->insertStatement->bindParam(":choices", $choices);
            $this->insertStatement->bindParam(":answer", $answer);
            $this->insertStatement->bindParam(":tags", $tags);
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

    public function updateQuestion($question) {

        $id = $question->getId();
        $questionText = $question->getQuestionText();
        $description = $question->getDescription();
        $choices = $question->getChoices();
        $answer = $question->getAnswer();
        $tags = $question->getTags();
        if (!$this->isQuestionUsedInQuiz($id)) {
            try {
                $this->updateStatement->bindParam(":id", $id);
                $this->updateStatement->bindParam(":questionText", $questionText);
                $this->updateStatement->bindParam(":description", $description);
                $this->updateStatement->bindParam(":choices", $choices);
                $this->updateStatement->bindParam(":answer", $answer);
                $this->updateStatement->bindParam(":tags", $tags);
                $success = $this->updateStatement->execute();
            } catch (Exception $ex) {
                $success = false;
            } finally {
                if (!is_null($this->updateStatement)) {
                    $this->updateStatement->closeCursor();
                }
            }
        } else {
            $success = false;
        }
        return $success;
    }

    private function isQuestionUsedInQuiz($id) {
        $stmt = $this->conn->prepare("SELECT questionId FROM quizquestion WHERE questionId = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $dbResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return count($dbResults) > 0;
    }

}
