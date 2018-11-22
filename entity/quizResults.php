<?php

class QuizResults implements JsonSerializable{
    
    private $id;
    private $userId;
    private $quizId;
    private $startTime;
    private $endTime;
    private $answers;
    private $score;
    
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

    function getScore() {
        return $this->score;
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
    function __construct($id, $userId, $quizId, $startTime, $endTime, $answers, $score) {
        $this->id = $id;
        $this->userId = $userId;
        $this->quizId = $quizId;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->answers = $answers;
        $this->score = $score;
    }
    
    public function jsonSerialize() {
        return get_object_vars($this);
    }

    
}

