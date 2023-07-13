<?php

class PostController extends AbstractController{
    
    private PostManager $postManager; 
    private RoomManager $roomManager;
    private CategoriesManager $categoriesManager;
    
    public function __construct()
    {
        $this->postManager = new PostManager ("komlakplomahodoaziadome_distorsion","3306","db.3wa.io", "komlakplomahodoaziadome", "bb1c7420a0b6e4e3c2470bbd9b5a341f");
        $this->roomManager = new RoomManager("komlakplomahodoaziadome_distorsion","3306","db.3wa.io", "komlakplomahodoaziadome", "bb1c7420a0b6e4e3c2470bbd9b5a341f");
        $this->categoriesManager = new CategoriesManager("komlakplomahodoaziadome_distorsion","3306","db.3wa.io", "komlakplomahodoaziadome","bb1c7420a0b6e4e3c2470bbd9b5a341f");
    }
    public function indexPost()
    {
        $room_id = $_POST['room_id'];
        $category_id = $_POST['category_id'];
        $room = $this->roomManager->getRoomById($room_id);
        $category = $this->categoriesManager->getCategorieById($category_id);
        $posts = $this->postManager->getAllPostsByRoomId($room_id);
        $this->render("display_chat", ["posts" => $posts, "room" => $room, "category" => $category]);
    }
    function sendPost() : void
    {
        if(!empty($_POST['content']))
        {
            date_default_timezone_set('Europe/Paris');
            $creation_date = date('m/d/Y h:i:s a', time());
            $content = $_POST['content'];
            $user_id = $_SESSION['user_id'];
            $room_id = $_POST['room_id'];
            
            $post = new Post ($content, $date, $user_id, $room_id);
            
            $this->postManager->addPost($post);
            header("Location: /index.php?route=create_chat");
            exit();
        }
    }
}
?>