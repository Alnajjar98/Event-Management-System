<?php
if ($_SERVER['DOCUMENT_ROOT'] . '/jafar/Database.php')
{
    include_once $_SERVER['DOCUMENT_ROOT'] . '/jafar/Database.php';
} else {
    include_once '../Database.php';
}

class Reservations
{

  
    private $id = 0;
    private $event_id = 0;
    private $reservation_total_cost = 0.0;
    private $start_date = '';
    private $end_date = '';
    private $reservation_code = '';
    private $created_at;
    private $updated_at;

    public function _construct()
    {
        $this->id = null;
        $this->event_id = null;
        $this->reservation_total_cost = null;
        $this->start_date = null;
        $this->end_date = null;
        $this->reservation_code = null;
        $this->created_at = null;
        $this->updated_at = null;
    }

  
    public function getId()
    {
        return $this->id;
    }
    public function getEventId()
    {
        return $this->event_id;
    }
    public function getReservationCode()
    {
        return $this->reservation_code;
    }
  
    public function getStartDate()
    {
        return $this->start_date;
    }

    public function getReservationTotalCost(){
        return $this->reservation_total_cost;
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
    public function setEventId($event_id)
    {
        if (is_integer($event_id)) {
            $this->event_id = (integer) $event_id;
        }
    }
    public function setReservationTotalCost($reservation_total_cost)
    {
        if (is_float($reservation_total_cost)) {
            $this->reservation_total_cost = (float) $reservation_total_cost;
        }
    }
    public function setReservationCode()
    {   
            // generate a random string of 8 characters
            $reservation_code = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8);
            $this->reservation_code = (string) $reservation_code;
    }
    public function createReservation($event_id, $reservation_total_cost, $start_date, $end_date, $reservation_code)
    {
      $db = Database::getInstance();
      $sql = "INSERT INTO reservation (event_id, reservation_total_cost, start_date, end_date, reservation_code, created_at, updated_at) VALUES ('$event_id', '$reservation_total_cost', '$start_date', '$end_date', '$reservation_code', NOW(), NOW())";
      $result = $db->querySQL2($sql);
        return $result;
    }
    // get reservation by reservation code
    public function getReservationByCode($reservation_code)
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM reservation WHERE reservation_code = '$reservation_code'";
        $reservation = $db->singleFetch2($sql);
        if($reservation){
            $this->initWith($reservation->id, $reservation->event_id, $reservation->reservation_total_cost, $reservation->start_date, $reservation->end_date, $reservation->reservation_code, $reservation->created_at, $reservation->updated_at);
            return $this;
        }
        return false;
        
    }
    public function getEventByReservationId($id)
    {
        $db = Database::getInstance();
        include_once 'Events.php';
        $event = new Events();
        $event = $event->initWithId($id);
        if ($event)
        {
            return $event;
        }
        return false;
    }
    public function getLastInsertedReservation()
    {
    $db = Database::getInstance();
    $sql = "SELECT * FROM reservation ORDER BY id DESC LIMIT 1";
        $reservation = $db->singleFetch2($sql);
            $this->initWith($reservation->id, $reservation->event_id, $reservation->reservation_total_cost, $reservation->start_date, $reservation->end_date, $reservation->reservation_code, $reservation->created_at, $reservation->updated_at);
    return $this;
    }
    // add reservation Services
    public function addReservationServices($service_id){
        $db = Database::getInstance();
        $sql = "INSERT INTO reservation_services (service_id, reservation_id) VALUES ('$service_id', '$this->id')";
        $result = $db->querySQL2($sql);
        return $result;
    }
    public function setStartDate($start_date)
    {
        $this->start_date = date('Y-m-d', $start_date);
    }
    
    public function getServiceByReservationId($id)
    {
    $db = Database::getInstance();
    include_once 'Services.php';
    $service = new Services();
    $sql = "SELECT id FROM reservation_services WHERE reservation_id = '$id'";
    // fetch multiple rows
    $result = $db->fetchMultipleRows($sql);
    if ($result)
    {
        $ids = array();
        foreach ($result as $row)
        {
        array_push($ids, $row->id);
        }
        $ids = implode(',', $ids); // convert the array to a string for the IN clause
        $sql = "SELECT * FROM services WHERE id IN ($ids)";
        $result = $db->fetchMultipleRows($sql);
        if ($result){
        return $result;
        }
    }
    return false;
    }

   
    public function setEndDate($end_date)
    {
        $this->end_date = date('Y-m-d', $end_date);
    }
    
    public function initWith($id, $event_id, $reservation_total_cost, $start_date, $end_date, $reservation_code, $created_at, $updated_at)
    {
        $this->id = $id;
        $this->event_id = $event_id;
        $this->reservation_total_cost = $reservation_total_cost;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->reservation_code = $reservation_code;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public function initWithId($id)
    {
        $db = Database::getInstance();
        $data = $db->singleFetch('SELECT * FROM reservations WHERE id = ' . $id);
        $this->initWith($data->id, $data->event_id, $data->reservation_total_cost, $data->start_date, $data->end_date, $data->reservation_code, $data->created_at, $data->updated_at);
    }

   
    public function listAll()
    {
        $db = Database::getInstance();
        $data = $db->multiFetch('SELECT * FROM reservations GROUP BY id');
        return $data;
    }
    // save reservation
    public function save2($event_id, $reservation_total_cost, $start_date, $end_date, $reservation_code)
    {
        $db = Database::getInstance();
        $db->querySQL2('INSERT INTO reservations (event_id, reservation_total_cost, start_date, end_date, reservation_code) VALUES (' . $event_id . ', ' . $reservation_total_cost . ', "' . $start_date . '", "' . $end_date . '", "' . $reservation_code . '")');
    }


    public function save($event, $services, $paymentType, $country, $startDate, $endDate, $totalRentalCost,
        $firstName, $middleName, $lastName, $billingAddress, $cprNo, $phoneNo,
        $cardProvider = null, $cardNumber = null, $cardExpiry = null, $cardSecurityDigits = null) {

        if ($cardExpiry != null) {
            $cardExpiry = DateTime::createFromFormat('m-Y', $cardExpiry)->format('m-Y');
        }

        $mysqli = new mysqli('localhost', 'u201601573', 'u201601573', 'db201601573');
        //$mysqli = new mysqli('localhost','root','', '');

        if ($cardProvider == null || $cardProvider == 0) {
            $reservationSql = "INSERT INTO `reservations` (`id`, `payment_type_id`, `country_id`,
            `start_date`, `end_date`, `total_rental_cost`, `first_name`, `middle_name`, `last_name`, `address`,
            `CPR`, `phone_no`)
            VALUES (NULL, $paymentType, $country, '$startDate', '$endDate', '$totalRentalCost', '$firstName', '$middleName', '$lastName',
            '$billingAddress', '$cprNo', '$phoneNo')";
        } else {
            $reservationSql = "INSERT INTO `reservations` (`id`, `payment_type_id`, `country_id`, `card_provider_id`,
            `start_date`, `end_date`, `total_rental_cost`, `first_name`, `middle_name`, `last_name`, `address`,
            `CPR`, `phone_no`, `card_number`, `card_expiry_date`, `card_security_digits`)
            VALUES (NULL, $paymentType, $country, $cardProvider, '$startDate', '$endDate', '$totalRentalCost', '$firstName', '$middleName', '$lastName',
            '$billingAddress', '$cprNo', '$phoneNo', '$cardNumber', '$cardExpiry', '$cardSecurityDigits')";
        }

        $reservationEventSql = $mysqli->query($reservationSql);

        $reservationId = $mysqli->insert_id;

        $reservationEventSql = "INSERT INTO `reservation_events` (`id`, `reservation_id`, `event_id`) VALUES (NULL, $reservationId, $event)";

        $reservationEventSql = $mysqli->query($reservationEventSql);

        // must run multiple times for ea accessory
        $reservationServicesSql = "INSERT INTO `reservation_services` (`id`, `service_id`, `reservation_id`, `reserve_qty`) VALUES ";

        $services = (array) $services;

        if (count($services) == 1) {
            $reservationServicesSql .= "(NULL, " . $services[0] . ", $reservationId, '1') ";
        } else {
            $lastElement = end($services);
            for ($i = 0; $i < count($services); $i++) {
                if ($services[$i] == $lastElement) {
                    $reservationServicesSql .= "(NULL, " . $services[$i] . ", $reservationId, '1')";
                } else {
                    $reservationServicesSql .= "(NULL, " . $services[$i] . ", $reservationId, '1'), ";
                }
            }
        }
        $reservationServicesSql = $mysqli->query($reservationServicesSql);
        return $reservationId;
    }
    // insert into reservation_services
    public function addReservationService($service_id, $reservation_id, $reserve_qty)
    {
        $db = Database::getInstance();
        $db->querySQL2('INSERT INTO reservation_services (service_id, reservation_id, reserve_qty) VALUES (' . $service_id . ', ' . $reservation_id . ', ' . $reserve_qty . ')');
    }

    public function reservationDetails($id)
    {
        $db = Database::getInstance();
        $sql = "SELECT reservations.id, reservations.start_date, reservations.end_date, reservations.total_rental_cost,
        reservations.first_name, reservations.middle_name, reservations.last_name, reservations.address,
        reservations.CPR, reservations.phone_no, reservations.card_number, events.daily_rental_price, events.image,
        event_location.location, event_type.type, event_categories.category,
        countries.country_name_en, countries.country_nationality_en
        FROM reservations, events, reservation_events, location, event_type, event_categories, countries
        WHERE reservations.id = $id
        AND reservation_events.reservation_id = reservations.id
        AND reservation_events.event_id = events.id
        AND events.location_id = event_location.id
        AND events.type_id = event_type.id
        AND events.category_id = event_categories.id
        AND reservations.country_id = countries.id
        GROUP BY reservations.id";
        $data = $db->singleFetch($sql);
        return $data;
    }

    public function reservationAccessories($reservationId)
    {
        $db = Database::getInstance();
        $sql = "SELECT event_services.service, event_services.daily_rental_price
        FROM reservations, event_services, reservation_service
        WHERE reservations.id = $reservationId
        AND reservations.id = reservation_service.reservation_id
        AND reservation_service.service_id = event_services.id
        GROUP BY event_services.id";
        $data = $db->multiFetch($sql);
        return $data;
    }

    /**
     * Delete cancelled reservation from db
     * @param   INT     $id     Required. Reservation id.
     */
    public function delete($id)
    {
        $db = Database::getInstance();
        $sql = "DELETE FROM reservations WHERE reservations.id = $id";
        $sql = $db->querySql($sql);
    }

}
