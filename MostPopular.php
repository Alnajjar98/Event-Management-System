<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
       <style>
table,th,td {
    border: 4px solid #1f1f7a;
     border-collapse: collapse;
     padding: 8px;
     border-spacing: 10px;
}

</style>
    </head>
    <body>
        <?php
        
        include_once 'Database.php';
        include_once 'AdminHeader.php';
        
        
        $q = "SELECT r.reservations_count,cat.category,m.location, mo.types,c.daily_rental_price
from most_popular_events_report r
 JOIN events c on c.id = r.event_id
JOIN event_categories cat on cat.id = c.category_id
join event_location m on m.id = c.location_id
join event_types mo on mo.id = c.type_id
ORDER BY reservations_count DESC
LIMIT 5
";
       
      echo'<center><h3>Top 5 Most Popular events hall that have been reserved </h3></center>  ';        
                
        $db = new Database();
        $data = $db->multiFetch($q);

        if (!empty($data)) {
            $row_cnt = count($data);

            if ($row_cnt == 0) {
                echo '<br>';
                echo '<p>sorry no data found</p>';
            } else {
                echo '<br>';
                //display a table of results
                $table = '<table class="CSSTableGenerator" width="95%">' .
                        '<tr bgcolor="#f2f2f2">
                     <td><h4>Number Of Reservations</h4></td>
                     <td><h4>Category</h4></td>
                     <td><h4>Location</h4></td>
                     <td><h4>types</h4></td>
                     <td><h4>Daily Rent Price</h4></td>
                     ';

                $bg = '#f2f2f2';

                for ($i = 0; $i < $row_cnt; $i++) {
                    $bg = ($bg == '#f2f2f2' ? '#f2f2f2' : '#f2f2f2');

                    $table .= '<tr bgcolor="' . $bg . '">
                          <td>' . $data[$i]->reservations_count. '</td>
                          <td>' . $data[$i]->category. '</td>
                          <td>' . $data[$i]->location . '</td>
                          <td>' . $data[$i]->types . '</td>
                          <td>' . $data[$i]->daily_rental_price . '</td>';

                }
                $table .= '</table>';

                echo $table;
            }
        }
        else {
            echo '<p class="error"> Oh dear. There was an error</p>';
        }
        ?>
    </body>
</html>
