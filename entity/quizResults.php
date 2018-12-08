<?php

class QuizResults implements JsonSerializable{
    
    private $id;
    private $userId;
    private $quizId;
    private $startTime;
    private $endTime;
    private $answers;
    private $scores;
    private $total;
    
    function getId() {
        return $this->id;
    }

    function getUserId() {
        return $this->userId;
    }

    function getQuizId() {
        return $this->quizId;
    }

    function getStartTime() {
        return $this->startTime;
    }

    function getEndTime() {
        return $this->endTime;
    }

    function getAnswers() {
        return $this->answers;
    }

    function getScores() {
        return $this->scores;
    }
    
    function getTotal() {
        return $this->total;
    }

    /**
     * Construct a quiz result entity object
     * @param integer $id
     * @param integer $userId
     * @param integer $quizId
     * @param datetime $startTime
     * @param datetime $endTime
     * @param string[] $answers
     * @param decimal $score
     */
    function __construct($id, $userId, $quizId, $startTime, $endTime, $answers, $scores, $total) {
        $this->id = $id;
        $this->userId = $userId;
        $this->quizId = $quizId;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->answers = $answers;
        $this->scores = $scores;
        $this->total = $total;
    }
    
    public function jsonSerialize() {
        return get_object_vars($this);
    }

    
}

