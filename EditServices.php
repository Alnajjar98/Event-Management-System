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
        $q = 'SELECT services FROM event_services WHERE id = ' . $id;
       

        $data = $db->singleFetch($q);


        ?>
        

    <center>
        <div id="edit">
            <form action="EditServices.php" method="post">
                

                Car Category :
                <input  name="services" type="text" value="<?php echo $data->services ?>" >
                <br> <br> <br>

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
    $Accessory = $_POST['services'];
    

    $q3 = "Update event_type set services = '$services '  where id = $idd";
    $data3 = $db->querySQL($q3);
    
     echo '<script>window.location = "eventServices.php"</script>';
        
      
}
?>