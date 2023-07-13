<?php
class Category {

    private ?int $id;
    private string $name;
    private string $description;

    public function __construct(string $name, string $description) 
    {
        $this->id = null;
        $this->name = $name;
        $this->description = $description;
    }

    // Accesseurs pour l'attribut id

    public function getId(): ?int 
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }
                
    // Accesseurs pour l'attribut name

    public function setName(string $name): void 
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    // Accesseurs pour l'attribut description

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}
?>