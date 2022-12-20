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
        
        
        $q = "Select * from  event_services;";
        $db = new Database();
        $data = $db->multiFetch($q);
        
          ?>
         <form>
             <center>  <h3>Add New Services </h3><input type="button" class="Button SubButton" value="Add Service" onclick="window.location.href='AddService.php'" /></center>
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
                     
                     <td><h4>Services</h4></td>';

                $bg = '#f2f2f2';

                for ($i = 0; $i < $row_cnt; $i++) {
                    $bg = ($bg == '#f2f2f2' ? '#f2f2f2' : '#f2f2f2');

                    $table .= '<tr bgcolor="' . $bg . '">
                        
                        <td><a href="EditServices.php?id=' .  $data[$i]->id . '">Edit</a></td>
                            <td><a href="DeleteService.php?id=' .  $data[$i]->id . '">Delete</a></td>
                          
                          <td>' . $data[$i]->service. '</td>';

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
