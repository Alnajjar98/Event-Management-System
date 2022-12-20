<!DOCTYPE html>
<?php
include_once 'models/Events.php';
$events = new $events();

if (isset($_GET['id'])) {
    $id = trim($_GET['id']);
}
$events = $events->getEvents($id);

$image = $events->image;
$image = '<img src="data:image/jpg;base64,' . base64_encode($image) . '" width="200px"/>';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $events->types ?></title>
        <link rel="stylesheet" href="css/table.css">
    </head>
    <body>
        <?php
include_once 'Header.php';
?>
    <center>
        <div id="aboutsidebar" class="overflow">
            <h1><?php echo $events->types . ' Reservation'; ?></h1>
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
                        <td><?php echo $events->location; ?></td>
                        <td><?php echo $events->types; ?></td>
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
