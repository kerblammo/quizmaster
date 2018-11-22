<?php

class Question implements JsonSerializable {
    
    private $id;
    private $questionText;
    private $description;
    private $choices;
    private $answer;
    private $tags;
    
    
    function getId() {
        return $this->id;
    }

    function getQuestionText() {
        return $this->questionText;
    }

    function getDescription() {
        return $this->description;
    }

    function getChoices() {
        return $this->choices;
    }

    function getAnswer() {
        return $this->answer;
    }

    function getTags() {
        return $this->tags;
    }

    /**
     * Construct a question entity.
     * @param integer $id
     * @param string $questionText
     * @param string $description
     * @param string[] $choices
     * @param string $answer
     * @param string[] $tags
     */
    function __construct($id, $questionText, $description, $choices, $answer, $tags) {
        $this->id = $id;
        $this->questionText = $questionText;
        $this->description = $description;
        $this->choices = $choices;
        $this->answer = $answer;
        $this->tags = $tags;
    }
    
    public function jsonSerialize() {
        return get_object_vars($this);
    }

    
    
}

