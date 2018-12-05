<?php

class Quiz implements JsonSerializable{
    
    private $id;
    private $authorId;
    private $title;
    private $description;
    private $tags;
    private $questions;
    
    function getId() {
        return $this->id;
    }

    function getAuthorId() {
        return $this->authorId;
    }

    function getTitle() {
        return $this->title;
    }

    function getDescription() {
        return $this->description;
    }

    function getTags() {
        return $this->tags;
    }
    
    function getQuestions() {
        return $this->questions;
    }
    
    function setQuestions($questions){
        $this->questions = $questions;
    }

    
    /**
     * Construct a quiz entity object
     * @param integer $id
     * @param integer $authorId
     * @param string $title
     * @param string $description
     * @param string[] $tags
     * @param Question[] $questions
     */
    function __construct($id, $authorId, $title, $description, $tags, $questions) {
        $this->id = $id;
        $this->authorId = $authorId;
        $this->title = $title;
        $this->description = $description;
        $this->tags = $tags;
        $this->questions = $questions;
    }

    public function jsonSerialize() {
        return get_object_vars($this);
    }
}

