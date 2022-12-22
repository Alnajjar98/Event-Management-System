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
        
        
        $q = "SELECT c.image,c.id,cat.category,m.location, mo.types,c.daily_rental_price
from events c
JOIN event_categories cat on cat.id = c.category_id
join event_location m on m.id = c.location_id
join event_type mo on mo.id = c.type_id
";
                
                
        $db = new Database();
        $data = $db->multiFetch($q);
           ?>
        <form>
            <center><h2>Add New Event Halls </h2><input type="button" class="Button SubButton" value="Add a new event" onclick="window.location.href='AddEvent.php'" /></center>
</form>
            <center>
<?php

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
                      
                      <td><h4>Edit</h4></td>
                      <td><h4>Delete</h4></td>
                     <td><h4>Image</h4></td>
                     <td><h4>Category</h4></td>
                     <td><h4>location</h4></td>
                     <td><h4>types</h4></td>
                     <td><h4>Daily Rent Price</h4></td>
                     ';

                $bg = '#f2f2f2';
                
                

                for ($i = 0; $i < $row_cnt; $i++) {
                    $bg = ($bg == '#f2f2f2' ? '#f2f2f2' : '#f2f2f2');
$img = $data[$i]->image;
$img = '<img src="data:image/jpg;base64,'.base64_encode( $img ).'" width="200px"/>';
                    $table .= '<tr bgcolor="' . $bg . '">
                        <center>
                        <td><a href="EditEvent.php?id=' .  $data[$i]->id . '">Edit</a></td>
                            <td><a href="deleteEvent.php?id=' .  $data[$i]->id . '">Delete</a></td>
                          <td>' . $img.'</td>
                          <td>' . $data[$i]->categories. '</td>
                          <td>' . $data[$i]->locations . '</td>
                          <td>' . $data[$i]->types . '</td>
                          <td>' . $data[$i]->event_cost . '</td></tr>';

                }
                $table .= '</table>';

                echo $table;
               
            }
        }
        else {
            echo '<p class="error"> No Data Found</p>';
        }
        ?>
    </body>
</html>
