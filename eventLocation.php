<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        
              <style>
table,th,td {
    border: 4px solid #ab0d24;
    border-collapse: collapse;
    padding: 8px;
    border-spacing: 10px;
    width: 1000px;
    clear: both;
    margin: 10px 400px;
    text-align: center;
}

</style>
    </head>
    <body>
        <?php
        include_once 'Database.php';
        include_once 'AdminHeader.php';
        
        
        $q = "Select * from  event_locations;";
        $db = new Database();
        $data = $db->multiFetch($q);
        ?>
         <form>
             <center> <h3>Add New location  </h3><input type="button" class="Button SubButton" value="Add location" onclick="window.location.href='AddLocation.php'" /></center>
</form>
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
                     
                     <td><h4>Location</h4></td>';

                $bg = '#f2f2f2';

                for ($i = 0; $i < $row_cnt; $i++) {
                    $bg = ($bg == '#f2f2f2' ? '#f2f2f2' : '#f2f2f2');

                    $table .= '<tr bgcolor="' . $bg . '">
                        
                        <td><a href="EditLocation.php?id=' .  $data[$i]->id . '">Edit</a></td>
                            <td><a href="DeleteLocation.php?id=' .  $data[$i]->id . '">Delete</a></td>
                          
                          <td>' . $data[$i]->location. '</td>';

                }
                $table .= '</table>';

                echo $table;
            }
        }
        else {
            echo '<p class="error"> There was an error</p>';
        }
        ?>
    </body>
</html>
