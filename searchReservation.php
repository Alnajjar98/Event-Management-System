<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        include_once 'Header.php';
        if (isset($_POST['submitted'])) {
            include_once 'models/Reservations.php';
            $reservation = new Reservations();
            if (isset($_POST['reservation'])) {
                $code = trim($_POST['reservation']);
            }
            ?>
            <form action="ReservationDetails.php" method="post" id="code">
                <input type="hidden" name="reservationCode" value="<?php echo $code; ?>" />
            </form>

    <?php
}
?>
    <center>
        <div id="reg">
            <h1>Search Reservation</h1>
            <form action="searchReservation.php" method="post">
                <table>
                    <tr><td><h4>Reservation Code: </h4><td> <input  name="reservation" size="20" value="" />

                </table>
                <div align="center">
                    <input type ="submit" class ="Button SubButton" value ="search" />
                </div>
                <input type="hidden" name="submitted" value="1" />
            </form>
        </div>
    </center>

</body>
<script>
    if (code) {
        document.forms["code"].submit();
    }
</script>
</html>