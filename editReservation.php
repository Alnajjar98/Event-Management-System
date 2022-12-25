<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
include_once 'Header.php';
include_once('models/Reservations.php');
include_once 'Dropdownfunctions.php';
$drop = new Dropdownfunctions();
if (isset($_POST['reservationCode'])) {
    $id = trim($_POST['reservationCode']);
} elseif (isset($_GET['reservationCode']))
{
    $id = trim($_GET['reservationCode']);
}
// print all post values
echo '<pre>';
print_r($_POST);
print_r($_GET);
echo '</pre>';
$reservation = new Reservations();
$object = $reservation->getReservationByCode($id);

// get service by reservation id
if ($object){
$service = $reservation->getServiceByReservationId($object->getId());
$event = $reservation->getEventByReservationId($object->getEventId());
    if (!$event && !$service){
        // break page if no event or service found
        echo 'No event or service found';
        die();
    }
}
if (!$object){
    echo 'No reservation found';
        } else {
            
            $image = $event->getImage();
            $image = '<img src="' . $image . '" width="200px">';
            // print_r($object);
            echo '<br>';
            if ($event) {
                // print_r($event);
            }
            echo '<br>';
            // print_r($service);
        
        // calculate number of days
        $startDate = $object->getStartDate();
        $endDate = $object->getEndDate();
        $date1 = new DateTime($startDate);
        $date2 = new DateTime($endDate);
        $interval = $date1->diff($date2);
        $days = $interval->format('%a');
        $days = $days + 1;
?>

         <center>
         <div id="aboutsidebar" class="overflow">
            <form action="editReservation.php" method="post">
                <h3 style="color: red">Editing Reservation</h3>
                <h1>Reservation Details</h1>
                <table>
                    <tr style='float-left'><td><h4>Reservation Code: </h4><td> <input disabled name="reservationCode" size="20" value="<?php echo $object->getReservationCode(); ?>"/>
                    <tr><td><h4>Event Start Date: </h4><td> <input disabled name="startDate" size="20" value="<?php echo $object->getStartDate(); ?>"/>
                    <tr><td><h4>Event End Date: </h4><td> <input disabled name="endDate" size="20" value="<?php echo $object->getEndDate(); ?>"/>
                    <tr><td><h4>Event Total Price: </h4><td> <input disabled name="totalPrice" size="20" value="<?php echo $object->getReservationTotalCost(); ?>"/>
                </table>
                <h1>Price Breakdown Details</h1>
                <table>
                <tr>
                    <th>Image</th>
                    <th>Event Location</th>
                    <th>Event Type</th>
                    <th>Category</th>
                    <th>Daily Rental Price</th>
                    <th>Number Of Days rented</th>
                    <th>Price * Days</th>
                </tr>
                <tbody>
                    <tr>
                        <td><?php echo $image ?></td>
                        <td><?php echo $event->getFieldByForeignKey('event_locations',$event->getLocationId(),'location'); ?></td>
                        <td><?php echo $event->getFieldByForeignKey('event_types',$event->getTypeId(),'type'); ?></td>
                        <td><?php echo $event->getFieldByForeignKey('event_categories',$event->getCategoryId(),'category'); ?></td>
                        <td><?php echo $event->getEventCost() . 'BHD'; ?></td>
                        <td><?php echo $days; ?> Days</td>
                        <td><?php echo $event->getEventCost() * $days . 'BHD'; ?></td>
                    </tr>
                </tbody>
                </table>
                <h1>Service Details</h1>
                <table>
                <tr>
                    <th>Service Name</th>
                    <th>Service Price</th>
                    <th>Service Days</th>
                    <th>Service Total Price</th>
                    <th>Remove Service</th>
                </tr>
                <!-- services with checkbox to delete -->
                <?php
                $totalServiceCost = 0;
                foreach ($service as $s) {
                    $totalServiceCost += $s->service_price;
                    echo '<tr>';
                    echo '<td>' . $s->service . '</td>';
                    echo '<td>' . $s->service_price . 'BHD</td>';
                    echo '<td>' . $days . ' Days</td>';
                    echo '<td>' . $s->service_price * $days . 'BHD</td>';
                    echo '<td> Delete ?<input type="checkbox" name="service[]" value="' . $s->id . '"></td>';
                    echo '</tr>';
                }
                echo '<tr>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td>Total</td>';
                echo '<td>' . $totalServiceCost * $days . 'BHD</td>';
                echo '<td></td>';
                echo '</tr>';
                ?>
                </table>
                    <div align="center">

                    <input type ="submit" class ="Button SubButton" value ="Change" />

                </div>
                <input type="hidden" name="submitted" value="<?php echo $id; ?>" />

            </form>
        </div>
    </center>
</body>
</html>
<?php
            if (isset($_POST['submitted'])) {
                $reservationId = trim($_POST['submitted']);
                $fname = trim($_POST['firstName']);
                $mname = trim($_POST['middleName']);
                $lname = trim($_POST['lastName']);
                $CPR = trim($_POST['CPR']);
                $phone = trim($_POST['phone']);
                $address = trim($_POST['address']);

                $q4 = "UPDATE reservations 
    SET first_name ='$fname', 
    middle_name ='$mname',
    last_name ='$lname',
    address ='$address', 
    CPR = $CPR, 
    phone_no = '$phone',
    total_rental_cost = total_rental_cost + (total_rental_cost * 0.1) 
    WHERE id = $reservationId ";
                $data4 = $db->querySql($q4);

                echo '<script>window.location = "index.php"</script>';
            }
}
?>