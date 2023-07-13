<?php
class User {

    private ?int $id;
    private string $email;
    private string $username;
    private string $password;
    
    public function __construct(string $username, string $email, string $password){
        $this->id = null;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }
    public function getId() :? int
    {
        return $this->id;
    }
    public function getUsername() : string
    {
        return $this->username;
    }
    public function getEmail() : string
    {
        return $this->email;
    }
    public function getPassword() : string
    {
        return $this->password;
    }
    
    public function setId(string $id) : void
    {
        $this->id = $id;
    }
    public function setUsername(string $username) : void
    {
        $this->username = $username;
    }
    public function setEmail($email) : void
    {
        $this->email = $email;
    }
    public function setPassword(string $password) : void
    {
        $this->password = $password;
    }
}

?>