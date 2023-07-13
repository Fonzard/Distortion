<?php


function checkRoute(string $route): void
{
    global $userController;
    global $roomController;
    global $categoryController;
    global $postController;
    
    switch($route){
        case 'edit_user':
            $userController->editUser();
            break;
        case 'login':
            $userController->login();
            break;
        case 'register':
             $userController->register();
            break;
        case'create_room':
            $roomController->indexRoom();
            break;
        case'edit_room':
            $roomController->editRoom();
            break;
        case'index':
            $categoryController->index();
            break;
        case"display_chat":
            if (isset($_POST['category_id'],$_POST['room_id']))
            {
                $categoryController->indexPost();
            } else {
               //
            }
            break;
        case "create_chat":
            $postController->sendPost();
            break;
        default:
            $userController->login();
            break;
    }
}
?>