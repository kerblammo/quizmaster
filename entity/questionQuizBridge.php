<?php

class QuestionQuizBridge implements JsonSerializable {
    private $quizId;
    private $questionId;
    private $value;
    
    function getQuizId() {
        return $this->quizId;
    }

    function getQuestionId() {
        return $this->questionId;
    }

    function getValue() {
        return $this->value;
    }

    function setValue($value) {
        $this->value = $value;
    }

    function __construct($quizId, $questionId, $value) {
        $this->quizId = $quizId;
        $this->questionId = $questionId;
        $this->value = $value;
    }
    
    function jsonSerialize() {
        return get_object_vars($this);
    }

}

