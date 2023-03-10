<?php

class Database {

    public static $instance = null;
    public $dblink = null;

    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new Database ( );
        }
        return self::$instance;
    }

    function __construct() {
        if (is_null($this->dblink)) {
            $this->connect();
        }
    }
    public function getDBConnection() {

        if ($this->dbc == NULL)
            // $this->dbc = mysqli_connect('localhost', 'u201601573', 'u201601573', 'db201601573');
            $this->dbc = mysqli_connect('localhost','root','', 'db201601573');

        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            die('b0ther');
        }

        return $this->dbc;
    }
   
    
    
    public function getConnection()
    {
        return $this->getDBConnection();
    }

    function connect() {
         $this->dblink = mysqli_connect('localhost', 'root', '', 'db201601573') or die('CAN NOT CONNECT');
    }

    function __destruct() {
        if (!is_null($this->dblink)) {
            $this->close($this->dblink);
        }
    }

    function close() {
        mysqli_close($this->dblink);
    }

    function querySQL($sql) {
        if ($sql != null || $sql != '') {
            $sql = $this->mkSafe($sql);
            mysqli_query($this->dblink, $sql);
            // return error if any
        }
    }
    // advance querySQL
    function querySQL2($sql) {
        if ($sql != null || $sql != '') {
            $sql = $this->mkSafe($sql);
            $res = mysqli_query($this->dblink, $sql);
            // return error if any
            if (!$res) {
                trigger_error('Error running query: ' . mysqli_error($this->dblink), E_USER_ERROR);
            }
            return $res;
        }
    }

    function singleFetch($sql) {
        $sql = $this->mkSafe($sql);
        $fet = null;
        if ($sql != null || $sql != '') {
            $res = mysqli_query($this->dblink, $sql);
            $fet = mysqli_fetch_object($res);
        }
        return $fet;
    }
    // advance singleFetch
    function singleFetch2($sql) {
        $sql = $this->mkSafe($sql);
        $fet = null;
        if ($sql != null || $sql != '') {
            $res = mysqli_query($this->dblink, $sql);
            $fet = mysqli_fetch_object($res);
            if (!$res) {
                trigger_error('Error running query: ' . mysqli_error($this->dblink), E_USER_ERROR);
            }
        }
        return $fet;
    }

    function multiFetch($sql) {
        $sql = $this->mkSafe($sql);
        $result = null;
        $counter = 0;
        if ($sql != null || $sql != '') {
            $res = mysqli_query($this->dblink, $sql);
            while ($fet = mysqli_fetch_object($res)) {
                $result[$counter] = $fet;
                $counter++;
            }
        }
        return $result;
    }
    function fetchMultipleRows($sql) {
        $result = [];
        $res = mysqli_query($this->dblink, $sql);
        if (!$res) {
          throw new Exception(mysqli_error($this->dblink));
        }
        while ($fet = mysqli_fetch_object($res)) {
          $result[] = $fet;
        }
        return $result;
      }

    // function multiFetch($sql) {
    //     $stmt = $this->dblink->prepare($sql);
    //     if ($stmt === false) {
    //       throw new Exception("Error preparing statement: " . $this->dblink->error);
    //     }
    //     if (!$stmt->execute()) {
    //       throw new Exception("Error executing statement: " . $stmt->error);
    //     }
    //     $result = [];
    //     $counter = 0;
    //     while ($row = $stmt->fetch()) {
    //       $result[$counter] = $row;
    //       $counter++;
    //     }
    //     return $result;
    //   }


   function mkSafe($string) {
        /* $string = strip_tags($string);
          if (!get_magic_quotes_gpc()) {
          $string = addslashes($string);
          } else {
          $string = stripslashes($string);
          }
          $string = str_ireplace("script", "blocked", $string);
          $string = addcslashes($escaped, '%_');

          $string = trim($string);*/
          //$newString = mysqli_escape_string($this->dblink, $string); 

        return $string;
    }

    function getRows($sql) {
        $rows = 0;
        if ($sql != null || $sql != '') {
            $result = mysqli_query($this->dblink, $sql);
            $rows = mysqli_num_rows($result);
        }
        return $rows;
    }

}
