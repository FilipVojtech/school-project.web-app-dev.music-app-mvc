<?php
$email = '';
$password = '';
$displayMessage = false;

if (isset($_POST['email'])) {
    $email = $_POST['email'];
}
if (isset($_POST['password'])) {
    $password = $_POST['password'];
}

$displayMessage = !empty($email) || !empty($password);

$counties = [
    'ie' => array(
        array('name' => 'Carlow', 'code' => 'carlow'),
        array('name' => 'Cavan', 'code' => 'cavan'),
        array('name' => 'Clare', 'code' => 'clare'),
        array('name' => 'Cork', 'code' => 'cork'),
        array('name' => 'Donegal', 'code' => 'donegal'),
        array('name' => 'Dublin', 'code' => 'dublin'),
        array('name' => 'Galway', 'code' => 'galway'),
        array('name' => 'Kerry', 'code' => 'kerry'),
        array('name' => 'Kildare', 'code' => 'kildare'),
        array('name' => 'Kilkenny', 'code' => 'kilkenny'),
        array('name' => 'Laois', 'code' => 'laois'),
        array('name' => 'Leitrim', 'code' => 'leitrim'),
        array('name' => 'Limerick', 'code' => 'limerick'),
        array('name' => 'Longford', 'code' => 'longford'),
        array('name' => 'Louth', 'code' => 'louth'),
        array('name' => 'Mayo', 'code' => 'mayo'),
        array('name' => 'Meath', 'code' => 'meath'),
        array('name' => 'Monaghan', 'code' => 'monaghan'),
        array('name' => 'Offaly', 'code' => 'offaly'),
        array('name' => 'Roscommon', 'code' => 'roscommon'),
        array('name' => 'Sligo', 'code' => 'sligo'),
        array('name' => 'Tipperary', 'code' => 'tipperary'),
        array('name' => 'Waterford', 'code' => 'waterford'),
        array('name' => 'Westmeath', 'code' => 'westmeath'),
        array('name' => 'Wexford', 'code' => 'wexford'),
        array('name' => 'Wicklow', 'code' => 'wicklow')
    ),
    'uk' => array(
        'England' => array(
            array('name' => 'Bedfordshire', 'code' => 'bedfordshire'),
            array('name' => 'Berkshire', 'code' => 'berkshire'),
            array('name' => 'Bristol', 'code' => 'bristol'),
            array('name' => 'Buckinghamshire', 'code' => 'buckinghamshire'),
            array('name' => 'Cambrcodegeshire', 'code' => 'cambrcodegeshire'),
            array('name' => 'Cheshire', 'code' => 'cheshire'),
            array('name' => 'Cornwall', 'code' => 'cornwall'),
            array('name' => 'County Durham', 'code' => 'county_durham'),
            array('name' => 'Cumbria', 'code' => 'cumbria'),
            array('name' => 'Derbyshire', 'code' => 'derbyshire'),
            array('name' => 'Devon', 'code' => 'devon'),
            array('name' => 'Dorset', 'code' => 'dorset'),
            array('name' => 'East Rcodeing of Yorkshire', 'code' => 'east_rcodeing_of_yorkshire'),
            array('name' => 'East Sussex', 'code' => 'east_sussex'),
            array('name' => 'Essex', 'code' => 'essex'),
            array('name' => 'Gloucestershire', 'code' => 'gloucestershire'),
            array('name' => 'Greater London', 'code' => 'greater_london'),
            array('name' => 'Greater Manchester', 'code' => 'greater_manchester'),
            array('name' => 'Hampshire', 'code' => 'hampshire'),
            array('name' => 'Herefordshire', 'code' => 'herefordshire'),
            array('name' => 'Hertfordshire', 'code' => 'hertfordshire'),
            array('name' => 'Isle of Wight', 'code' => 'isle_of_wight'),
            array('name' => 'Kent', 'code' => 'kent'),
            array('name' => 'Lancashire', 'code' => 'lancashire'),
            array('name' => 'Leicestershire', 'code' => 'leicestershire'),
            array('name' => 'Lincolnshire', 'code' => 'lincolnshire'),
            array('name' => 'Merseyscodee', 'code' => 'merseyscodee'),
            array('name' => 'Norfolk', 'code' => 'norfolk'),
            array('name' => 'North Yorkshire', 'code' => 'north_yorkshire'),
            array('name' => 'Northamptonshire', 'code' => 'northamptonshire'),
            array('name' => 'Northumberland', 'code' => 'northumberland'),
            array('name' => 'Nottinghamshire', 'code' => 'nottinghamshire'),
            array('name' => 'Oxfordshire', 'code' => 'oxfordshire'),
            array('name' => 'Rutland', 'code' => 'rutland'),
            array('name' => 'Shropshire', 'code' => 'shropshire'),
            array('name' => 'Somerset', 'code' => 'somerset'),
            array('name' => 'South Yorkshire', 'code' => 'south_yorkshire'),
            array('name' => 'Staffordshire', 'code' => 'staffordshire'),
            array('name' => 'Suffolk', 'code' => 'suffolk'),
            array('name' => 'Surrey', 'code' => 'surrey'),
            array('name' => 'Tyne and Wear', 'code' => 'tyne_and_wear'),
            array('name' => 'Warwickshire', 'code' => 'warwickshire'),
            array('name' => 'West Mcodelands', 'code' => 'west_mcodelands'),
            array('name' => 'West Sussex', 'code' => 'west_sussex'),
            array('name' => 'West Yorkshire', 'code' => 'west_yorkshire'),
            array('name' => 'Wiltshire', 'code' => 'wiltshire'),
            array('name' => 'Worcestershire', 'code' => 'worcestershire'),
        ),
        'Scotland' => array(
            array('name' => 'Aberdeen City', 'code' => 'aberdeen_city'),
            array('name' => 'Aberdeenshire', 'code' => 'aberdeenshire'),
            array('name' => 'Angus', 'code' => 'angus'),
            array('name' => 'Argyll and Bute', 'code' => 'argyll_and_bute'),
            array('name' => 'Clackmannanshire', 'code' => 'clackmannanshire'),
            array('name' => 'Dumfries and Galloway', 'code' => 'dumfries_and_galloway'),
            array('name' => 'Dundee City', 'code' => 'dundee_city'),
            array('name' => 'East Ayrshire', 'code' => 'east_ayrshire'),
            array('name' => 'East Dunbartonshire', 'code' => 'east_dunbartonshire'),
            array('name' => 'East Lothian', 'code' => 'east_lothian'),
            array('name' => 'East Renfrewshire', 'code' => 'east_renfrewshire'),
            array('name' => 'Edinburgh, City of', 'code' => 'edinburgh_city_of'),
            array('name' => 'Falkirk', 'code' => 'falkirk'),
            array('name' => 'Fife', 'code' => 'fife'),
            array('name' => 'Glasgow City', 'code' => 'glasgow_city'),
            array('name' => 'Highland', 'code' => 'highland'),
            array('name' => 'Inverclyde', 'code' => 'inverclyde'),
            array('name' => 'Mcodelothian', 'code' => 'mcodelothian'),
            array('name' => 'Moray', 'code' => 'moray'),
            array('name' => 'Na h-Eileanan Siar (Western Isles)', 'code' => 'na_h_eileanan_siar_western_isles'),
            array('name' => 'North Ayrshire', 'code' => 'north_ayrshire'),
            array('name' => 'North Lanarkshire', 'code' => 'north_lanarkshire'),
            array('name' => 'Orkney Islands', 'code' => 'orkney_islands'),
            array('name' => 'Perth and Kinross', 'code' => 'perth_and_kinross'),
            array('name' => 'Renfrewshire', 'code' => 'renfrewshire'),
            array('name' => 'Scottish Borders', 'code' => 'scottish_borders'),
            array('name' => 'Shetland Islands', 'code' => 'shetland_islands'),
            array('name' => 'South Ayrshire', 'code' => 'south_ayrshire'),
            array('name' => 'South Lanarkshire', 'code' => 'south_lanarkshire'),
            array('name' => 'Stirling', 'code' => 'stirling'),
            array('name' => 'West Dunbartonshire', 'code' => 'west_dunbartonshire'),
            array('name' => 'West Lothian', 'code' => 'west_lothian'),
        ),
        'Wales' => array(
            array('name' => 'Blaenau Gwent', 'code' => 'blaenau_gwent'),
            array('name' => 'Brcodegend', 'code' => 'brcodegend'),
            array('name' => 'Caerphilly', 'code' => 'caerphilly'),
            array('name' => 'Cardiff', 'code' => 'cardiff'),
            array('name' => 'Carmarthenshire', 'code' => 'carmarthenshire'),
            array('name' => 'Ceredigion', 'code' => 'ceredigion'),
            array('name' => 'Conwy', 'code' => 'conwy'),
            array('name' => 'Denbighshire', 'code' => 'denbighshire'),
            array('name' => 'Flintshire', 'code' => 'flintshire'),
            array('name' => 'Gwynedd', 'code' => 'gwynedd'),
            array('name' => 'Isle of Anglesey', 'code' => 'isle_of_anglesey'),
            array('name' => 'Merthyr Tydfil', 'code' => 'merthyr_tydfil'),
            array('name' => 'Monmouthshire', 'code' => 'monmouthshire'),
            array('name' => 'Neath Port Talbot', 'code' => 'neath_port_talbot'),
            array('name' => 'Newport', 'code' => 'newport'),
            array('name' => 'Pembrokeshire', 'code' => 'pembrokeshire'),
            array('name' => 'Powys', 'code' => 'powys'),
            array('name' => 'Rhondda Cynon Taf', 'code' => 'rhondda_cynon_taf'),
            array('name' => 'Swansea', 'code' => 'swansea'),
            array('name' => 'Torfaen', 'code' => 'torfaen'),
            array('name' => 'Vale of Glamorgan', 'code' => 'vale_of_glamorgan'),
            array('name' => 'Wrexham', 'code' => 'wrexham'),
        ),
        'Northern Ireland' => array(
            array('name' => 'Antrim', 'code' => 'antrim'),
            array('name' => 'Armagh', 'code' => 'armagh'),
            array('name' => 'Derry/Londonderry', 'code' => 'derry_londonderry'),
            array('name' => 'Down', 'code' => 'down'),
            array('name' => 'Fermanagh', 'code' => 'fermanagh'),
            array('name' => 'Tyrone', 'code' => 'tyrone'),
        ),
    ),
];

/**
 * @param string $fieldName Name of the input
 * @return string If field is valid, returns nothing if field is invalid returns the BS 'is-invalid' class
 */
function is_invalid(string $fieldName): string
{
    $invalid = [];
    if (isset($_SESSION['invalid']))
        $invalid = $_SESSION['invalid'];
//    $invalid = ['email' => 'Not an email'];

    return in_array($fieldName, array_keys($invalid)) ? 'is-invalid' : '';
}

function get_invalid_message(string $fieldName): string
{
    $message = '';
    if (isset($_SESSION['invalid'][$fieldName])) {
        $message = $_SESSION['invalid'][$fieldName];
        unset($_SESSION['invalid'][$fieldName]);
    }

    return $message;
}

?>

<h1 class="text-center my-5">Register</h1>
<div class="col-12 col-lg-10 mx-auto">
    <!--suppress HtmlUnknownTarget -->
    <form class="container-fluid" action="controller/account.php?action=register" method="post" novalidate>
        <?php if ($displayMessage): ?>
            <div class="alert alert-info d-flex align-items-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" fill="currentColor"
                     class="bi bi-info-circle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" aria-label="Information:">
                    <path
                      d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2" />
                </svg>
                <div class="flex-fill ms-2">
                    <p class="mb-0">To continue with registration we are going to need a bit more information from
                        you.</p>
                </div>
            </div>
        <?php endif; ?>
        <h4>Personal details</h4>
        <div class="row g-md-3">
            <div class="col-12 col-md-6">
                <div class="form-floating mb-3">
                    <input
                      class="form-control <?= is_invalid('firstName') ?>"
                      type="text"
                      name="firstName"
                      id="firstName"
                      placeholder="Name"
                      data-fk-keep="register"
                      required
                    >
                    <label class="form-label" for="firstName">First name</label>
                    <div class="invalid-feedback">
                        <?= get_invalid_message('firstName') ?>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-floating mb-3">
                    <input
                      class="form-control <?= is_invalid('lastName') ?>"
                      type="text"
                      name="lastName"
                      id="lastName"
                      placeholder="Surname"
                      data-fk-keep="register"
                      required
                    >
                    <label class="form-label" for="lastName">Last name</label>
                    <div class="invalid-feedback">
                        <?= get_invalid_message('lastName') ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <input
                      type="email"
                      name="email"
                      id="email"
                      class="form-control <?= is_invalid('email') ?>"
                      placeholder="name@domain.com"
                      value="<?= htmlspecialchars($email, ENT_QUOTES); ?>"
                      data-fk-keep="register"
                      required
                    >
                    <label for="email" class="form-label">Email address</label>
                    <div class="invalid-feedback">
                        <?= get_invalid_message('email') ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <input
                      type="password"
                      name="password"
                      id="password"
                      class="form-control <?= is_invalid('password') ?>"
                      placeholder="Password123*"
                      value="<?= $password; ?>"
                      autocomplete="new-password"
                      required
                    >
                    <label for="password" class="form-label">Password</label>
                    <div class="invalid-feedback">
                        <?= get_invalid_message('password') ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <input
                      type="password"
                      name="passwordRepeat"
                      id="passwordRepeat"
                      class="form-control <?= is_invalid('passwordRepeat') ?>"
                      placeholder="Password123*"
                      autocomplete="repeat-password"
                      required
                    >
                    <label for="passwordRepeat" class="form-label">Repeat password</label>
                    <div class="invalid-feedback">
                        <?= get_invalid_message('passwordRepeat') ?>
                    </div>
                </div>
            </div>
        </div>
        <h4>Address</h4>
        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <input
                      type="text"
                      name="addressLine1"
                      id="addressLine1"
                      placeholder="Address 1"
                      class="form-control <?= is_invalid('addressLine1') ?>"
                      data-fk-keep="register"
                      required
                    >
                    <label for="addressLine1" class="form-label">Address Line 1</label>
                    <div class="invalid-feedback">
                        <?= get_invalid_message('addressLine1') ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <input
                      type="text"
                      name="addressLine2"
                      id="addressLine2"
                      placeholder="Address 2"
                      class="form-control <?= is_invalid('addressLine2') ?>"
                      data-fk-keep="register"
                    >
                    <label for="addressLine2" class="form-label">Address Line 2 <span class="text-body-tertiary">&boxh; Optional</span></label>
                    <div class="invalid-feedback">
                        <?= get_invalid_message('addressLine2') ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <input
                      type="text"
                      name="city"
                      id="city"
                      placeholder="City"
                      class="form-control <?= is_invalid('city') ?>"
                      data-fk-keep="register"
                      required
                    >
                    <label for="city" class="form-label">City</label>
                    <div class="invalid-feedback">
                        <?= get_invalid_message('city') ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-md-3">
            <div class="col">
                <div class="form-floating mb-3">
                    <select
                      class="form-select <?= is_invalid('county') ?>"
                      name="county"
                      id="county"
                      data-fk-keep="register"
                      required
                    ></select>
                    <label for="county">County</label>
                    <div class="invalid-feedback">
                        <?= get_invalid_message('county') ?>
                    </div>
                </div>
            </div>
            <div class="col col-12 col-md-4">
                <div class="form-floating mb-3">
                    <input
                      type="text"
                      name="postalCode"
                      id="postalCode"
                      placeholder="Eircode"
                      class="form-control <?= is_invalid('postalCode') ?>"
                      data-fk-keep="register"
                      required
                    >
                    <label for="postalCode" class="form-label">Éircode/Postcode</label>
                    <div class="invalid-feedback">
                        <?= get_invalid_message('postalCode') ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <select
                      class="form-select <?= is_invalid('country') ?>"
                      id="country"
                      name="country"
                      onchange="changeCounties()"
                      data-fk-keep="register"
                      required
                    >
                        <option value="ie" selected>Republic of Ireland</option>
                        <option value="uk">United Kingdom</option>
                    </select>
                    <label for="country">Country</label>
                    <div class="invalid-feedback">
                        <?= get_invalid_message('country') ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col d-flex justify-content-center">
                <div class="form-check mb-3">
                    <input
                      type="checkbox"
                      name="gdpr"
                      id="gdpr"
                      class="form-check-input <?= is_invalid('gdpr') ?>"
                      required
                    >
                    <label for="gdpr" class="form-check-label">
                        I have read and agree to the <a href="?p=download&docid=1" target="_blank">Privacy policy</a>
                    </label>
                    <div class="invalid-feedback">
                        <?= get_invalid_message('gdpr') ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="mb-3">
                    <input type="submit" value="Register" class="form-control btn btn-primary">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p class="text-center">
                    Already have an account?<br>
                    <a href="?p=login">Login here</a>
                </p>
            </div>
        </div>
    </form>
</div>
<datalist id="ie-counties">
    <option value="" selected disabled></option>
    <?php foreach ($counties['ie'] as $county) {
        // echo "<option value='$county[code]'>$county[name]</option>";
        echo "<option>$county[name]</option>";
    }
    ?>
</datalist>
<datalist id="uk-counties">
    <option value="" selected disabled></option>
    <?php
    foreach ($counties['uk'] as $country => $ukCounties) {
        echo "<optgroup label=\"$country\">";
        foreach ($ukCounties as $county) {
            // echo "<option value='$county[code]'>$county[name]</option>";
            echo "<option>$county[name]</option>";
        }
        echo '</optgroup>';
    }
    ?>
</datalist>

<script>
    const countySelect = document.getElementById("county");
    const countrySelect = document.getElementById("country");

    changeCounties();

    function changeCounties() {
        countySelect.innerHTML = document.getElementById(`${countrySelect.value}-counties`).innerHTML;
    }
</script>
