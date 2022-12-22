<?php
if ($_SERVER['DOCUMENT_ROOT'] . '/jafar/Database.php')
{
    include_once $_SERVER['DOCUMENT_ROOT'] . '/jafar/Database.php';
} else {
    include_once '../Database.php';
}

class Events
{

    
    private $id = 0;
    private $location_id = 0;
    private $type_id = 0;
    private $category_id = 0;
    private $event_cost = 0.0;
    private $image = 'Unknown Image';
    private $start_date;
    private $end_date;
    private $created_at;
    private $updated_at;
    

    
    public function _construct()
    {
        $this->id = null;
        $this->location_id = null;
        $this->type_id = null;
        $this->category_id = null;
        $this->event_cost = null;
        $this->image = null;
        $this->start_date = null;
        $this->end_date = null;
        $this->created_at = null;
        $this->updated_at = null;
    }

    
    public function getId()
    {
        return $this->id;
    }

   
    public function getLocationId()
    {
        return $this->location_id;
    }

  
    public function getTypeId()
    {
        return $this->type_id;
    }

  
    public function getCategoryId()
    {
        return $this->category_id;
    }


    public function getEventCost()
    {
        return $this->event_cost;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getStartDate()
    {
        return $this->start_date;
    }
    
    public function getEndDate()
    {
        return $this->end_date;
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

  
    public function setLocationId($location_id)
    {
        if (is_integer($location_id)) {
            $this->location_id = (integer) $location_id;
        }
    }


    public function setTypeId($type_id)
    {
        if (is_integer($type_id)) {
            $this->type_id = (integer) $type_id;
        }
    }


    public function setCategory($category_id)
    {
        if (is_integer($category_id)) {
            $this->category_id = (integer) $category_id;
        }
    }


    public function setEventCost($event_cost)
    {
        if (is_numeric($event_cost)) {
            $this->event_cost = (float) $event_cost;
        }
    }

   
    public function setImage($image)
    {
        if (is_string($image)) {
            $this->image = (string) $image;
        }
    }

    public function setStartDate($start_date)
    {
        if (is_string($start_date))
        {
            $this->start_date = (string) $start_date;
        }
    }

    public function setEndDate($end_date)
    {
        if (is_string($end_date))
        {
            $this->end_date = (string) $end_date;
        }
    }
    public function getLocationName()
    {
        $location = new Location();
        $location->getinstance($this->location_id);
        return $location->location;
    }

   
    public function initWith($id, $location_id, $type_id,$category_id, $event_cost, $image,$start_date,$end_date,$created_at, $updated_at)
    {
        $this->id = $id;
        $this->location_id = $location_id;
        $this->type_id = $type_id;
        $this->category_id = $category_id;
        $this->event_cost = $event_cost;
        $this->image = $image;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

  
    public function initWithId($id)
    {
        $db = Database::getInstance();
        $data = $db->singleFetch('SELECT * FROM events WHERE id = ' . $id);
        $this->initWith($data->id, $data->location_id,
            $data->type_id, $data->category_id, $data->event_cost,
            $data->image,$data->start_date,$data->end_date, $data->created_at, $data->updated_at);
    }


    public function listAll()
    {
        $db = Database::getInstance();
        $data = $db->multiFetch('SELECT * FROM events');
        return $data;
    }

    /**
     * Add new car to database
     */
    public function createEvent()
    {
        try {
            $db = Database::getInstance();
            $data = $db->querySql("INSERT INTO `events` (`id`, `location_id`, `type_id`, `category_id`, `event_cost`, `image`,'start_date','end_date')
                VALUES (NULL, \'$this->location_id\', \'$this->type_id\',\'$this->category_id\', \'$this->event_cost\', \''$this->image'\', \''$this->start_date'\', \''$this->end_date'\')");
            return true;
        } catch (Exception $exception) {
            echo 'Exception: ' . $exception;
            return false;
        }
    }

    
    public function searchEventsQueryBuilder($location = null, $types = null, $category = null, $minPrice = null, $maxPrice = null ) {
        try {
            $db = Database::getInstance();
            $sql = 'SELECT * FROM events where 1=1 ';
            
            if (!empty($location)) {
                $sql .= " AND location_id = '$location'";
            }

            if (!empty($types)) {
                $sql .= " AND type_id = '$types'";
            }
            
            if (!empty($category)) {
                $sql .= " AND category_id = '$category'";
            }

            if (!empty($minPrice) && !empty($maxPrice)) {
                $sql .= " and events.event_cost BETWEEN " . $minPrice . " AND " . $maxPrice . "";
            }

            // // if (!empty($start) && !empty($display)) {
            // //     $sql .= " LIMIT $start, $display";
            // // }
            $data = $db->multiFetch($sql);
            return $data;

            if ($data === null) {
                echo 'No available Event that meet search Options.';
            }

        } catch (Exception $exception) {
            echo 'Exception: ' . $exception;
            return false;
        }
    }

    /**
     * Retrieve from db cheapest event daily price.
     */
    public function minPrice()
    {
        // $db = Database::getInstance();
        // $data = $db->singleFetch("SELECT MIN(events.event_cost) AS minPrice FROM events");
        // $data = (int) $data->minPrice;
        // return $data;
        return '1';
    }

    /**
     * Retrieve from db highest event daily price.
     */
    public function maxPrice()
    {
        // $db = Database::getInstance();
        // $data = $db->singleFetch("SELECT MAX(events.event_cost) AS maxPrice FROM events");
        // $data = (int) $data->maxPrice;
        // return $data;
        return '100';
    }

   
    public function getEvent($id)
    {
        if ($id) {
            $db = Database::getInstance();
            $data = $db->singleFetch('SELECT * FROM events WHERE id = ' . $id);
            return $data;
        } else {
            echo "No event id provided or event doesn't exist.";
        }
    }

    public function checkDoubleBooking($id, $startDate, $endDate)
    {
        if ($id && $startDate && $endDate) {
            $db = Database::getInstance();
            $sql = "SELECT events.id, reservations.start_date, reservations.end_date
                FROM events, reservations, reservation_events
                WHERE events.id = " . $id . "
                AND reservation_events.event_id = events.id
                AND reservation_events.reservation_id = reservations.id
                AND reservations.start_date BETWEEN '" . $startDate . "' AND '" . $endDate . "'
                OR reservations.end_date BETWEEN '" . $startDate . "' AND '" . $endDate . "'
                GROUP BY reservations.id";
            $data = $db->multiFetch($sql);

            if ($data != null) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

   
    public function totalRental($id, $startDate, $endDate)
    {
        $db = Database::getInstance();
        $sql = "SELECT events.id, SUM(DATEDIFF('$endDate', '$startDate')+1) 'total_days',
            SUM(events.event_cost * (DATEDIFF('$endDate', '$startDate')+1)) 'total_cost'
            FROM events
            WHERE events.id = $id";
        $data = $db->singleFetch($sql);
        return $data;
    }

}
