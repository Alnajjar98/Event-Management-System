<?php

class Database1
{

    public $dbc = NULL;
    
    public function getDBConnection() {

        if ($this->dbc == NULL)
            $this->dbc = mysqli_connect('localhost', 'u201601573', 'u201601573', 'db201601573');
            //$this->dbc = mysqli_connect('localhost','root','', '');

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
    
    function __destruct() {
      //print "Destroying the connection<br>";
      $this->closeDB();
    }
    
     public function closeDB()
    {
         mysqli_close($this->dbc);  
    }

     
 }
?>
