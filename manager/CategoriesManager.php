<?php
    class CategoriesManager extends AbstractManager
    {

        public function getAllCategories() : array
        {
            $query = $this->db->prepare("SELECT * FROM categories");
            $query->execute();
            $categories = $query->fetchAll(PDO::FETCH_ASSOC);
            $categoriesTab = [];
            foreach ($categories as $category){
                $categoryInstance = new Category ($category['name'], $category['description']);
                $categoryInstance->setId($category['id']);
                $categoriesTab [] = $categoryInstance;
            }
            
            return $categoriesTab;  
        }
        
        public function getCategorieById(int $id):Categorie
        {
             $query = $this->db->prepare("SELECT * FROM categories WHERE id = :id");
             $parameters = [
                "id" => $id
            ];
            $query->execute($parameters);
            return $query->fetch(PDO::FETCH_ASSOC);
        }
        
        
         public function insertCategorie(Categorie $category):Categorie
    {
            $query = $this->db->prepare("INSERT INTO categories (name, description) VALUES (:name, :description)");
            $parameters = [
                    'name' => $category->getName(),
                    'description' => $category->getDescription(),
                ];
            $query->execute($parameters);
     }
     
     
    public function editCategorie(Categorie $category): void
    {
        $categorie->setCategorie();
        $query = $this->db->prepare("UPDATE categories SET name = :name, description = :description WHERE id = :id");
        $parameters = [
                'id' => $category->getId(),
                'name' => $category->getName(),
                'description' => $category->getDescription(),
            ];
        $query->execute($parameters);
    }
}

?>