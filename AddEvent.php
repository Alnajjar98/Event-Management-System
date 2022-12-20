<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        include_once 'Dropdownfunctions.php';
        $drop = new Dropdownfunctions();


        include_once 'AdminHeader.php';
        include_once 'Database.php';

        $db = new Database();
        ?>


    <center>
        <div id="edit">
            <form action="AddEvent.php" method="post" enctype="multipart/form-data">
                Select Category : <select name="Category" >
<?php
$drop->category();
?>
                </select>
                <br> <br> <br>
                Select Location :  <select name="location">
                    <?php
                    $drop->location()
                    ?>
                </select>
                <br> <br> <br>
                Select Type : <select name="types">
                    <?php
                    $drop->types()
                    ?>
                </select>
                <br> <br> <br>
                Daily rental price :<input type="text" name="price" size="20" value="" />

                <br> <br> <br>
                
<input name="image" accept="image/jpg" type="file">
               <br> <br> <br>
                <div align="center">

                    <input type ="submit" class ="Button SubButton" value ="Add" />

                </div>  
                <input type="hidden" name="submitted" value="1" />

            </form>
        </div>
    </center>


</body>
</html>
<?php
if (isset($_POST['submitted'])) {

   if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {


// Temporary file name stored on the server

$tmpName = $_FILES['image']['tmp_name'];


// Read the file

$fp = fopen($tmpName, 'r');

$imgdata = fread($fp, filesize($tmpName));

$imgdata = addslashes($imgdata);

fclose($fp);

        $cat = $_POST['Category'];
        $man = $_POST['location'];
        $mod = $_POST['types'];
        $price = $_POST['price'];


        $q3 = "Insert into events(location_id, type_id, category_id, daily_rental_price,image) values ($man,$mod,$cat,$price,'$imgdata');";
        $data3 = $db->querySQL($q3);
        var_dump($data3);

        echo '<script>window.location = "AdminEvents.php"</script>';
    }
    else echo '<script>window.location = "AdminEvents.php"</script>';
}

?>