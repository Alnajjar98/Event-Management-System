<!DOCTYPE html>
<?php
// include database.php
include_once 'Database.php';
include_once 'models/Events.php';
$events = new Events;
echo '<pre>';
print_r($_POST);
print_r($_GET);
echo '</pre>';
if (isset($_GET['id'])) {
    $id = trim($_GET['id']);
}
print_r($events->location->id);
$events = $events->initWithId($id);
$image = $events->getImage();
$image = '<img src="' . $image . '" width="200px">';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $events->getId() ?></title>
        <link rel="stylesheet" href="css/table.css">
    </head>
    <body>
        <?php
include_once 'Header.php';
?>
    <center>
        <div id="aboutsidebar" class="overflow">
            <h1><?php echo $events->getFieldByForeignKey('event_locations',$events->getLocationId(),'location') . ' Reservation'; ?></h1>
            <table>
                <tr>
                    <th>Image</th>
                    <th>Event Location</th>
                    <th>Event Type</th>
                    <th>Category</th>
                    <th>Daily Rental Price</th>
                </tr>
                <tbody>
                    <tr>
                        <td><?php echo $image ?></td>
                        <td><?php echo $events->getFieldByForeignKey('event_locations',$events->getLocationId(),'location'); ?></td>
                        <td><?php echo $events->getFieldByForeignKey('event_types',$events->getTypeId(),'type'); ?></td>
                        <td><?php echo $events->getFieldByForeignKey('event_categories',$events->getCategoryId(),'category'); ?></td>
                        <td><?php echo $events->getEventCost() . 'BHD'; ?></td>
                    </tr>
                </tbody>
            </table>
            <br />
            <button onclick="location.href='index.php'" type="button">Cancel Reservation</button>
            &nbsp
            <button onclick="location.href='accessories.php?id=<?php echo $id; ?>'" type="button">Proceed with Reservation</button>
        </div>
      </center>
    </body>
</html>
