<?php

class User implements JsonSerializable {
    
    private $id;
    private $permissionId;
    private $username;
    private $password;
    private $deactivated;
    
    function getId() {
        return $this->id;
    }

    function getPermissionId() {
        return $this->permissionId;
    }

    function getUsername() {
        return $this->username;
    }

    function getPassword() {
        return $this->password;
    }

    function getDeactivated() {
        return $this->deactivated;
    }

    /**
     * Construct a user entity
     * @param integer $id
     * @param integer $permissionId
     * @param string $username
     * @param string $password
     * @param boolean $deactivated
     */
    function __construct($id, $permissionId, $username, $password, $deactivated) {
        $this->id = $id;
        $this->permissionId = $permissionId;
        $this->username = $username;
        $this->password = $password;
        $this->deactivated = $deactivated;
    }
    
    public function jsonSerialize() {
        return get_object_vars($this);
    }

    
}

