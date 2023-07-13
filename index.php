<?php


require "./models/Category.php";
require "./models/Post.php";
require "./models/Room.php";
require "./models/User.php";

require "./manager/AbstractManager.php";
require "./manager/CategoriesManager.php";
require "./manager/ChatManager.php";
require "./manager/RoomsManager.php";
require "./manager/UserManager.php";

require "./controller/AbstractController.php";
require "./controller/CategoriesController.php";
require "./controller/ChatController.php";
require "./controller/RoomsController.php";
require "./controller/UserController.php";

    $userController = new UserController(); //Connecte à la BDD
    $roomController = new RoomController();
    $categoryController = new CategoriesController();
    $postController = new PostController();
    
require "services/router.php";

if(isset($_GET['id']))
{
    $_SESSION['id'] = $_GET['id'];
}

if(isset($_GET["route"]))
{
    checkRoute($_GET["route"]);
}
else
{
    checkRoute("");    
}    
?>