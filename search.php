<!DOCTYPE html>

<?php
include_once 'Header.php';
include_once  'models/Events.php';
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Event Hall Search Results</title>
        <link rel="stylesheet" href="css/table.css">
        <link rel="stylesheet" href="css/pagination.css">
    </head>
    <body>
        
    
        
        <center>
        <div id="aboutsidebar" class="overflow">
            <h1>Search Results</h1>
            <table>
                <tr>
                    <th>Image</th>
                    <th>Event Type</th>
                    <th>Category</th>
                    <th>Location</th>
                    <th>Daily Price</th>
                    <th>Book Hall</th>
                </tr>
                
                
                
                <tbody>
                    <?php
                    
                    
                    $events = new Events();


                
                

// TODO: add null to values that equals to 0 

$event_location = null;
$event_category = null;
$event_type = null;
$minPrice = null;
$maxPrice = null;

if (isset($_POST['location'])) {
    if ($_POST['location'] == '0') {
        $event_location = null;
    }
    $event_location = trim($_POST['location']);
} else {
    $event_location = null;
}

if (isset($_POST['category'])) {
    if ($_POST['category'] == '0'){
        $event_category = null;
    }
    $category = trim($_POST['category']);
} else {
    $category = null;
}

if (isset($_POST['types'])) {
    if ($_POST['types'] == '0'){
        $event_type = null;
    }
    $event_type = trim($_POST['types']);
} else {
    $event_type = null;
}

if (isset($_POST['minPrice'])) {
    $minPrice = trim($_POST['minPrice']);
} else {
    $minPrice = $events->minPrice();
}

if (isset($_POST['maxPrice'])) {
    $maxPrice = trim($_POST['maxPrice']);
} else {
    $maxPrice = $events->maxPrice();
}


/*** PAGINATION ***/
// How many records displayed per page
$display = 2;
// Which record row number to start with.
if (isset($_GET['s'])) {
    $start = trim($_GET['s']);
} else {
    $start = 0;
}

$dataRows = $events->searchEventsQueryBuilder(
    $start, $display, $event_location, $event_type,
    $event_category, $minPrice, $maxPrice);
$totRows = $events->searchEventsQueryBuilder(null, null,
     $event_location, $event_type,
    $category, $minPrice, $maxPrice);

$rowCount = count($totRows);

if (isset($_GET['p'])) {
    $pages = trim($_GET['p']);
} else {
    if ($rowCount > $display) {
        $pages = (int) ceil($rowCount / $display);
    } else {
        $pages = 1;
    }
}

                    
                    
                    
                    
if (!empty($dataRows)) {
    if ($display > count($dataRows))
    {
        $display = 1;
    }
    for ($i = 0; $i < $display; $i++) {
        $image = $dataRows[$i]->image;
        $image = '<img src="data:image/jpg;base64,' . base64_encode($image) . '" width="200px"/>';
        echo '<tr>
        <td>' . $image . '</td>
        <td>' . $dataRows[$i]->types . ' </td>
        <td>' . $dataRows[$i]->category . '</td>
        <td>' . $dataRows[$i]->location . '</td>
        <td>' . $dataRows[$i]->daily_rental_price . '</td>
        <td><a href="reserve.php?id=' . $dataRows[$i]->id . '">Book Now</a></td>
        </tr>';
    }
    if ($pages > 1) {
        echo '<br /><ul class="pagination">';
        $currentPage = ($start / $display) + 1;
        // Create previous button if not on first page
        if ($currentPage != 1) {
            echo '<li><a href="search.php?s=' . ($start - $display) .
                '&p=' . $pages . '">&laquo;</a></li>';
        }
        // Create page links except on current page
        for ($i = 1; $i <= $pages; $i++) {
            if ($i != $currentPage) {
                echo '<li><a href="search.php?s=' . ($display * ($i - 1)) .
                    '&p=' . $pages . '">&nbsp' . $i . '&nbsp</a></li>';
            }
        }
        // Create next button if not on last page
        if ($currentPage != $pages) {
            echo '<li><a href="search.php?s=' . ($start + $display) . '&p=' . $pages .
                '">&raquo;</a></li>';
        }
        echo '</ul>';
    }
} else {
    echo '<p class="error">No Event Hall matching your search options found.</p>';
}
?>
                </tbody>
            </table>
        </div>
      </center>
        
        
        



    
    </body>
</html>
