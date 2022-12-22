<?php
if ($_SERVER['DOCUMENT_ROOT'] . '/Database.php')
{
    include_once $_SERVER['DOCUMENT_ROOT'] . '/Database.php';
} else {
    include_once '../Database.php';
}

class Location
{

   
    private $id = 0;
    private $location = 'Unknown location';
    private $created_at;
    private $updated_at;

    
    public function _construct()
    {
        $this->id = null;
        $this->location = null;
        $this->created_at = null;
        $this->updated_at = null;
    }

   
    public function getId()
    {
        return $this->id;
    }

    
    public function getLocation()
    {
        return $this->location;
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

    
    public function setLocation($location)
    {
        if (is_string($location)) {
            $this->location = (string) $location;
        }
    }

    
    public function initWith($id, $location, $created_at, $updated_at)
    {
        $this->id = $id;
        $this->location = $location;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    
    public function initWithId($id)
    {
        $db = Database::getInstance();
        $data = $db->singleFetch('SELECT * FROM event_locations WHERE id = ' . $id);
        $this->initWith($data->id, $data->location, $data->created_at,
            $data->updated_at);
    }

    
    public function listAll()
    {
        $db = Database::getInstance();
        $sql = 'SELECT event_locations.id, event_locations.location
            FROM event_locations';
        $data = $db->multiFetch($sql);
        return $data;
    }

  
    public function createLocation()
    {
        try {
            $db = Database::getInstance();
            $data = $db->querySql("INSERT INTO `event_locations` (`id`, `location`)
                VALUES (NULL, '\'$this->location\')");
            return true;
        } catch (Exception $exception) {
            echo 'Exception: ' . $exception;
            return false;
        }
    }
    public function getinstance($id)
    {
        $db = Database::getInstance();
        $data = $db->singleFetch('SELECT * FROM event_locations WHERE id = ' . $id);
        return $data;
    }

}
