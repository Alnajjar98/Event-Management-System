<?php
if ($_SERVER['DOCUMENT_ROOT'] . '/Database.php')
{
    include_once $_SERVER['DOCUMENT_ROOT'] . '/Database.php';
} else {
    include_once '../Database.php';
}

class Categories
{
  
    private $id = 0;
    private $category ;
    private $created_at;
    private $updated_at;

    
    public function _construct()
    {
        $this->id = null;
        $this->category = null;
        $this->created_at = null;
        $this->updated_at = null;
    }

   
    public function getId()
    {
        return $this->id;
    }

   
    public function getCategory()
    {
        return $this->category;
    }

  
    public function getCreatedAt()
    {
        return $this->created_at;
    }

 
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

   
    public function setId($id)
    {
        if (is_integer($id)) {
            $this->id = (integer) $id;
        }
    }

    
    public function setCategory($category)
    {
        if (is_string($category)) {
            $this->category = (string) $category;
        }
    }

   
    public function initWith($id, $category, $created_at, $updated_at)
    {
        $this->id = $id;
        $this->category = $category;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

  
    public function initWithId($id)
    {
        $db = Database::getInstance();
        $data = $db->singleFetch('SELECT * FROM event_categories WHERE id = ' . $id);
        $this->initWith($data->id, $data->category, $data->created_at,
            $data->updated_at);
    }

    
    function listAll()
    {
        $db = Database::getInstance();
        $sql = "SELECT event_categories.id, event_categories.category
            FROM event_categories";
        $data = $db->multiFetch($sql);
        return $data;
    }

}