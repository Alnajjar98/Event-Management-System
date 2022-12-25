<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Reservation Checkout</title>
        <link rel="stylesheet" href="css/table.css">
    </head>
    <body>
<?php
include_once 'Header.php';
echo '<pre>';
print_r($_POST);
print_r($_GET);
echo '</pre>';
if (isset($_POST['event_id'])) {
    $event_id = trim($_POST['event_id']);
}
if (!empty($_POST['servicesList'])) {
    $servicesList = $_POST['servicesList'];
}
if (isset($_POST['startDate'])) {
    $startDate = trim($_POST['startDate']);
}
if (isset($_POST['endDate'])) {
    $endDate = trim($_POST['endDate']);
}
if (!empty($_POST['servicesList'])) {
    $services = $_POST['servicesList'];
}

include_once 'models/Events.php';
$events = new Events();
$events = $events->initWithId($event_id);
$event_type = $events->getFieldByForeignKey('event_types',$events->getTypeId(),'type');
$event_category = $events->getFieldByForeignKey('event_categories', $events->getCategoryId(), 'category');
// print_r($events);
$image = $events->getImage();
$event_total_rental = $events->totalRental($event_id, $startDate, $endDate);

if (!empty($servicesList)) {
    include_once 'models/Services.php';
    $services = new Services();
    $daily = $events->getEventCost();
    $rentalServices = $services->getServicesByIds($servicesList);
    foreach ($rentalServices as $service) {
        $daily = $daily + $service->service_price;
    }
    $totalRentalServices = $services->totalRental($servicesList, $startDate, $endDate);
    $totalRentalCost = $event_total_rental->total_cost + $totalRentalServices->total_cost;
} else {
    $totalRentalCost = $event_total_rental->total_cost;
}

// handle the form submission confirm
// if (isset($_POST['confirm'])) {
//     // insert into reservations table
//     include_once 'models/Reservations.php';
//     $reservations = new Reservations();
//     // create reservation not using the model class fiels [event_id, reservation_total_cost, start_date, end_date, reservation_code]
//     $reservations->setEventId($event_id);
//     $reservations->setReservationTotalCost($totalRentalCost);
//     $reservations->setStartDate($startDate);
//     $reservations->setEndDate($endDate);
//     $reservations->setReservationCode();
//     // random reservation code
//     $reservation_code = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8);
//     $reservation->save2($event_id, $totalRentalCost, $startDate, $endDate, $reservation_code);
//     $reservation_id = $reservations->getId();
    // insert into reservation_services table
    // if (!empty($servicesList)) {
    //     include_once 'models/ReservationServices.php';
    //     $reservationServices = new ReservationServices();
    //     foreach ($servicesList as $service_id) {
    //         $reservationServices->setReservationId($reservation_id);
    //         $reservationServices->setServiceId($service_id);
    //         $reservationServices->setCreatedAt(date('Y-m-d H:i:s'));
    //         $reservationServices->setUpdatedAt(date('Y-m-d H:i:s'));
    //         $reservationServices->save();
    //     }
    // }
    // redirect to reservations page
//     header('Location: reservations.php');
// }
?>
    <center>
        <div id="aboutsidebar" class="overflow">
            <h1>Checkout Confirmation</h1>
            <h3>Reservation Summary</h4>
            <form action="confirm.php" method="POST">
                <fieldset>
                    <legend>Reservation Details:</legend>
                    <div class="row">
                        <div class="column">
                            <label for="startDate">Start Date:</label>
                            <input type="date" name="startDate" id="startDate" value="<?php echo $startDate; ?>" readonly>
                        </div>
                        <div class="column">
                            <label for="endDate">End Date:</label>
                            <input type="date" name="endDate" id="endDate" value="<?php echo $endDate; ?>" readonly>
                        </div>
                    </div>
                    <br><br>
                    <div class="row">
                        <div class="column">
                            <label for="totalDays">Total Reservation Days: <?php echo $event_total_rental->total_days; ?></label>
                            <input type="hidden" name="totalDays" value="<?php echo $event_total_rental->total_days; ?>" />
                        </div>
                        <div class="column">
                            <label for="totalCost">Total Reservation Cost: <?php echo $totalRentalCost . 'BHD'; ?></label>
                            <input type="hidden" name="totalCost" value="<?php echo $totalRentalCost; ?>" />
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Event Details:</legend>
                    <div class="row">
                        <div class="column">
                            <h2><?php echo $event_type . ' ' . $event_category; ?></h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="column">
                        <?php echo('<img src="'.$image.'" width="200px">')?>
                        </div>
                        <div class="column">
                            <label for="dailyPrice">Daily Rental Price:</label>
                            <label for="dailyPrice"><?php echo $daily . 'BHD'; ?></label>
                            <br><br>
                            <label for="servicesList">Rental Services:</label>
                            <ul>
                            <?php
                            if (!empty($rentalServices)) {
                                foreach ($rentalServices as $rentalService){
                                    echo '<li>' . $rentalService->service . ' - ' . $rentalService->service_price . 'BHD</li>';
                                }
                            } else {
                                echo '<li>No Services added.</li>';
                            }
                            // Daily Rental Price + Services Price
                            ?>
                            </ul>
                        </div>
                    </div>
                    <?php
                    if (!empty($rentalServices)) {
                        foreach ($rentalServices as $rentalService){
                            echo '<input type="hidden" name="servicesList[]" value="' . $rentalService->id . '" />';
                        }
                    }
                ?>
                </fieldset>
                <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
                <br />
                <button onclick="location.href='index.php'" type="button">Cancel Reservation</button>
                &nbsp&nbsp&nbsp&nbsp
                <button type="submit">Confirm Reservation</button>
            </form>
        </div>
      </center>
    </body>
</html>
