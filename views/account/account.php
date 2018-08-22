<div class="mid-content">
  <div class="edit-details-wrapper">
    <div class="category">
      <a class="selected" href="http://192.168.64.2/mvclearn/account/edit/1" id="profile_picture">profile picture
      </a><a href="http://192.168.64.2/mvclearn/account/edit/2" id="public_details">public details
      </a><a href="http://192.168.64.2/mvclearn/account/edit/3" id="private_details">private details</a>
    </div>
    <?php if ($this->data['page'] == 1):?>
    <div class="edit-details">
      <h1>Set profile picture</h1>
      <canvas width="300" height="300" id="img-preview">
      </canvas>
      <div class="settings">
        <p>Click "upload" to upload an image</p>
        <form id="upload-form" enctype="multipart/form-data" method="POST">
          <input type="file" id="file-select" name="file-select"/>
          <input type="button" id="upload-button" value="Upload Image"/>
          <!-- <progress id="progressBar" value="0" max="100"></progress> -->
          <h3 id="status"></h3>
          <p id="loaded_n_total"></p>
        </form>
        <p id="test-debug"></p>
        <button id="zoom-in">+</button>
        <button id="zoom-out">-</button>
        <button id="submit-prof">Save Changes</button>
      </div>
      <div class="info-help">
        <p>Please ensure your image is .png or .jpg and it's at least 2MB in size.</p>
        <p>Please, click on the "Choose File" button to upload an image and then "Upload Image" to upload the image you chose. If you need to trim the image you added, then you may click on the "+" button to zoom in, or the "-" button to zoom out. Dont forget that you can drag the image to positiion you are happy with by holding down the left click on the image and moving your mouse. Once you are happy with the result, click on the "Ok" button.</p>
      </div>
    </div>
    <?php elseif ($this->data['page'] == 2):?>
    <div class="edit-details">
      <h1>Public Details</h1>
      <p>These information will be visible for every user who sees your profile</p>
      <form action="http://192.168.64.2/mvclearn/account/save/2" id="public-info-form" method="POST">
        <p>First name</p>
        <input type="text" id="first_name" name="firstname" value="<?=Session::user_data("firstname");?>" autocomplete='given-name'/></br>
        <p>Middle name</p>
        <input type="text" id="middle_name" name="middlename" value="<?=Session::user_data("middlename");?>" autocomplete='additional-name'/></br>
        <p>Last name</p>
        <input type="text" id="last_name" name="lastname" value="<?=Session::user_data("lastname");?>" autocomplete='family-name'/></br>
        <p>Username</p>
        <input type="text" id="update-username" name="username" value="<?=Session::user_data("username");?>"/></br>
        <p>Gender</p>
        <select id="gender" name="gender" autocomplete='country-name'>
          <option class="blank" value=""></option>
          <?php
            $genders = array("Male","Female","Transgender","Other","uknown");
            $gender = Session::user_data("gender");
            for($i = 0; $i<count($genders); $i++){
              if($gender == $genders[$i]){
                echo '<option value="'.$genders[$i].'" selected>'.$genders[$i].'</option>';
              }
              else{
                if($genders[$i] == 'uknown'){
                  echo '<option value="'.$genders[$i].'">Prefer not to say</option>';
                }
                else{
                  echo '<option value="'.$genders[$i].'">'.$genders[$i].'</option>';
                }
              }
            }
          ?>
        </select></br>
        <p>Birthday</p>
        <p>Day</p>
        <select id="birthDate_day" name="birthDate_day" autocomplete='organization'>
          <option class="blank" value=""></option>
          <?php
            $days = array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31");
            $birthday = Session::user_data("birthday");
            $day = substr($birthday, 8, 2);
            for($i = 0; $i<count($days); $i++){
              if($day == $days[$i]){
                echo '<option value="'.$days[$i].'" selected>'.$days[$i].'</option>';
              }
              else{
                echo '<option value="'.$days[$i].'">'.$days[$i].'</option>';
              }
            }
          ?>
        </select>
        <p>Month</p>
        <select id="birthDate_month" name="birthDate_month">
          <option class="blank" value=""></option>
          <?php
            $months = array("1","2","3","4","5","6","7","8","9","10","11","12");
            $birthday = Session::user_data("birthday");
            $month = substr($birthday, 5, 2);
            for($i = 0; $i<count($months); $i++){
              if($month == $months[$i]){
                echo '<option value="'.$months[$i].'" selected>'.$months[$i].'</option>';
              }
              else{
                echo '<option value="'.$months[$i].'">'.$months[$i].'</option>';
              }
            }
          ?>
        </select>
        <p>Year</p>
        <select id="birthDate_year" name="birthDate_year" autocomplete='organization'>
          <option class="blank" value=""></option>
          <?php
            $years = array("2017","2016","2015","2014","2013","2012","2011","2010","2009","2008","2007","2006","2005","2004","2003","2002","2001","2000","1999","1998","1997","1996","1995","1994","1993","1992","1991","1990","1989","1988","1987","1986","1985","1984","1983","1982","1981","1980","1979","1978","1977","1976","1975","1974","1973","1972","1971","1970","1969","1968","1967","1966","1965","1964","1963","1962","1961","1960","1959","1958","1957","1956","1955","1954","1953","1952","1951","1950","1949","1948","1947","1946","1945","1944","1943","1942","1941","1940","1939","1938","1937","1936","1935","1934","1933","1932","1931","1930","1929","1928","1927","1926","1925","1924","1923","1922","1921","1920","1919","1918","1917","1916","1915","1914","1913","1912","1911","1910","1909","1908","1907","1906","1905","1904","1903","1902","1901","1900","1899","1898","1897","1896","1895","1894","1893","1892","1891","1890","1889","1888","1887","1886","1885","1884","1883","1882","1881","1880","1879","1878","1877","1876","1875","1874","1873","1872","1871","1870","1869","1868","1867","1866","1865","1864","1863","1862","1861","1860","1859","1858","1857","1856","1855","1854","1853","1852","1851");
            $birthday = Session::user_data("birthday");
            $year = substr($birthday, 0, 4);
            //echo $year;
            for($i = 0; $i<count($years); $i++){
              if($year == $years[$i]){
                echo '<option value="'.$years[$i].'" selected>'.$years[$i].'</option>';
              }
              else{
                echo '<option value="'.$years[$i].'">'.$years[$i].'</option>';
              }
            }
          ?>
        </select>
        <p>country</p>
        <select id="country" name="country" data-test-id="country" autocomplete='country-name'>
          <option class="blank" value=""></option>
          <?php
            $countries = array("None","Afghanistan","Albania","Algeria","American Samoa","Andorra","Angola","Anguilla","Antarctica","Antigua, Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia-Herzegovina","Botswana","Brazil","British Indian Ocean Territory","British Virgin Islands","Brunei","Bulgaria","Burkina Faso","Burma","Burundi","Cambodia","Cameroon","Canada","Canary Islands","Cape Verde","Cayman Islands","Central Africa","Chad","Chile","China","Christmas Island","Cocos Island","Colombia","Comoros","Congo","Cook Islands","Costa Rica","Croatia","Cuba","Cyprus","Czech Republic","Democratic Republic of Congo","Denmark","Djibouti","Dominica","Dominican Republic","East Timor","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","FYRO Macedonia","Falkland Islands","Faroe Islands","Fiji","Finland","France","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guadeloupe","Guam","Guatemala","Guinea","Guinea","-Bissau","Guyana","Haiti","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Israel","Italy","Ivory Coast","Jamaica","Japan","Jordan","Kazachstan","Kenya","Kiribati","Kosovo","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Martinique","Mauritania","Mauritius","Mayotte","Mexico","Micronesia","Moldova","Monaco","Mongolia","Montserrat","Morocco","Mozambique","Namibia","Nauru","Nepal","Netherlands","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","Niue","Norfolk Island","North Korea","Norway","Oman","Pakistan","Palau","Palestine National Authority","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Pitcairn Islands","Poland","Polynesia","Portugal","Puerto Rico","Qatar","Reunion","Romania","Russia","Rwanda","Saint Kitts and Nevis","Saint Lucia","Saint Vincent and the Grenadines","Samoa","San Marino","San Serriffe","Sao Tome","Saudi Arabia","Senegal","Serbia and Montenegro","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Korea","Spain","Sri Lanka","St. Helena","South Sudan","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Tadjikistan","Taiwan","Tanzania","Thailand","Togo","Tokelau","Tonga","Trinidad and Tobago","Tunisia","Turkey","Turkmenistan","Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom","USA","Uruguay","Uzbekistan","Vanuatu","Vatican City State","Venezuela","Vietnam","Virgin Islands, British","Virgin Islands, US","Western Sahara","Yemen","Yugoslavia","Zambia");
            $selectedCountry = Session::user_data("country");
            for($i = 0; $i<count($countries); $i++){
              if($selectedCountry == $countries[$i]){
                echo '<option value="'.$countries[$i].'" selected>'.$countries[$i].'</option>';
              }
              else{
                echo '<option value="'.$countries[$i].'">'.$countries[$i].'</option>';
              }
            }
          ?>
        </select>
        <p>About Me</p>
        <input type="text" id="about_me" name="about_me" value="<?=Session::user_data("about_me");?>"/></br>
        <p>My Interests</p>
        <input type="text" id="interests" name="interests" value="<?=Session::user_data("interests");?>"/></br>
        <p>My website</p>
        <input type="text" id="main_website" name="main_website" value="<?=Session::user_data("main_website");?>" autocomplete='address-line2'/></br>
        <p>Role</p>
        <input readonly type="text" id="member-type" name="memberType" value="<?=Session::user_data("role");?>"/>
        <p>You cannot change this detail. Only <?=WEBSITE_NAME;?> can change this depending on whether you have a job placement on <?=WEBSITE_NAME;?></p>
        <input type="submit" id="save-changes-2" name="save_changes-2" value="Save Changes"/>
      </form>
    </div>
    <?php elseif ($this->data['page'] == 3):?>
      <div class="step-cont">
        <h1>Private Details</h1>
        <p>These information will only be visible to you and the (website name)</p>
        <form action="http://192.168.64.2/mvclearn/profile_setup/save_details/3" id="public-info-form" method="POST">
          <p>Personal Information</p>
          <p>Title</p>
          <select id="title" name="title">
            <option class="blank" value=""></option>
            <?php
              $titles = array("Mr","Mrs","Ms","Mx","Miss","Dr","Prof","Rev");
              $title = Session::user_data("title");
              for($i = 0; $i<count($titles); $i++){
                if($title == $titles[$i]){
                  echo '<option value="'.$titles[$i].'" selected>'.$titles[$i].'</option>';
                }
                else{
                  echo '<option value="'.$titles[$i].'">'.$titles[$i].'</option>';
                }
              }
            ?>
            </select></br>
          <p>email</p>
          <input type="text" id="email" name="email" value="<?Session::user_data("email");?>"/></br>
          <p class="confirm-status">
            <?php
              if(Session::user_data("confirmed") == 0){
                echo "Email is not confirmed. You cannot post comments if your email is not confirmed. <a class='resend-validation-email'>Re-send validation email</a>.";
              }
            ?>
          </p>
          <p>Change Password</p>
          <p>Enter your current password</p>
          <input type="password" id="cur_password" name="cur_password" value=""/></br>
          <p>Enter your new password</p>
          <input type="password" id="new_password" name="new_password" value=""/></br>
          <p>Re-enter your new password</p>
          <input type="password" id="new_conf_password" name="new_conf_password" value=""/></br>
          <p>Phone</p>
          <p>Country Code</p>
          <select id="telephoneNumber_countryCode" name="telephoneNumber_countryCode" data-test-id="telephone-number-country-code" class="select--telephone-number-country-code">
            <option class="blank" value=""></option>
            <?php
              $CCodes = array("+1","+7","+20","+27","+30","+31","+32","+33","+34","+36","+39","+40","+41","+43","+44","+45","+46","+47","+48","+49","+51","+52","+53","+54","+55","+56","+57","+58","+60","+61","+62","+63","+64","+65","+66","+81","+82","+84","+86","+90","+91","+92","+93","+94","+95","+98","+211","+212","+213","+216","+218","+220","+221","+222","+223","+224","+225","+226","+227","+228","+229","+230","+231","+232","+233","+234","+235","+236","+237","+238","+239","+240","+241","+242","+243","+244","+245","+246","+247","+248","+249","+250","+251","+252","+253","+254","+255","+256","+257","+258","+260","+261","+262","+263","+264","+265","+266","+267","+268","+269","+290","+291","+297","+298","+299","+350","+351","+352","+353","+354","+355","+356","+357","+358","+359","+370","+371","+372","+373","+374","+375","+376","+377","+378","+380","+381","+382","+385","+386","+387","+389","+420","+421","+423","+500","+501","+502","+503","+504","+505","+506","+507","+508","+509","+590","+591","+592","+593","+594","+595","+596","+597","+598","+599","+670","+672","+673","+674","+675","+676","+677","+678","+679","+680","+681","+682","+683","+685","+686","+687","+688","+689","+690","+691","+692","+800","+808","+850","+852","+853","+855","+856","+870","+878","+880","+881","+882","+883","+886","+888","+960","+961","+962","+963","+964","+965","+966","+967","+968","+970","+971","+972","+973","+974","+975","+976","+977","+979","+992","+993","+994","+995","+996");
              $country_code = Session::user_data("country_telephone_code");
              for($i = 0; $i<count($CCodes); $i++){
                if($country_code == $CCodes[$i]){
                  echo '<option value="'.(int)$CCodes[$i].'" selected>'.$CCodes[$i].'</option>';
                }
                else{
                  echo '<option value="'.(int)$CCodes[$i].'">'.$CCodes[$i].'</option>';
                }
              }
            ?>
          </select></br>
          <p>Number</p>
          <input type="text" id="phone_number" name="phone_number" value="<?=Session::user_data("phone_number");?>"/></br>
          <p>Delivery Information</p>
          <p>Address 1</p>
          <input type="text" id="address_1" name="address_1" value="<?=Session::user_data("address_1");?>"/></br>
          <p>Address 2</p>
          <input type="text" id="address_2" name="address_2" value="<?=Session::user_data("address_2");?>"/></br>
          <p>Town/City</p>
          <input type="text" id="town" name="town" value="<?=Session::user_data("town");?>"/></br>
          <p>State</p>
          <input type="text" id="state" name="state" value="<?=Session::user_data("state");?>"/></br>
          <!-- <p>State</p>
          <input type="text" id="state" name="state" value="<?=Session::user_data("state");?>"/></br> -->
          <p>Postcode/zipcode</p>
          <input type="text" id="postcode" name="postcode" value="<?=Session::user_data("postcode");?>"/></br>
          <input type="submit" id="save_changes-3" name="save-changes-3" value="Save Changes"/>
        </form>
      </div>
      <?php endif; ?>
    </div>
  </div>
</div>
