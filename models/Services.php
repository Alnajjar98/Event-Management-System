<?php
if ($_SERVER['DOCUMENT_ROOT'] . '/jafar/Database.php')
{
    include_once $_SERVER['DOCUMENT_ROOT'] . '/jafar/Database.php';
} else {
    include_once '../Database.php';
}

class Services
{


    private $id = 0;
    private $service = 'Unknown service';
    private $daily_rental_price = 0.0;
    private $available_qty = 0;
    private $reserved_qty = 0;
    private $total_qty = 0;
    private $created_at;
    private $updated_at;

   
    public function _construct()
    {
        $this->id = null;
        $this->service = null;
        $this->daily_rental_price = null;
        $this->available_qty = null;
        $this->reserved_qty = null;
        $this->total_qty = null;
        $this->created_at = null;
        $this->updated_at = null;
    }

 
    public function getId()
    {
        return $this->id;
    }

 
    public function getService()
    {
        return $this->service;
    }

    public function getDailyRentalPrice()
    {
        return $this->daily_rental_price;
    }

  
    public function getAvailableQty()
    {
        return $this->available_qty;
    }

  
    public function getReservedQty()
    {
        return $this->reserved_qty;
    }

    public function getTotalQty()
    {
        return $this->total_qty;
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

    
    public function setService($service)
    {
        if (is_string($service)) {
            $this->service = (string) $service;
        }
    }

    
    public function setDailyRentalPrice($daily_rental_price)
    {
        if (is_numeric($daily_rental_price)) {
            $this->daily_rental_price = (float) $daily_rental_price;
        }
    }

   
    public function setAvailableQty($available_qty)
    {
        if (is_integer($available_qty)) {
            $this->available_qty = (integer) $available_qty;
        }
    }

   
    public function setReservedQty($reserved_qty)
    {
        if (is_integer($reserved_qty)) {
            $this->reserved_qty = (integer) $reserved_qty;
        }
    }

   
    public function setTotalQty($total_qty)
    {
        if (is_integer($total_qty)) {
            $this->total_qty = (integer) $total_qty;
        }
    }

   
    public function initWith($id, $service, $daily_rental_price,
        $available_qty, $reserved_qty, $total_qty,
        $created_at, $updated_at) {
        $this->id = $id;
        $this->service = $service;
        $this->daily_rental_price = $daily_rental_price;
        $this->available_qty = $available_qty;
        $this->reserved_qty = $reserved_qty;
        $this->total_qty = $total_qty;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }


    public function initWithId($id)
    {
        $db = Database::getInstance();
        $data = $db->singleFetch('SELECT * FROM event_services WHERE id = ' . $id);
        $this->initWith($data->id, $data->service, $data->daily_rental_price,
            $data->available_qty, $data->reserved_qty, $data->total_qty,
            $data->created_at, $data->updated_at);
    }


    public function listAll()
    {
        $db = Database::getInstance();
        $sql = 'SELECT * FROM services';
        $data = $db->multiFetch($sql);
        return $data;
    }

    // public function services($services)
    // {
    //     $db = Database::getInstance();
    //     $sql = 'SELECT id, service, daily_rental_price FROM event_services WHERE id = ' . $services[0];

    //     if (count($services) >= 1) {
    //         for ($i = 1; $i < count($services); $i++) {
    //             $sql .= ' OR id = ' . $services[$i];
    //         }
    //     }

    //     $sql .= ' GROUP BY id';
    //     $data = $db->multiFetch($sql);
    //     return $data;
    // }

    // get all services from id list
    public function getServicesByIds($ids) {
        $db = Database::getInstance();
        $ids = implode(',', $ids);
        $sql = "SELECT * FROM services WHERE id IN ({$ids})";
        return $db->multiFetch($sql);
      }

  
    // public function totalRental($id, $startDate, $endDate)
    // {
    //     $db = Database::getInstance();
    //     $total_price = 0;
    //     $sql = "SELECT SUM(event_services.service_price * (DATEDIFF('$endDate', '$startDate')+1)) 'total_cost'
    //         FROM services
    //         WHERE services.id = " . $id[0] . "";

    //     if (count($id) > 1)
    //     {
    //         for ($i = 1; $i < count($id); $i++)
    //         {
    //             $sql .= ' OR event_services.id = '.$id[$i];
    //         }
    //     }
    //     $sql .= " GROUP BY 'total_cost'";
    //     $data = $db->singleFetch($sql);
    //     return $data;
    // }
    public function totalRental($ids, $startDate, $endDate)
    {
        $db = Database::getInstance();
        $ids = implode(',', $ids);
        $sql = "SELECT SUM(services.service_price * (DATEDIFF('$endDate', '$startDate')+1)) AS total_cost
            FROM services
            WHERE services.id IN ({$ids})";
        $result = $db->dblink->query($sql);
        $row = $result->fetch_assoc();
        $returned = new stdClass();
        $returned->total_cost = $row['total_cost'];
        return $returned;
    }
    

}
