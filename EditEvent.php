<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
        include_once  'Dropdownfunctions.php';
        $drop = new Dropdownfunctions();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } elseif (isset($_POST['id'])) {
            $id = $_POST['id'];
        }

        include_once 'AdminHeader.php';
        include_once 'Database.php';

        $db = new Database();
        $q = 'SELECT daily_rental_price FROM events WHERE id = ' . $id;

        $data = $db->singleFetch($q);


        ////////////////

        $q2 = "SELECT c.id,cat.id as catid,cat.category,m.id as manid,m.location,mo.id as moid, mo.types,c.daily_rental_price
from events c
JOIN event_categories cat on cat.id = c.category_id
join event_location m on m.id = c.location_id
join event_type mo on mo.id = c.type_id
where c.id = $id
   
";

        $data2 = $db->singleFetch($q2);


        ////////////
        ?>
        

    <center>
        <div id="edit">
            <form action="EditEvent.php" method="post">
                Select Category : <select name="Category" >
<?php
echo '<option value="' . $data2->catid . '" selected ="' . $data2->category . '" >' . $data2->category . '</option>';
$drop->category();
?>
                </select>
                <br> <br> <br>
                Select Location :  <select name="location">
                    <?php
                    echo '<option value="' . $data2->manid . '" selected ="' . $data2->location . '" >' . $data2->location . '</option>';
                    $drop->location()
                    ?>
                </select>
                <br> <br> <br>
                Select Type : <select name="model">
                    <?php
                    echo '<option value="' . $data2->moid . '" selected ="' . $data2->types . '" >' . $data2->types . '</option>';
                    $drop->types()
                    ?>
                </select>
                <br> <br> <br>
                Daily rental price :
                <input  name="price" type="text" value="<?php echo $data->daily_rental_price ?>" >
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
    $cat = $_POST['Category'];
    $loc = $_POST['location'];
    $tp = $_POST['types'];
    $price = $_POST['price'];
    

    $q3 = "Update events set location_id = $loc, category_id = $cat, type_id = $tp, daily_rental_price = $price where id = $idd";
    $data3 = $db->querySQL($q3);
     
    
            echo '<script>window.location = "AdminEvents.php"</script>';
        
      

}
?>