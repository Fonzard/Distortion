<?php 
class PostManager extends AbstractManager {
    
    function getAllPostsByRoomId (int $room_id) : array
    {
      $query = $this->db->prepare('SELECT * FROM postes WHERE room_id = :room_id');
      $parameters = [
            'room_id' => $room_id
         ];
      $query->execute($parameters);
      $posts = $query->fetchAll(PDO::FETCH_ASSOC);
      $postsTab = [];
      foreach($posts as $post)
      {
         $instanceMessage = new Message($post["content"], $post["creation_date"], $post["user_id"], $post["room_id"]);
         $postsTab[] = $postInstance;
      }
      return $postTab;
    }
    
    function addPost(Post $post): void
    {
      $query = $this->db->prepare('INSERT INTO postes (content, date, user_id, room_id) VALUES(:content, :date, :user_id,:room_id)');
      $parameters = [
         'content' => $post->getContent(),
         'date' => $post->getDate(),
         'user_id' => $post->getUser_id(),
         'room_id' => $post->getRoom_id()
      ];
      $query->execute($parameters);
    }
    public function editPost(Post $post): void
    {

      $query = $this->db->prepare('UPDATE postes SET content = :content, WHERE id = :id');
      $parameters = [
         'content' => $post->getContent(),
         'id' => $post->getId()
      ];
      $query->execute($parameters);
    }
    public function deletePost(Post $post): void
    {
      $query = $this->db->prepare('DELETE FROM postes WHERE posts.id = :id');
      $parameters = [
         'id' => $post->getId()
      ];
      $query->execute($parameters);
    }

}


?>