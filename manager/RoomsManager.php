<?php 

class RoomManager extends AbstractManager 
{
    
    public function getAllRooms(): array
    {
        $query = $this->db->prepare("SELECT * FROM rooms");
        $query->execute();
        $rooms = $query->fetchAll(PDO::FETCH_ASSOC);
        $roomsTab = [];
        foreach ($rooms as $room){
            $roomInstance = new Room($room['name'], $room['description'], $room['category_id']);
            $roomsTab[] = $roomInstance;
        }
        return $roomsTab;  
    }
    public function getRoomById( int $id) : Room 
    {
        $query = $this->db->prepare("SELECT * FROM rooms WHERE id = :id");
        $parameters = [
                "id" => $id
            ];
        $query->execute($parameters);
        $room = $query->fetch(PDO::FETCH_ASSOC);
        return $room;
    }
    function getRoomsByCategoryId(int $category_id) : array
    {
        $query = $this->db->prepare('SELECT * FROM rooms WHERE category_id = :category_id');
        $parameters = [
            'category_id' => $category_id
        ];
        $query->execute($parameters);
        $rooms = $query->fetchAll(PDO::FETCH_ASSOC);
        $roomsTab = [];
        foreach($rooms as $room) {
            $roomInstance = new Room ($room['name'], $room['description'], $room['category_id']);
            $roomInstance->setId($room['id']);
            $roomsTab[] = $roomInstance;
        }
        return $roomsTab;
    }
    public function insertRoom(Room $room)
    {
        $query = $this->db->prepare("INSERT INTO rooms (name, description, category_id) VALUES (:name, :description, :category_id)");
        $parameters = [
                'name' => $room->getName(),
                'description' => $room->getDescription(),
                'category_id' => $room->getCategory_id()
            ];
        $query->execute($parameters);
    }
    public function editRoom(Room $room): void
    {
        $query = $this->db->prepare("UPDATE rooms SET name = :name, description = :description WHERE id = :id");
        $parameters = [
                'id' => $room->getId(),
                'name' => $room->getUsername(),
                'description' => $room->getDescription(),
            ];
        $query->execute($parameters);
    }
    function removeRoom(Room $room) : void
    {
        $query = $this->db->prepare('DELETE FROM rooms WHERE rooms.id = :id');
        $parameters = [
            'id' => $room->getId()
        ];
        $query->execute($parameters);
    }

}
?>