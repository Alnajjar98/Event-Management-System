<!DOCTYPE html>
<?php
include_once 'models/Services.php';
$services = new Services();
$servicesList = $services->listAll();

if (isset($_GET['id'])) {
    $event_id = trim($_GET['id']);
}
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
            <h1>Add Services</h1>
            <h4>Check the boxes you want Services for.</h4>
            <button onclick="location.href='customerinfo.php?car_id=<?php echo $event_id; ?>'" type="button">Skip</button>
            &nbsp
            <button onclick="location.href='index.php'" type="button">Cancel Reservation</button>
            <form action="customerinfo.php" method="POST">
            <table>
                <tr>
                    <th>Service</th>
                    <th>Available Quantity</th>
                    <th>Daily Rental Price</th>
                    <th>Add to Reservation</th>
                </tr>
                <tbody>
                    <?php
if (!empty($servicesList)) {
    for ($i = 0; $i < count($servicesList); $i++) {
        echo '<tr><td>' . $servicesList[$i]->service . '</td>
        <td>' . $servicesList[$i]->available_qty . '</td>
        <td>' . $servicesList[$i]->daily_rental_price . 'BHD</td>
        <td><input type="checkbox" name="service_list[]" value="' . $servicesList[$i]->id . '"></td>
        </tr>';
    }
} else {
    echo '<p class="error">There was an error with services.</p>';
}
?>
                </tbody>
            </table>
            <br />
            <input type="submit" value="Add Services" />
            <input type="hidden" name="car_id" value="<?php echo $event_id; ?>">
            <input type="hidden" name="submitted" value="1">
            </form>
        </div>
      </center>
    </body>
</html>