<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
       
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } elseif (isset($_POST['id'])) {
            $id = $_POST['id'];
        }

        include_once 'AdminHeader.php';
        include_once 'Database.php';

        $db = new Database();
        $q = 'SELECT service AND service_price FROM services WHERE id = ' . $id;
        

        $data = $db->multiFetch($q);
       

        ?>
        

    <center>
        <div id="edit">
            <form action="EditServices.php" method="post">
                

                Event Service :
                <input  name="services" type="text" value="<?php echo $data->services ?>" >
                <br> <br> <br>
                Service Price :
                <input  name="services" type="text" value="<?php echo $data->services ?>" >
                <div align="center">

                    <input type ="submit" class ="Button SubButton" value ="Change" />

                </div>  
                <input type="hidden" name="submitted" value="<?php echo $id ?>" />

            </form>
        </div>
    </center>


</body>
</html>
<?php
if (isset($_POST['submitted'])) {

$idd = $_POST['submitted'];
    $services = $_POST['service'];
    $services = $_POST['service_price'];
    

    $q3 = "Update services set service = '$services '  where id = $idd";
    $q3 = " Update services set service_price = '$services ' where id = $idd";
   
    $data3 = $db->querySQL($q3);

    
     echo '<script>window.location = "eventServices.php"</script>';
        
      
}
?>