<?php
    class Post {

    private ?int $id;
    private string $content;
    private date $postDate;
    private int $user_id;
    private int $room_id;
    //user_id à revoir 

    public function __construct(string $content, date $postDate, int $user_id, in $room_id) 
        {
            $this->id = null;
            $this->content = $content;
            $this->postDate = $postDate;
            $this->user_id = $user_id;
            $this->room_id = $room_id;
            
         //comment gérer les date et les clé étrangères? 

        }
    
        // les accesseurs de l'attribut id
        
            public function getId() : ?int 
            {
                return $this->id;
            }
        
        public function setId(?int $id) : void
            {
                $this->id = $id;
            }
                
                
       // les accesseurs de l'attribut content
       
        public function setContent(string $content) : void 
            {
                $this->content = $content;
            }
            
            
         public function getContent() : string
            {
                return $this->content;
            }
        
        // les accesseur de l'attribut date
        
        
        public function setPostDate(string $postDate):void
        {
            $this->postDate=$postDate;
        }
        
        public function getPostDate():date
        {
            return $this->postDate;
        }
        public function getUser_id() : int 
        {
            return $this->user_id;
        }
        public function setUser_id(?int $id) : void
        {
                $this->user_id = $user_id;
        }
        public function getRoom_id(): int
        {
            return $this->room_id;
        }
        public function setRoom_id(int $room_id): void
        {
               $this->room_id = $room_id;
        }
                
    }
?>