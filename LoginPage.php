<!DOCTYPE html>

<html>
    <head>
        
         <link rel="stylesheet" type="text/css" href="Stylesheet.css">

        	
       
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        include_once 'Header.php';
        include_once 'Login.php';
        ?>
     
    <center>
        <div id="log">
            
            
                <center><h1>Please Enter Your Login Details </h1></center> 
        <form action="LoginPage.php" method="post" id="content">
        <fieldset>    
            <h4>Email : <input type="email" name="email" value="" />
            <h4>Password : <input type="password" name="Password" value=""/>
        <br><br>
        <input  type="submit" class ="button SubButton" name="submit" value="Login" /> 
            

        
        
         <input type ="hidden" name="submitted" value="1">
                 </fieldset> 
            
            

</form>
        </div>
        </center>
</body>
</html>


<?php
if (isset($_POST['submitted'])) {
    
    require_once('LoginFunctions.php');

     
     $usern = $_POST['email'];
   $pass = $_POST['Password'];
       
    

    
   list($check, $data) = checkLogin($usern, $pass);
   if ($check) {
       
        $_SESSION['email'] =$usern;
        $_SESSION['Id'] = $data['id'];
        $id = $_SESSION['Id'] ;
        
        require_once 'mysqli_connect.php';

     
         
      $db = new Database1();
      $dbc = $db->getConnection();
        
        
      $qq = "SELECT role_id FROM user_roles where user_id = $id ";
      echo "$qq";

      $rr = mysqli_query($dbc, $qq);
                
      if($rr)
      {
           while ($row = mysqli_fetch_array($rr)){
                
                    $role = $row[0];
                    if ($role !=2){
                        $_SESSION["role"] =1;
                  $url = absolute_url('AdminHome.php'); 
                  
        header("Location: $url");
        exit(); 
      }
      else{
          $_SESSION["role"] = 2;
          $url = absolute_url('index.php');  
        header("Location: $url");
        exit(); 
      }
      
          }
      
        }
   }
}

//create a sopace between the button and the error messages
echo'<div class="spacer"></div>';

if (!empty($errors)) {
    echo '<br/> <p class="error">The following errors occurred: <br />';

    //foreach is a simplified version of the 'for' loop
    foreach ($errors as $err) {
        echo "$err <br />";
    }

    echo '</p>';
}