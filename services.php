<!DOCTYPE html>
<?php
include_once 'models/Services.php';
include_once 'models/Events.php';
$services = new Services();
$event = new Events();
// $servicesList = '';
$servicesList = $services->listAll();


if (isset($_GET['id'])) {
    $event_id = trim($_GET['id']);
}
$event = $event->initWithId($event_id);

print_r($event);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add Services to Reservation</title>
        <link rel="stylesheet" href="css/table.css">
    </head>
    <body>
        <?php
include_once 'Header.php';
?>
    <center>
        <div id="aboutsidebar" class="overflow">
            <h1>Event</h1>
            <table>
                <tr>
                    <th>Event Type</th>
                    <th>Category</th>
                    <th>Location</th>
                    <th>Price</th>
                </tr>
                <tbody>
                    <tr>
                        <td><?php echo $event->getFieldByForeignKey('event_types',$event->getTypeId(),'type'); ?></td>
                        <td><?php echo $event->getFieldByForeignKey('event_categories',$event->getCategoryId(),'category'); ?></td>
                        <td><?php echo $event->getFieldByForeignKey('event_locations',$event->getLocationId(),'location'); ?></td>
                        <td><?php echo $event->getEventCost() . 'BHD'; ?></td>
                    </tr>
                </tbody>
            </table>
            <h1>Add Services</h1>
            <h4>Check the boxes you want Services for.</h4>
            <button onclick="location.href='customerinfo.php?id=<?php echo $event_id; ?>'" type="button">Skip</button>
            &nbsp
            <button onclick="location.href='index.php'" type="button">Cancel Reservation</button>
            <form action="customerinfo.php" method="POST">
            <table>
                <tr>
                    <th>Service</th>
                    <th>Daily Rental Price</th>
                    <th>Add to Reservation</th>
                </tr>
                <tbody>
                    <?php
if (!empty($servicesList)) {
    foreach ($servicesList as $service) {
        echo '<tr>';
        echo '<td>' . $service->service . '</td>';
        echo '<td>' . $service->service_price . '</td>';
        echo '<td><input type="checkbox" name="services[]" value="' . $service->id . '"></td>';
        echo '</tr>';
    }
} else {
    echo '<p class="error">There was an error with services.</p>';
}
?>
                </tbody>
            </table>
            <br />
            <input type="submit" value="Add Services" />
            <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
            <input type="hidden" name="submitted" value="1">
            </form>
        </div>
      </center>
    </body>
</html>