<?php
if ($_SERVER['DOCUMENT_ROOT'] . '/Database.php')
{
    include_once $_SERVER['DOCUMENT_ROOT'] . '/Database.php';
} else {
    include_once '../Database.php';
}

class PaymentTypes
{

   
    private $id = 0;
    private $payment_type = 'Unknown payment type';
    private $created_at;
    private $updated_at;

    
    public function _construct()
    {
        $this->id = null;
        $this->payment_type = null;
        $this->created_at = null;
        $this->updated_at = null;
    }

   
    public function getId()
    {
        return $this->id;
    }

    
    public function getPaymentType()
    {
        return $this->payment_type;
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

    
    public function setPaymentType($payment_type)
    {
        if (is_string($payment_type)) {
            $this->payment_type = (string) $payment_type;
        }
    }

   
    public function initWith($id, $payment_type,
        $created_at, $updated_at) {
        $this->id = $id;
        $this->payment_type = $payment_type;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

  
    public function initWithId($id)
    {
        $db = Database::getInstance();
        $data = $db->singleFetch('SELECT * FROM payment_types WHERE id = ' . $id);
        $this->initWith($data->id, $data->payment_type,
            $data->created_at, $data->updated_at);
    }

    
    public function listAll()
    {
        $db = Database::getInstance();
        $data = $db->multiFetch('SELECT id, payment_type FROM payment_types GROUP BY id');
        return $data;
    }

}
