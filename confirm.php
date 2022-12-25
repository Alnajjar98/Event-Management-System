<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Reservation Checkout</title>
        <link rel="stylesheet" href="css/table.css">
        <style>
            .message {
            width: 500px;
            margin: 20px auto;
            text-align: center;
            font-size: 18px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            }
            .success {
            color: green;
            }
            .failure {
            color: red;
            }
        </style>
    </head>
    <body>
<?php
include_once 'Header.php';
// get values from post $event_id, $reservation_total_cost, $start_date, $end_date
if (isset($_POST['event_id'])) {
    $event_id = trim($_POST['event_id']);
}
if (isset($_POST['totalCost'])) {
    $reservation_total_cost = trim($_POST['totalCost']);
}
if (isset($_POST['startDate'])) {
    $start_date = trim($_POST['startDate']);
}
if (isset($_POST['endDate'])) {
    $end_date = trim($_POST['endDate']);
}
if (!empty($_POST['servicesList'])) {
    $services = $_POST['servicesList'];
}
// generate reservation code
$reservation_code = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8);

include_once 'models/Reservations.php';
$reservations = new Reservations();
$insert = $reservations->createReservation($event_id, $reservation_total_cost, $start_date, $end_date, $reservation_code);
$reservation2 = $reservations->getLastInsertedReservation();

if (!empty($services)) {
    foreach ($services as $service) {
        $reservations->addReservationServices($service);
    }
}
// if ($insert) {
//     echo 'Reservation created successfully';
// } else {
//     echo 'Reservation creation failed';
// }
?>

        <!-- print Reservation details in a nice style -->
        <center>
        <div id="aboutsidebar" class="overflow">
            <h1>Reservation Details</h1>
            <div class="message <?php echo $insert ? 'success' : 'failure'; ?>">
                <?php echo $insert ? 'Reservation created successfully' : 'Reservation creation failed'; ?>
            </div>
            <table>
                <thred>
                    <th>Event ID</th>
                    <th>Reservation Code</th>
                    <th>Reservation Total Cost</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                </thread>
                <tbody>
                    <tr>
                        <td><?php echo $event_id; ?></td>
                        <td><?php echo $reservation_code; ?></td>
                        <td><?php echo $reservation_total_cost; ?></td>
                        <td><?php echo $start_date; ?></td>
                        <td><?php echo $end_date; ?></td>
                    </tr>
                </tbody>
            </table>
        </center>
    </body>