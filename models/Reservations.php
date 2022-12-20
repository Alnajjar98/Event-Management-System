<?php
if ($_SERVER['DOCUMENT_ROOT'] . '/Database.php')
{
    include_once $_SERVER['DOCUMENT_ROOT'] . '/Database.php';
} else {
    include_once '../Database.php';
}

class Reservations
{

  
    private $id = 0;
    private $payment_type_id = 0;
    private $country_id = 0;
    private $card_provider_id = 0;
    private $start_date = '';
    private $end_date = '';
    private $total_rental_cost = 0.0;
    private $first_name = '';
    private $middle_name = '';
    private $last_name = '';
    private $address = '';
    private $cpr = 0;
    private $phone_no = '';
    private $card_number = '';
    private $card_expiry_date = '';
    private $card_security_digits = '';
    private $created_at;
    private $updated_at;

   
    public function _construct()
    {
        $this->id = null;
        $this->payment_type_id = null;
        $this->country_id = null;
        $this->card_provider_id = null;
        $this->start_date = null;
        $this->end_date = null;
        $this->total_rental_cost = null;
        $this->first_name = null;
        $this->middle_name = null;
        $this->last_name = null;
        $this->address = null;
        $this->cpr = null;
        $this->phone_no = null;
        $this->card_number = null;
        $this->card_expiry_date = null;
        $this->card_security_digits = null;
        $this->created_at = null;
        $this->updated_at = null;
    }

  
    public function getId()
    {
        return $this->id;
    }

 
    public function getPaymentTypeId()
    {
        return $this->payment_type_id;
    }

  
    public function getCountryId()
    {
        return $this->country_id;
    }

 
    public function getCardProviderId()
    {
        return $this->card_provider_id;
    }

  
    public function getStartDate()
    {
        return $this->start_date;
    }

  
    public function getEndDate()
    {
        return $this->end_date;
    }

  
    public function getTotalRentalCost()
    {
        return $this->total_rental_cost;
    }

  
    public function getFirstName()
    {
        return $this->first_name;
    }

   
    public function getMiddleName()
    {
        return $this->middle_name;
    }

  
    public function getLastName()
    {
        return $this->last_name;
    }

 
    public function getAddress()
    {
        return $this->address;
    }

   
    public function getCPR()
    {
        return $this->cpr;
    }

   
    public function getPhoneNo()
    {
        return $this->phone_no;
    }

   
    public function getCardNumber()
    {
        return $this->card_number;
    }

  
    public function getCardExpiryDate()
    {
        return $this->card_expiry_date;
    }

 
    public function getCardSecurityDigits()
    {
        return $this->card_security_digits;
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

   
    public function setPaymentTypeId()
    {
        if (is_integer($payment_type_id)) {
            $this->payment_type_id = (integer) $payment_type_id;
        }
    }

   
    public function setCountryId()
    {
        if (is_integer($country_id)) {
            $this->country_id = (integer) $country_id;
        }
    }

   
    public function setCardProviderId()
    {
        if (is_integer($card_provider_id)) {
            $this->card_provider_id = (integer) $card_provider_id;
        }
    }

 
    public function setStartDate()
    {
        $this->start_date = date('Y-m-d', $start_date);
    }

   
    public function setEndDate()
    {
        $this->end_date = date('Y-m-d', $end_date);
    }

   
    public function setTotalRentalCost()
    {
        if (is_numeric($total_rental_cost)) {
            $this->total_rental_cost = (float) $total_rental_cost;
        }
    }

   
    public function setFirstName()
    {
        if (is_string($first_name)) {
            $this->first_name = (string) $first_name;
        }
    }

  
    public function setMiddleName()
    {
        if (is_string($middle_name)) {
            $this->middle_name = (string) $middle_name;
        }
    }

  
    public function setLastName()
    {
        if (is_string($last_name)) {
            $this->last_name = (string) $last_name;
        }
    }

 
    public function setAddress()
    {
        if (is_string($address)) {
            $this->address = (string) $address;
        }
    }

  
    public function setCPR()
    {
        if (is_integer($cpr)) {
            $this->cpr = (integer) $cpr;
        }
    }

    
    public function setPhoneNo()
    {
        if (is_string($phone_no)) {
            $this->phone_no = (string) $phone_no;
        }
    }

   
    public function setCardNumber()
    {
        if (is_string($card_number)) {
            $this->card_number = (string) $card_number;
        }
    }

    
    public function setCardExpiryDate()
    {
        if (is_string($card_expiry_date)) {
            $this->card_expiry_date = (string) $card_expiry_date;
        }
    }

  
    public function setCardSecurityDigits()
    {
        if (is_string($card_security_digits)) {
            $this->card_security_digits = (string) $card_security_digits;
        }
    }

    
    public function initWith($id, $payment_type_id, $country_id, $card_provider_id,
        $start_date, $end_date, $total_rental_cost, $first_name, $middle_name,
        $last_name, $address, $cpr, $phone_no, $card_number, $card_expiry_date,
        $card_security_digits, $created_at, $updated_at) {
        $this->id = $id;
        $this->payment_type_id = $payment_type_id;
        $this->country_id = $country_id;
        $this->card_provider_id = $card_provider_id;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->total_rental_cost = $total_rental_cost;
        $this->first_name = $first_name;
        $this->middle_name = $middle_name;
        $this->last_name = $last_name;
        $this->address = $address;
        $this->cpr = $cpr;
        $this->phone_no = $phone_no;
        $this->card_number = $card_number;
        $this->card_expiry_date = $card_expiry_date;
        $this->card_security_digits = $card_security_digits;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    
    public function initWithId($id)
    {
        $db = Database::getInstance();
        $data = $db->singleFetch('SELECT * FROM reservations WHERE id = ' . $id);
        $this->initWith($data->id, $data->payment_type_id, $data->country_id, $data->card_provider_id,
            $data->start_date, $data->end_date, $data->total_rental_cost, $data->first_name, $data->middle_name,
            $data->last_name, $data->address, $data->cpr, $data->phone_no, $data->card_number, $data->card_expiry_date,
            $data->card_security_digits, $data->created_at, $data->updated_at);
    }

   
    public function listAll()
    {
        $db = Database::getInstance();
        $data = $db->multiFetch('SELECT * FROM reservations GROUP BY id');
        return $data;
    }

    /**
     * Save new reservation to database
     * @param   INT     $events                    Required. Car id.
     * @param   ARRAY   $services            Required. Array of INT accessory ids.
     * @param   INT     $paymentType            Required. payment type id.
     * @param   INT     $country                Required. Country id.
     * @param   DATE    $startDate              Required. Reservation start date.
     * @param   DATE    $endDate                Required. Reservation end date.
     * @param   FLOAT   $totalRentalCost        Required. Total rental cost.
     * @param   STRING  $firstName              Required. Customer first name.
     * @param   STRING  $middleName             Required. Customer middle name.
     * @param   STRING  $lastName               Required. Customer last name.
     * @param   STRING  $billingAddress         Required. Customer billing address.
     * @param   INT     $cprNo                  Required. Customer CPR number.
     * @param   STRING  $phoneNo                Required. Customer phone number.
     * @param   INT     $cardProvider           Optional. Customer Credit Card Provider. Mandatory for Card payment type.
     * @param   STRING  $cardNumber             Optional. Customer Credit Card Number. Mandatory for Card payment type.
     * @param   DATE    $cardExpiry             Optional. Customer Credit Card Expiry Date. Mandatory for Card payment type.
     * @param   STRING  $cardSecurityDigits     Optional. Customer Credit Card Security Digits. Mandatory for Card payment type.
     */
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
