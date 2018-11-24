<?php

class Quiz implements JsonSerializable{
    
    private $id;
    private $authorId;
    private $title;
    private $description;
    private $tags;
    
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

    
    /**
     * Construct a quiz entity object
     * @param integer $id
     * @param integer $authorId
     * @param string $title
     * @param string $description
     * @param integer[] $evaluationScheme
     * @param string[] $tags
     */
    function __construct($id, $authorId, $title, $description, $tags) {
        $this->id = $id;
        $this->authorId = $authorId;
        $this->title = $title;
        $this->description = $description;
        $this->tags = $tags;
    }

    public function jsonSerialize() {
        return get_object_vars($this);
    }
}

