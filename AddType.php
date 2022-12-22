<?php
include_once 'AdminHeader.php';
        
?>



<center>
        <div id="reg">
    
            <form action="AddType.php" method="POST">
    <table>
            
        <tr><td><h4>Type :</h4><td> <input type="text" name="types" size="20" value="" /> 
    
                 
               
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
    
    
    $types= $_POST['types'];
    include 'Database.php';
     $db = new Database();
 
      $q = "INSERT INTO event_types(type) VALUES ('$types')";
    $data= $db->querySQL($q);
    
      echo '<script>window.location = "eventType.php"</script>';
    
           
}
   
    

?>