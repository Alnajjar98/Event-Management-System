<!DOCTYPE html>
<?php
include_once 'models/Events.php';
$events = new Events();
echo '<pre>';
print_r($_POST);
print_r($_GET);
echo '</pre>';

if (isset($_GET['id'])) {
    $id = trim($_GET['id']);
}

$events = $events->getEvent($id);

// echo ($events->getLocationName);

$image = $events->image;
$image = '<img src="data:image/jpg;base64,' . base64_encode($image) . '" width="200px"/>';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $events->type_id ?></title>
        <link rel="stylesheet" href="css/table.css">
    </head>
    <body>
        <?php
include_once 'Header.php';
?>
    <center>
        <div id="aboutsidebar" class="overflow">
            <h1><?php echo $events->type_id . ' Reservation'; ?></h1>
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
                        <td><?php echo $image; ?></td>
                        <td><?php echo $events->type_id; ?></td>
                        <td><?php echo $events->event_type; ?></td>
                        <td><?php echo $events->category; ?></td>
                        <td><?php echo $events->daily_rental_price . 'BHD'; ?></td>
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
