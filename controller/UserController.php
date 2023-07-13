<?php 
class UserController extends AbstractController {
    
    private UserManager $manager;
    
    public function __construct()
    {
        $this->userManager = new UserManager("komlakplomahodoaziadome_distorsion","3306","db.3wa.io", "komlakplomahodoaziadome","bb1c7420a0b6e4e3c2470bbd9b5a341f");
        $this->postManager = new PostManager ("komlakplomahodoaziadome_distorsion","3306","db.3wa.io", "komlakplomahodoaziadome", "bb1c7420a0b6e4e3c2470bbd9b5a341f");
        $this->roomManager = new RoomManager("komlakplomahodoaziadome_distorsion","3306","db.3wa.io", "komlakplomahodoaziadome", "bb1c7420a0b6e4e3c2470bbd9b5a341f");
        $this->categoriesManager = new CategoriesManager("komlakplomahodoaziadome_distorsion","3306","db.3wa.io", "komlakplomahodoaziadome","bb1c7420a0b6e4e3c2470bbd9b5a341f");
    }
    
    public function login()
    {
        if(isset($_POST['formLogin'])){
        
            if(isset($_POST["username"], $_POST["password"]))
            {
                var_dump($_POST);
                $user = $this->userManager->getUserByUsername($_POST["username"]);
                var_dump($user);
                var_dump(password_verify($_POST["password"], $user->getPassword()));
                if(password_verify($_POST["password"], $user->getPassword()) === true)
                {
                    session_start();
                    $_SESSION['user_id'] = $user->getId();
                    header('Location: index.php?route=index');
                }
                else
                {
                    $allUsers = $this->userManager->getAllUsers();
                    $this->render('login', ["users" => $allUsers]);
                    echo 'yooo';
                }
            }
        }else{
            $allUsers = $this->userManager->getAllUsers();
            $this->render('login', ["users" => $allUsers]);
        }
    }
    
    public function register()
    {
        if(isset($_POST['username'], $_POST['email'], $_POST['password'], $_POST['c-password']))
        {
            if($_POST['password'] === $_POST['c-password'])
            {
                $hash = password_hash($_POST['password'],PASSWORD_DEFAULT);
                $user = new User ($_POST['username'], $_POST['email'], $hash);
                $this->userManager->insertUser($user);
                $allUsers = $this->userManager->getAllUsers();
                $this->render('login', ["users" => $allUsers]);  
            }else{
                $this->render('register', []);
            }

        }else{
            $this->render('register', []);
        }
    }
    //A définir l'utilité de cette fonction 
    // public function editUser(array $post = null)
    // {
    //     if(isset($_POST['username'], $_POST['email'], $_POST['password']))
    //     {
    //         $user = new User($_SESSION['id'], $_POST['username'], $_POST['email'], $_POST['password']);
    //         $this->userManager->editUser($user);
    //         $allUsers = $this->userManager->getAllUsers();
    //         $this->render('login', $allUsers);
    //     } else{
    //         $allUsers = $this->userManager->getAllUsers();
    //         $this->render('edit_user', ['user'=> $allUsers]);
    //     }
    // }
}
?>