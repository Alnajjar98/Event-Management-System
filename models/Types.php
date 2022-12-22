<?php
if ($_SERVER['DOCUMENT_ROOT'] . '/Database.php')
{
    include_once $_SERVER['DOCUMENT_ROOT'] . '/Database.php';
} else {
    include_once '../Database.php';
}

class Types
{
    
    private $id = 0;
    private $type = 'unknown type';
    private $created_at;
    private $updated_at;

   
    public function _construct()
    {
        $this->id = null;
        $this->types = null;
        $this->created_at = null;
        $this->updated_at = null;
    }

    
    public function getId()
    {
        return $this->id;
    }

  
    public function getType()
    {
        return $this->types;
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

    
    public function setType($type)
    {
        if (is_string($type)) {
            $this->types = (string) $type;
        }
    }

 
    public function initWith($id, $type, $created_at, $updated_at)
    {
        $this->id = $id;
        $this->types = $type;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    
    public function initWithId($id)
    {
        $db = Database::getInstance();
        $data = $db->singleFetch('SELECT * FROM event_types WHERE id = ' . $id);
        $this->initWith($data->id, $data->types, $data->created_at,
            $data->updated_at);
    }

    function listAll()
    {
        $db = Database::getInstance();
        $sql = "SELECT event_types.id, event_types.type
            FROM event_types";
        $data = $db->multiFetch($sql);
        return $data;
    }

}