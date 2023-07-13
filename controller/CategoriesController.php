<?php 

class CategoriesController extends AbstractController {
    
    private PostManager $postManager; 
    private RoomManager $roomManager;
    private CategoriesManager $categoriesManager;

    public function __construct()
    {
        $this->postManager = new PostManager ("komlakplomahodoaziadome_distorsion","3306","db.3wa.io", "komlakplomahodoaziadome", "bb1c7420a0b6e4e3c2470bbd9b5a341f");
        $this->roomManager = new RoomManager("komlakplomahodoaziadome_distorsion","3306","db.3wa.io", "komlakplomahodoaziadome", "bb1c7420a0b6e4e3c2470bbd9b5a341f");
        $this->categoriesManager = new CategoriesManager("komlakplomahodoaziadome_distorsion","3306","db.3wa.io", "komlakplomahodoaziadome","bb1c7420a0b6e4e3c2470bbd9b5a341f");
    }
    public function index()
    {
        $allCategories = $this->categoriesManager->getAllCategories();
        $allRooms = $this->roomManager->getAllRooms();
        var_dump($allRooms);
        var_dump($allCategories);
        $this->render('index', ["categories" => $allCategories, "rooms" => $allRooms]);
    }
    public function createCategory()
    {
        if(isset($_POST['name'], $_POST['description']))
        {
            $categorie = new Category ($_POST['name'], $_POST['description']);
            $this->categoriesManager->insertCategory($categorie);
            $allcategories = $this->categoriesManager->getAllCategories();
            $this->render('create_category', $allCategories);
        }else{
            $allCategories = $this->categoriesManager->getAllCategories();
            $this->render('index_category', ['categories' => $allCategories]);
        }
    }
    public function editCategory()
    {
        if(isset($_POST['name'], $_POST['description']))
        {
            $categorie = new Category($_SESSION['id'], $_POST['name'], $_POST['description']);
            $this->categoriesManager->editCategory($categorie);
            $allCategories = $this->categoriesManager->getAllCategories();
            $this->render('edit_category', ['categories' => $allCategories]);
        } else{
            $allCategories = $this->categoriesManager->getAllCategories();
            $this->render('index_category', ['categories' => $allCategories]);
        }
    }
}
?>
