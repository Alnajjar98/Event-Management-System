<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Search Event Hall</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
<?php 
require_once 'AdminHeader.php';
include_once 'Dropdownfunctions.php';
?>

   
    
   
    

    
<div id="sidebar">
    

    
 
    
    <center>
        <h1>Admin Booking Search</h1>
        <p>Search available Event Hall based on your booking dates and other options.</p>
    </center>
    <form action="search.php" method="POST">
        
        <fieldset>
            <label for="event_location">Location: </label>
            <select id="event_location" name="location">
            <option value="0">Any</option>
<?php
include_once 'models/Location.php';
$location = new Location();
$locationList = $location->listAll();

if (!empty($locationList)) {
    for ($i = 0; $i < count($locationList); $i++) {
        echo '<option value="' . $locationList[$i]->id . '">' . $locationList[$i]->location. '</option>';
    }
} else {
    echo '<p class="error"> There was an error.</p>';
}
?>
            
            </select> <!-- END location -->
            
            
            &nbsp&nbsp&nbsp&nbsp
            <label for="category">event Category: </label>
            <select id="category" name="category">
                <option value="0">Any</option>
<?php
include_once 'models/Categories.php';
$categories = new Categories();
$categoriesList = $categories->listAll();


if (!empty($categoriesList)) {
    for ($i = 0; $i < count($categoriesList); $i++) {
        echo '<option value="' . $categoriesList[$i]->id . '">' . $categoriesList[$i]->category . '</option>';
    }
} else {
    echo '<p class="error">There was an error with categories.</p>';
}
?>
            </select> <!-- END CATEGORIES -->
        </fieldset>
        <fieldset>
            <label for="types">event type: </label>
            <select name="types" id="types">
                <option value="0">Any</option>
<?php

include_once 'models/Types.php';
$types = new Types();
$typeList = $types->listAll();


if (!empty($typeList)) {
    for ($i = 0; $i < count($typeList); $i++) {
        echo '<option value="' . $typeList[$i]->id . '">' . $typeList[$i]->types . '</option>';
    }
} else {
    echo '<p class="error">There was an error with models.</p>';
}
?>
                
            </select>
            
                <?php

include_once 'models/Events.php';
$events = new events();
$minPrice = $events->minPrice();
$maxPrice = $events->maxPrice(); 
?>
            
            
 
        </fieldset>
        <fieldset>
            <label for="minPrice">Min Daily Price:</label>
            <input type="range" name="minPrice" id="minPrice" value="<?php echo $minPrice; ?>" min="<?php echo $minPrice; ?>" max="<?php echo $maxPrice; ?>" oninput="range_min_disp.value = minPrice.value" onchange="document.getElementById('maxPrice').min=document.getElementById('minPrice').value;">
            <output  id="range_min_disp"><?php echo $minPrice; ?></output>
        </fieldset>
        <fieldset>
            <label for="maxPrice">Max Daily Price:</label>
            <input type="range" name="maxPrice" id="maxPrice" value="<?php echo $minPrice; ?>" min="<?php echo $minPrice; ?>" max="<?php echo $maxPrice; ?>" oninput="range_max_display.value = maxPrice.value">
            <output for="maxPrice" id="range_max_display"></output>
        </fieldset>
        <center>
            <input type ="submit" class ="button SubButton" value ="Search" />
            <input type="hidden" name="submitted" value="1" />
        </center>
    </form>

    


</div>
    <!-- END SIDEBAR -->

</html>