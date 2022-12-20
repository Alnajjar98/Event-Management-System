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
if (isset($_POST['firstName'])) {
    $firstName = trim($_POST['firstName']);
}
if (isset($_POST['middleName'])) {
    $middleName = trim($_POST['middleName']);
}
if (isset($_POST['lastName'])) {
    $lastName = trim($_POST['lastName']);
}
if (isset($_POST['nationality'])) {
    $nationality = trim($_POST['nationality']);
}
if (isset($_POST['cpr'])) {
    $cpr = trim($_POST['cpr']);
}
if (isset($_POST['phone'])) {
    $phone = trim($_POST['phone']);
}
if (isset($_POST['address'])) {
    $address = trim($_POST['address']);
}

include_once 'models/Countries.php';
$countries = new Countries();
$country = $countries->country($nationality);

include_once 'models/Events.php';
$events = new Events();
$event = $event->getEvent($event_id);
$image = $event->image;
$image = '<img src="data:image/jpg;base64,' . base64_encode($image) . '" width="200px"/>';
$totalRentalCar = $events->totalRental($event_id, $startDate, $endDate);

if (!empty($servicesList)) {
    include_once 'models/Services.php';
    $services = new Services();
    $rentalServices = $services->services($servicesList);
    $totalRentalServices = $services->totalRental($servicesList, $startDate, $endDate);

    $totalRentalCost = $totalRentalEvent->total_cost + $totalRentalServices->total_cost;
} else {
    $totalRentalCost = $totalRentalEvent->total_cost;
}
?>
    <center>
        <div id="aboutsidebar" class="overflow">
            <h1>Checkout Confirmation</h1>
            <h3>Reservation Summary</h4>
            <form action="payment.php" method="POST">
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
                            <label for="totalDays">Total Reservation Days: <?php echo $totalRentalEvent->total_days; ?></label>
                            <input type="hidden" name="totalDays" value="<?php echo $totalRentalEvent->total_days; ?>" />
                        </div>
                        <div class="column">
                            <label for="totalCost">Total Reservation Cost: <?php echo $totalRentalCost . 'BHD'; ?></label>
                            <input type="hidden" name="totalCost" value="<?php echo $totalRentalCost; ?>" />
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Customer Details:</legend>
                    <div class="row">
                        <div class="column">
                            <label for="firstName">First Name: <?php echo $firstName; ?></label>
                            <input type="hidden" name="firstName" value="<?php echo $firstName; ?>" />
                        </div>
                        <div class="column">
                            <label for="middleName">Middle Name: <?php echo $middleName; ?></label>
                            <input type="hidden" name="middleName" value="<?php echo $middleName; ?>" />
                        </div>
                    </div>
                    <br><br>
                    <div class="row">
                        <div class="column">
                            <label for="lastName">Last Name: <?php echo $lastName; ?></label>
                            <input type="hidden" name="lastName" value="<?php echo $lastName; ?>" />
                        </div>
                        <div class="column">
                            <label for="phone">Phone/Mobile Number: <?php echo $phone; ?></label>
                            <input type="hidden" name="phone" value="<?php echo $phone; ?>" />
                        </div>
                    </div>
                    <br><br>
                    <div class="row">
                        <div class="column">
                            <label for="country">Country: <?php echo $country->country_name_en; ?></label>
                        </div>
                        <div class="column">
                            <label for="nationality">Nationality: <?php echo $country->country_nationality_en; ?></label>
                            <input type="hidden" name="nationality" value="<?php echo $nationality; ?>" />
                        </div>
                    </div>
                    <br><br>
                    <div class="row">
                        <div class="column">
                            <label for="cpr">National Identity Number: <?php echo $cpr; ?></label>
                            <input type="hidden" name="cpr" value="<?php echo $cpr; ?>" />
                        </div>
                        <div class="column">
                            <label for="address">Billing Address:</label>
                            <textarea name="address" id="address" cols="40" rows="1" readonly><?php echo $address; ?></textarea>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Event Details:</legend>
                    <div class="row">
                        <div class="column">
                            <h2><?php echo $event->types . ' ' . $event->category; ?></h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="column">
                            <?php echo $image; ?>
                        </div>
                        <div class="column">
                            <label for="dailyPrice">Daily Rental Price:</label>
                            <label for="dailyPrice"><?php echo $event->daily_rental_price . 'BHD'; ?></label>
                            <br><br>
                            <label for="servicesList">Rental Services:</label>
                            <ol>
<?php
if (!empty($rentalServices)) {
    for ($i = 0; $i < count($rentalServices); $i++) {
        echo '<li>' . $rentalServices[$i]->accessory . ', ' . $rentalServices[$i]->daily_rental_price . 'BHD per day</li><br/>';
        echo '<input type="hidden" name="sevicesList[]" value="' . $rentalServices[$i]->id . '" />';
    }
} else {
    echo '<li>No Services added.</li>';
}
?>
                            </ol>
                        </div>
                    </div>
                </fieldset>
                <input type="hidden" name="event_id" value="<?php echo $event->id; ?>">
                <br />
                <button onclick="location.href='index.php'" type="button">Cancel Reservation</button>
                &nbsp&nbsp&nbsp&nbsp
                <button type="submit">Continue to Payment</button>
            </form>
        </div>
      </center>
    </body>
</html>
