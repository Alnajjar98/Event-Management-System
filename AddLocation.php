<?php
include_once 'AdminHeader.php';
        
?>



<center>
        <div id="reg">
    
            <form action="AddLocation.php" method="post">
    <table>
            
        <tr><td><h4>Location :</h4><td> <input type="text" name="location" size="20" value="" /> 
    
                 
               
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
    
    
    $location = $_POST['location'];
    include 'Database.php';
     $db = new Database();
 
      $q = "Insert into event_location(location) value ($location)";
    $data= $db->querySQL($q);
    
      echo '<script>window.location = "eventLocation.php"</script>';
    
           
}
   
    

?>