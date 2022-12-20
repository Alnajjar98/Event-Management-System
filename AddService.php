<?php

include_once 'AdminHeader.php';
        
?>



<center>
        <div id="reg">
    
            <form action="AddService.php" method="post">
    <table>
            
        <tr><td><h4>Service :</h4><td> <input type="text" name="service" size="20" value="" /> 
    
                 
               
            <div align="center">
                
                  <input type ="submit" class ="Button SubButton" value ="Add" />
            </div>  
            <input type="hidden" name="submitted" value="1" />
     
</form>    

</div>
        </center>
<?php


    if( isset($_POST['submitted']) )
{
    
    
    $services= $_POST['service'];
    include 'Database.php';
     $db = new Database();
 
      $q = "Insert into event_services(service) value ('$services')";
    $data= $db->querySQL($q);
    
      echo '<script>window.location = "eventServices.php"</script>';
    
           
}
   
    

?>