<?php   
class RoomController extends AbstractController{
    
    private RoomManager $roomManager;
    private CategoriesManager $categoriesManager;
    
    public function __construct()
    {
        $this->roomManager = new RoomManager("komlakplomahodoaziadome_distorsion","3306","db.3wa.io", "komlakplomahodoaziadome", "bb1c7420a0b6e4e3c2470bbd9b5a341f");
        $this->categoriesManager = new CategoriesManager("komlakplomahodoaziadome_distorsion","3306","db.3wa.io", "komlakplomahodoaziadome","bb1c7420a0b6e4e3c2470bbd9b5a341f");
    }
    
    public function indexRoom(){
        
        $allCategories = $this->categoriesManager->getAllCategories();
        $allRooms = $this->roomManager->getAllRooms();
        $this->render('create_room', ['rooms' => $allRooms, 'categories' => $allCategories]);
        $category_id = $_POST['category_select'];
        $room = new Room($_POST['name'], $_POST['description'], $category_id);
        $this->roomManager->insertRoom($room);

    }

    public function editRoom()
    {
         if(isset($_POST['name'], $_POST['description']))
         {
             $room = new Room ($_SESSION['id'], $_POST['name'], $_['description']);
             $this->manager->editRoom($room);
             $roomById = $this->roomManager->getRoomsById();
             $this->render('edit_room', ['rooms'=> $roomById]);
         } else{
            $allRooms = $this->roomManager->getallRooms();
            $this->render('index_room', ['rooms' => $allRooms]);
         }
    }
}
?>