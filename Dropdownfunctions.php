<?php

include_once 'Database.php';
$db = new Database();

class Dropdownfunctions {
    private $cid;
     function __construct() {
        $this->cid = null;
       
    }

    function setUid($uid) {
        $this->cid = $uid;
    }


    function category() {

            
      
        
        
        $q = "SELECT * FROM event_categories";
       
        $db = new Database();


        if ($data = $db->multiFetch($q)) {
            for ($i = 0; $i < count($data); $i++) {
                echo '<option value="' . $data[$i]->id . '"  >' . $data[$i]->category . '</option>';
                  
            }
        }
    }
    function sevices() {

        $q = "SELECT * FROM event_services";
        $db = new Database();

        if ($data = $db->multiFetch($q)) {
            for ($i = 0; $i < count($data); $i++) {
              
                echo '<input type="checkbox" value="' . $data[$i]->id . '">'. $data[$i]->service .'<br>';
            }
        }
    }

    function location() {

        $q = "SELECT * FROM event_location";
        $db = new Database();

        if ($data = $db->multiFetch($q)) {
            for ($i = 0; $i < count($data); $i++) {
                echo '<option value="' . $data[$i]->id . '" >' . $data[$i]->location . '</option>';
            }
        }
    }
  
     function types() {

        $q = "SELECT * FROM event_type";
        $db = new Database();

        if ($data = $db->multiFetch($q)) {
            for ($i = 0; $i < count($data); $i++) {
                echo '<option value="' . $data[$i]->id . '" >' . $data[$i]->types . '</option>';
            }
        }
    }

}
