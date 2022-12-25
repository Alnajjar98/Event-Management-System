<!DOCTYPE html>
<?php
include_once 'models/Events.php';
echo '<pre>';
print_r($_POST);
print_r($_GET);
echo '</pre>';

if (isset($_POST['event_id'])) {
    $event_id = trim($_POST['event_id']);
}
if (isset($_GET['event_id'])) {
    $event_id = trim($_GET['event_id']);
}
if (!empty($_POST['services'])) {
    $services = $_POST['services'];
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Reservation Details</title>
        <link rel="stylesheet" href="css/table.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- bootstrap-datepicker -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
        <!-- bootstrap-datepicker-js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

    </head>
    <body>
        <?php
include_once 'Header.php';

if (isset($_POST['submitted'])) {
    if (!empty($_POST['event_id']) && !empty($_POST['startDate']) && !empty($_POST['endDate'])) {
        $event = trim($_POST['event_id']);
        $start = trim($_POST['startDate']);
        $end = trim($_POST['endDate']);

        $events = new Events();
        $doubleBooked = $events->checkDoubleBooking($event, $start, $end);

        if ($doubleBooked === true) {
            echo '<p class="error">This event hall is not available within the specified dates. Please change dates or choose a different event hall.</p>';
        } else { // Pass all data to checkout page
            if (!empty($_POST['servicesList']))
            {
                $servicesList = $_POST['servicesList'];
            }
            if (isset($_POST['firstName'])) {
                $firstName = trim($_POST['firstName']);
            }
            if (isset($_POST['middleName'])) {
                $middleName = trim($_POST['middleName']);
            }
            if (isset($_POST['lastName'])) {
                $lastName = trim($_POST['lastName']);
            }
            if (isset($_POST['nationality'])) {
                $nationality = trim($_POST['nationality']);
            }
            if (isset($_POST['cpr'])) {
                $cpr = trim($_POST['cpr']);
            }
            if (isset($_POST['phone'])) {
                $phone = trim($_POST['phone']);
            }
            if (isset($_POST['address'])) {
                $address = trim($_POST['address']);
            }

            ?>
            <form action="checkout.php" method="POST" id="toCheckout">
                <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
                <input type="hidden" name="startDate" value="<?php echo $start; ?>">
                <input type="hidden" name="endDate" value="<?php echo $end; ?>">
                <?php
                if (!empty($servicesList)) {
                    for ($i = 0; $i < count($servicesList); $i++) {
                        echo '<input type="hidden" name="servicesList[]" value="' . $servicesList[$i] . '" />';
                    }
                }
                ?>
            </form>
            <?php
        }
    }
}
?>
    <center>
        <div id="aboutsidebar" class="overflow">
            <h1>Reservation Details</h1>
            <form action="customerinfo.php" method="POST">
                <fieldset>
                    <legend>Reservation Dates:</legend>
                    <div class="row">
                        <div class="column">
                            <label for="startDate">Start Date*:</label>
                            <input type="date" name="startDate" id="startDate" value="<?php echo date('Y-m-d'); ?>" onchange="updateValue(this.value)" id="startDate" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" required>
                        </div>
                        <div class="column">
                            <label for="endDate">End Date*:</label>
                            <input type="date" name="endDate" id="endDate" value="<?php echo date('Y-m-d'); ?>" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" required>
                        </div>
                    </div>
                </fieldset>
                <!-- <fieldset>
                    <legend>Customer Info:</legend>
                    <div class="row">
                        <div class="column">
                            <label for="firstName">First Name*:</label>
                            <input type="text" name="firstName" id="firstName" placeholder="Your first name" required>
                        </div>
                        <div class="column">
                            <label for="middleName">Middle Name*:</label>
                            <input type="text" name="middleName" id="middleName" placeholder="Your middle name" required>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="column">
                            <label for="lastName">Last Name*:</label>
                            <input type="text" name="lastName" id="lastName" placeholder="Your last name" required>
                        </div>
                        <div class="column">
                            <label for="nationality">Nationality*:</label>
                            <select name="nationality" id="nationality" required>
                                <option>select country</option>
                                <option value="AF">Afghanistan</option>
                                <option value="AX">Aland Islands</option>
                                <option value="AL">Albania</option>
                                <option value="DZ">Algeria</option>
                                <option value="AS">American Samoa</option>
                                <option value="AD">Andorra</option>
                                <option value="AO">Angola</option>
                                <option value="AI">Anguilla</option>
                                <option value="AQ">Antarctica</option>
                                <option value="AG">Antigua and Barbuda</option>
                                <option value="AR">Argentina</option>
                                <option value="AM">Armenia</option>
                                <option value="AW">Aruba</option>
                                <option value="AU">Australia</option>
                                <option value="AT">Austria</option>
                                <option value="AZ">Azerbaijan</option>
                                <option value="BS">Bahamas</option>
                                <option value="BH">Bahrain</option>
                                <option value="BD">Bangladesh</option>
                                <option value="BB">Barbados</option>
                                <option value="BY">Belarus</option>
                                <option value="BE">Belgium</option>
                                <option value="BZ">Belize</option>
                                <option value="BJ">Benin</option>
                                <option value="BM">Bermuda</option>
                                <option value="BT">Bhutan</option>
                                <option value="BO">Bolivia</option>
                                <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                                <option value="BA">Bosnia and Herzegovina</option>
                                <option value="BW">Botswana</option>
                                <option value="BV">Bouvet Island</option>
                                <option value="BR">Brazil</option>
                                <option value="IO">British Indian Ocean Territory</option>
                                <option value="BN">Brunei Darussalam</option>
                                <option value="BG">Bulgaria</option>
                                <option value="BF">Burkina Faso</option>
                                <option value="BI">Burundi</option>
                                <option value="KH">Cambodia</option>
                                <option value="CM">Cameroon</option>
                                <option value="CA">Canada</option>
                                <option value="CV">Cape Verde</option>
                                <option value="KY">Cayman Islands</option>
                                <option value="CF">Central African Republic</option>
                                <option value="TD">Chad</option>
                                <option value="CL">Chile</option>
                                <option value="CN">China</option>
                                <option value="CX">Christmas Island</option>
                                <option value="CC">Cocos (Keeling) Islands</option>
                                <option value="CO">Colombia</option>
                                <option value="KM">Comoros</option>
                                <option value="CG">Congo</option>
                                <option value="CD">Congo, Democratic Republic of the Congo</option>
                                <option value="CK">Cook Islands</option>
                                <option value="CR">Costa Rica</option>
                                <option value="CI">Cote D'Ivoire</option>
                                <option value="HR">Croatia</option>
                                <option value="CU">Cuba</option>
                                <option value="CW">Curacao</option>
                                <option value="CY">Cyprus</option>
                                <option value="CZ">Czech Republic</option>
                                <option value="DK">Denmark</option>
                                <option value="DJ">Djibouti</option>
                                <option value="DM">Dominica</option>
                                <option value="DO">Dominican Republic</option>
                                <option value="EC">Ecuador</option>
                                <option value="EG">Egypt</option>
                                <option value="SV">El Salvador</option>
                                <option value="GQ">Equatorial Guinea</option>
                                <option value="ER">Eritrea</option>
                                <option value="EE">Estonia</option>
                                <option value="ET">Ethiopia</option>
                                <option value="FK">Falkland Islands (Malvinas)</option>
                                <option value="FO">Faroe Islands</option>
                                <option value="FJ">Fiji</option>
                                <option value="FI">Finland</option>
                                <option value="FR">France</option>
                                <option value="GF">French Guiana</option>
                                <option value="PF">French Polynesia</option>
                                <option value="TF">French Southern Territories</option>
                                <option value="GA">Gabon</option>
                                <option value="GM">Gambia</option>
                                <option value="GE">Georgia</option>
                                <option value="DE">Germany</option>
                                <option value="GH">Ghana</option>
                                <option value="GI">Gibraltar</option>
                                <option value="GR">Greece</option>
                                <option value="GL">Greenland</option>
                                <option value="GD">Grenada</option>
                                <option value="GP">Guadeloupe</option>
                                <option value="GU">Guam</option>
                                <option value="GT">Guatemala</option>
                                <option value="GG">Guernsey</option>
                                <option value="GN">Guinea</option>
                                <option value="GW">Guinea-Bissau</option>
                                <option value="GY">Guyana</option>
                                <option value="HT">Haiti</option>
                                <option value="HM">Heard Island and Mcdonald Islands</option>
                                <option value="VA">Holy See (Vatican City State)</option>
                                <option value="HN">Honduras</option>
                                <option value="HK">Hong Kong</option>
                                <option value="HU">Hungary</option>
                                <option value="IS">Iceland</option>
                                <option value="IN">India</option>
                                <option value="ID">Indonesia</option>
                                <option value="IR">Iran, Islamic Republic of</option>
                                <option value="IQ">Iraq</option>
                                <option value="IE">Ireland</option>
                                <option value="IM">Isle of Man</option>
                                <option value="IL">Israel</option>
                                <option value="IT">Italy</option>
                                <option value="JM">Jamaica</option>
                                <option value="JP">Japan</option>
                                <option value="JE">Jersey</option>
                                <option value="JO">Jordan</option>
                                <option value="KZ">Kazakhstan</option>
                                <option value="KE">Kenya</option>
                                <option value="KI">Kiribati</option>
                                <option value="KP">Korea, Democratic People's Republic of</option>
                                <option value="KR">Korea, Republic of</option>
                                <option value="XK">Kosovo</option>
                                <option value="KW">Kuwait</option>
                                <option value="KG">Kyrgyzstan</option>
                                <option value="LA">Lao People's Democratic Republic</option>
                                <option value="LV">Latvia</option>
                                <option value="LB">Lebanon</option>
                                <option value="LS">Lesotho</option>
                                <option value="LR">Liberia</option>
                                <option value="LY">Libyan Arab Jamahiriya</option>
                                <option value="LI">Liechtenstein</option>
                                <option value="LT">Lithuania</option>
                                <option value="LU">Luxembourg</option>
                                <option value="MO">Macao</option>
                                <option value="MK">Macedonia, the Former Yugoslav Republic of</option>
                                <option value="MG">Madagascar</option>
                                <option value="MW">Malawi</option>
                                <option value="MY">Malaysia</option>
                                <option value="MV">Maldives</option>
                                <option value="ML">Mali</option>
                                <option value="MT">Malta</option>
                                <option value="MH">Marshall Islands</option>
                                <option value="MQ">Martinique</option>
                                <option value="MR">Mauritania</option>
                                <option value="MU">Mauritius</option>
                                <option value="YT">Mayotte</option>
                                <option value="MX">Mexico</option>
                                <option value="FM">Micronesia, Federated States of</option>
                                <option value="MD">Moldova, Republic of</option>
                                <option value="MC">Monaco</option>
                                <option value="MN">Mongolia</option>
                                <option value="ME">Montenegro</option>
                                <option value="MS">Montserrat</option>
                                <option value="MA">Morocco</option>
                                <option value="MZ">Mozambique</option>
                                <option value="MM">Myanmar</option>
                                <option value="NA">Namibia</option>
                                <option value="NR">Nauru</option>
                                <option value="NP">Nepal</option>
                                <option value="NL">Netherlands</option>
                                <option value="AN">Netherlands Antilles</option>
                                <option value="NC">New Caledonia</option>
                                <option value="NZ">New Zealand</option>
                                <option value="NI">Nicaragua</option>
                                <option value="NE">Niger</option>
                                <option value="NG">Nigeria</option>
                                <option value="NU">Niue</option>
                                <option value="NF">Norfolk Island</option>
                                <option value="MP">Northern Mariana Islands</option>
                                <option value="NO">Norway</option>
                                <option value="OM">Oman</option>
                                <option value="PK">Pakistan</option>
                                <option value="PW">Palau</option>
                                <option value="PS">Palestinian Territory, Occupied</option>
                                <option value="PA">Panama</option>
                                <option value="PG">Papua New Guinea</option>
                                <option value="PY">Paraguay</option>
                                <option value="PE">Peru</option>
                                <option value="PH">Philippines</option>
                                <option value="PN">Pitcairn</option>
                                <option value="PL">Poland</option>
                                <option value="PT">Portugal</option>
                                <option value="PR">Puerto Rico</option>
                                <option value="QA">Qatar</option>
                                <option value="RE">Reunion</option>
                                <option value="RO">Romania</option>
                                <option value="RU">Russian Federation</option>
                                <option value="RW">Rwanda</option>
                                <option value="BL">Saint Barthelemy</option>
                                <option value="SH">Saint Helena</option>
                                <option value="KN">Saint Kitts and Nevis</option>
                                <option value="LC">Saint Lucia</option>
                                <option value="MF">Saint Martin</option>
                                <option value="PM">Saint Pierre and Miquelon</option>
                                <option value="VC">Saint Vincent and the Grenadines</option>
                                <option value="WS">Samoa</option>
                                <option value="SM">San Marino</option>
                                <option value="ST">Sao Tome and Principe</option>
                                <option value="SA">Saudi Arabia</option>
                                <option value="SN">Senegal</option>
                                <option value="RS">Serbia</option>
                                <option value="CS">Serbia and Montenegro</option>
                                <option value="SC">Seychelles</option>
                                <option value="SL">Sierra Leone</option>
                                <option value="SG">Singapore</option>
                                <option value="SX">Sint Maarten</option>
                                <option value="SK">Slovakia</option>
                                <option value="SI">Slovenia</option>
                                <option value="SB">Solomon Islands</option>
                                <option value="SO">Somalia</option>
                                <option value="ZA">South Africa</option>
                                <option value="GS">South Georgia and the South Sandwich Islands</option>
                                <option value="SS">South Sudan</option>
                                <option value="ES">Spain</option>
                                <option value="LK">Sri Lanka</option>
                                <option value="SD">Sudan</option>
                                <option value="SR">Suriname</option>
                                <option value="SJ">Svalbard and Jan Mayen</option>
                                <option value="SZ">Swaziland</option>
                                <option value="SE">Sweden</option>
                                <option value="CH">Switzerland</option>
                                <option value="SY">Syrian Arab Republic</option>
                                <option value="TW">Taiwan, Province of China</option>
                                <option value="TJ">Tajikistan</option>
                                <option value="TZ">Tanzania, United Republic of</option>
                                <option value="TH">Thailand</option>
                                <option value="TL">Timor-Leste</option>
                                <option value="TG">Togo</option>
                                <option value="TK">Tokelau</option>
                                <option value="TO">Tonga</option>
                                <option value="TT">Trinidad and Tobago</option>
                                <option value="TN">Tunisia</option>
                                <option value="TR">Turkey</option>
                                <option value="TM">Turkmenistan</option>
                                <option value="TC">Turks and Caicos Islands</option>
                                <option value="TV">Tuvalu</option>
                                <option value="UG">Uganda</option>
                                <option value="UA">Ukraine</option>
                                <option value="AE">United Arab Emirates</option>
                                <option value="GB">United Kingdom</option>
                                <option value="US">United States</option>
                                <option value="UM">United States Minor Outlying Islands</option>
                                <option value="UY">Uruguay</option>
                                <option value="UZ">Uzbekistan</option>
                                <option value="VU">Vanuatu</option>
                                <option value="VE">Venezuela</option>
                                <option value="VN">Viet Nam</option>
                                <option value="VG">Virgin Islands, British</option>
                                <option value="VI">Virgin Islands, U.s.</option>
                                <option value="WF">Wallis and Futuna</option>
                                <option value="EH">Western Sahara</option>
                                <option value="YE">Yemen</option>
                                <option value="ZM">Zambia</option>
                                <option value="ZW">Zimbabwe</option>
                            </select> 
                        </div>
                    </div>
                    <br><br>
                    <div class="row">
                        <div class="column">
                            <label for="cpr">CPR Number*:</label>
                            <input type="text" name="cpr" id="cpr" placeholder="National Identity number" required>
                        </div>
                        <div class="column">
                            <label for="phone">Phone/Mobile Number*:</label>
                            <input type="tel" name="phone" id="phone" placeholder="Your phone number" required>
                        </div>
                    </div>
                    <br><br>
                    <div class="row">
                        <div class="column left">
                            <label for="address">Billing Address*:</label>
                            <textarea name="address" id="address" cols="50" rows="1" placeholder="BLD No - Road No - Block No - City, Country" required></textarea>
                        </div>
                    </div>
                </fieldset> -->
                <br>
                <button onclick="location.href='index.php'" type="button">Cancel Reservation</button>
                &nbsp&nbsp&nbsp&nbsp
                <button type="submit" value="continue">Proceed with Reservation</button>
                <input type="hidden" name="submitted" value="1" />
                <input type="hidden" name="event_id" value="<?php echo $event_id; ?>" required>
                <?php
                if (!empty($services)) {
                    for ($i = 0; $i < count($services); $i++) {
                        echo '<input type="hidden" name="servicesList[]" value="' . $services[$i] . '" />';
                    }
                }
                ?>
            </form>
            <br />
        </div>
      </center>
    </body>
<!-- DATES -->
<script type="text/javascript">
    let date = new Date();

    function addMonthsToDate(input, noOfMonths) {
        input.setMonth(input.getMonth() + noOfMonths);
        return input.toISOString().substr(0,10);
    }
    // Default value today
    let today = date.toISOString().substr(0,10);

    function updateValue(startDate) {
        // Default endDate value is start date value
        today = startDate;
        let endDate = document.getElementById("endDate").getAttribute('value');
        if (today > endDate)
            {
                document.getElementById("endDate").value = today;
                document.getElementById("endDate").setAttribute("min", today);
                // Maximum selectable end date is six months from today
                document.getElementById("endDate").setAttribute("max", max);
            }
        return today;
    }
    document.getElementById("startDate").value = today;

    // Minimum selectable start day today
    document.getElementById("startDate").setAttribute("min", today);

    // Maximum selectable day 6 months from today
    let max = addMonthsToDate(date, 6);
    document.getElementById("startDate").setAttribute("max", max);

    let startDate = document.getElementById("startDate").value;

    document.getElementById("endDate").value = today;

    // Minimum selectable end date is start date value
    document.getElementById("endDate").setAttribute("min", today);
    // Maximum selectable end date is six months from today
    document.getElementById("endDate").setAttribute("max", max);
</script>
<script type="text/javascript">
    if (toCheckout)
    {
        document.forms["toCheckout"].submit();
    }
</script>
</html>