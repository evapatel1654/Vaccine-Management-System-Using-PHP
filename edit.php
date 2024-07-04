<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "userdb";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql_select = "SELECT * FROM vaccinations WHERE id = $id";
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>

<!DOCTYPE html>
<html>
<head>
    <title>Medical Form</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <style>
        html, body{
          display: flex;
          justify-content: center;
          font-family: Roboto, Arial, sans-serif;
          font-size: 15px;
          background-color: rgb(176, 198, 207);
        }
        input{
            font-size: 20px;
        }
        form {
          border: 5px solid #f1f1f1;
          background-color: #f1f1f1;
        }
        .formcontainer {
          text-align: center;
          background-color: rgb(250, 233, 233);
          padding-left: 500px;
          padding-right: 500px;
        }
        .table{
            padding-left: 500px;
            padding-right: 500px;
        }
        .icon {
          font-size: 110px;
          display: flex;
          justify-content: center;
          color: #4286f4;
        }
        h1 {
          text-align: center;
          font-size: 18px;
        }
        label{
            text-align: left;
        }
        .container {
          padding: 16px 0;
          align-content: center;
          }
        .error{
          color: red;
        }
        .registerbtn {  
          background-color: #9bcdca;  
          color: rgb(11, 11, 11);  
          padding: 16px 20px;  
          margin: 8px 0;  
          border: none;  
          cursor: pointer;
          text-align: center;
          opacity: 0.9;  
        }  
        .registerbtn:hover {  
          opacity: 3;  
        }  
        hr {  
          border: 1px solid #8E6969;  
          margin-bottom: 25px;  
        }
        tr{
            padding: 2%;
        }
    </style>
</head>
<body>
    <form id="VaccinationForm" action="update.php" method="post" enctype="multipart/form-data">
        <div class="formcontainer">
            <div class="icon">
                <i class="fas fa-user-circle"></i>
            </div>
            <h1>Vaccine Registration Form</h1>
        </div>
        <hr> <table width=100%>
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <tr> 
                <td><label><strong>FIRST NAME</strong></label></td>    
                <td><label><strong>LAST NAME</strong></label></td>
                <td><label><strong>NATIONAL SECURITY NUMBER</strong></label></td>
            </tr>
            <tr>
                <td><input type="text" name="firstname" placeholder= "First Name" size="35"  value="<?php echo $row['firstname']; ?>" required /></td> 
                <td><input type="text" name="lastname" placeholder="Last Name" size="35"  value="<?php echo $row['lastname']; ?>" required /></td>  
                <td><input type="text" name="securityno" placeholder="National Security Number" size="35"  value="<?php echo $row['securityno']; ?>" required /></td>
            </tr>
            <tr>
                <td><label><strong>DATE OF BIRTH</strong></label></td>    
                <td><label><strong>EMAIL ID</strong></label></td>
                <td><label><strong>PHONE NUMBER</strong></label></td>
            </tr>
            <tr>
                <td><input type="date" name="dob" placeholder="MM-DD-YYYY" size="35"  value="<?php echo $row['dob']; ?>" required></td>
                <td><input type="email" name="email" placeholder="example@gmail.com" size="35"  value="<?php echo $row['email']; ?>" require></td>
                <td><input type="text" name="phnumber" placeholder="Enter Valid phone number" size="35"  value="<?php echo $row['phnumber']; ?>" required></td>
            </tr><tr></tr>
            <tr>
                <td><label><strong>GENDER</strong></label></td>    
                <td><label><strong>ADDRESS 1</strong></label></td>
                <td><label><strong>ADDRESS 2</strong></label></td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;<input type="radio" name="gender" value="Male"  value="<?php echo $row['gender']; ?>" checked>Male &nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;<input type="radio" name="gender" value="Female"  value="<?php echo $row['gender']; ?>">Female</td>
                <td><input type="text" name="address1" placeholder="Address 1" size="35"  value="<?php echo $row['address1']; ?>" required></td>
                <td><input type="text" name="address2" placeholder="Address 2" size="35"  value="<?php echo $row['address2']; ?>"></td>
            </tr><tr></tr>
            <tr>
                <td><label><strong>CITY</strong></label></td>    
                <td><label><strong>STATE/PROVINCE</strong></label></td>
                <td><label><strong>COUNTRY</strong></label></td>
            </tr>
            <tr>
                <td><input type="text" name="city" placeholder="City" size="35"  value="<?php echo $row['city']; ?>"></td>
                <td><input type="text" name="state" placeholder="State/Province"  value="<?php echo $row['state']; ?>"></td>
                <td><select id="country" name="country" class="form-control" placeholder="Select Country"  value="<?php echo $row['country']; ?>">
                    <option value="" selected disabled>Select a country</option>
                    <option value="Afghanistan">Afghanistan</option>
                    <option value="Åland Islands">Åland Islands</option>
                    <option value="Albania">Albania</option>
                    <option value="Algeria">Algeria</option>
                    <option value="American Samoa">American Samoa</option>
                    <option value="Andorra">Andorra</option>
                    <option value="Angola">Angola</option>
                    <option value="Anguilla">Anguilla</option>
                    <option value="Antarctica">Antarctica</option>
                    <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                    <option value="Argentina">Argentina</option>
                    <option value="Armenia">Armenia</option>
                    <option value="Aruba">Aruba</option>
                    <option value="Australia">Australia</option>
                    <option value="Austria">Austria</option>
                    <option value="Azerbaijan">Azerbaijan</option>
                    <option value="Bahamas">Bahamas</option>
                    <option value="Bahrain">Bahrain</option>
                    <option value="Bangladesh">Bangladesh</option>
                    <option value="Barbados">Barbados</option>
                    <option value="Belarus">Belarus</option>
                    <option value="Belgium">Belgium</option>
                    <option value="Belize">Belize</option>
                    <option value="Benin">Benin</option>
                    <option value="Bermuda">Bermuda</option>
                    <option value="Bhutan">Bhutan</option>
                    <option value="Bolivia">Bolivia</option>
                    <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                    <option value="Botswana">Botswana</option>
                    <option value="Bouvet Island">Bouvet Island</option>
                    <option value="Brazil">Brazil</option>
                    <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                    <option value="Brunei Darussalam">Brunei Darussalam</option>
                    <option value="Bulgaria">Bulgaria</option>
                    <option value="Burkina Faso">Burkina Faso</option>
                    <option value="Burundi">Burundi</option>
                    <option value="Cambodia">Cambodia</option>
                    <option value="Cameroon">Cameroon</option>
                    <option value="Canada">Canada</option>
                    <option value="Cape Verde">Cape Verde</option>
                    <option value="Cayman Islands">Cayman Islands</option>
                    <option value="Central African Republic">Central African Republic</option>
                    <option value="Chad">Chad</option>
                    <option value="Chile">Chile</option>
                    <option value="China">China</option>
                    <option value="Christmas Island">Christmas Island</option>
                    <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                    <option value="Colombia">Colombia</option>
                    <option value="Comoros">Comoros</option>
                    <option value="Congo">Congo</option>
                    <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                    <option value="Cook Islands">Cook Islands</option>
                    <option value="Costa Rica">Costa Rica</option>
                    <option value="Cote D'ivoire">Cote D'ivoire</option>
                    <option value="Croatia">Croatia</option>
                    <option value="Cuba">Cuba</option>
                    <option value="Cyprus">Cyprus</option>
                    <option value="Czech Republic">Czech Republic</option>
                    <option value="Denmark">Denmark</option>
                    <option value="Djibouti">Djibouti</option>
                    <option value="Dominica">Dominica</option>
                    <option value="Dominican Republic">Dominican Republic</option>
                    <option value="Ecuador">Ecuador</option>
                    <option value="Egypt">Egypt</option>
                    <option value="El Salvador">El Salvador</option>
                    <option value="Equatorial Guinea">Equatorial Guinea</option>
                    <option value="Eritrea">Eritrea</option>
                    <option value="Estonia">Estonia</option>
                    <option value="Ethiopia">Ethiopia</option>
                    <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                    <option value="Faroe Islands">Faroe Islands</option>
                    <option value="Fiji">Fiji</option>
                    <option value="Finland">Finland</option>
                    <option value="France">France</option>
                    <option value="French Guiana">French Guiana</option>
                    <option value="French Polynesia">French Polynesia</option>
                    <option value="French Southern Territories">French Southern Territories</option>
                    <option value="Gabon">Gabon</option>
                    <option value="Gambia">Gambia</option>
                    <option value="Georgia">Georgia</option>
                    <option value="Germany">Germany</option>
                    <option value="Ghana">Ghana</option>
                    <option value="Gibraltar">Gibraltar</option>
                    <option value="Greece">Greece</option>
                    <option value="Greenland">Greenland</option>
                    <option value="Grenada">Grenada</option>
                    <option value="Guadeloupe">Guadeloupe</option>
                    <option value="Guam">Guam</option>
                    <option value="Guatemala">Guatemala</option>
                    <option value="Guernsey">Guernsey</option>
                    <option value="Guinea">Guinea</option>
                    <option value="Guinea-bissau">Guinea-bissau</option>
                    <option value="Guyana">Guyana</option>
                    <option value="Haiti">Haiti</option>
                    <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                    <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                    <option value="Honduras">Honduras</option>
                    <option value="Hong Kong">Hong Kong</option>
                    <option value="Hungary">Hungary</option>
                    <option value="Iceland">Iceland</option>
                    <option value="India">India</option>
                    <option value="Indonesia">Indonesia</option>
                    <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                    <option value="Iraq">Iraq</option>
                    <option value="Ireland">Ireland</option>
                    <option value="Isle of Man">Isle of Man</option>
                    <option value="Israel">Israel</option>
                    <option value="Italy">Italy</option>
                    <option value="Jamaica">Jamaica</option>
                    <option value="Japan">Japan</option>
                    <option value="Jersey">Jersey</option>
                    <option value="Jordan">Jordan</option>
                    <option value="Kazakhstan">Kazakhstan</option>
                    <option value="Kenya">Kenya</option>
                    <option value="Kiribati">Kiribati</option>
                    <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                    <option value="Korea, Republic of">Korea, Republic of</option>
                    <option value="Kuwait">Kuwait</option>
                    <option value="Kyrgyzstan">Kyrgyzstan</option>
                    <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                    <option value="Latvia">Latvia</option>
                    <option value="Lebanon">Lebanon</option>
                    <option value="Lesotho">Lesotho</option>
                    <option value="Liberia">Liberia</option>
                    <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                    <option value="Liechtenstein">Liechtenstein</option>
                    <option value="Lithuania">Lithuania</option>
                    <option value="Luxembourg">Luxembourg</option>
                    <option value="Macao">Macao</option>
                    <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                    <option value="Madagascar">Madagascar</option>
                    <option value="Malawi">Malawi</option>
                    <option value="Malaysia">Malaysia</option>
                    <option value="Maldives">Maldives</option>
                    <option value="Mali">Mali</option>
                    <option value="Malta">Malta</option>
                    <option value="Marshall Islands">Marshall Islands</option>
                    <option value="Martinique">Martinique</option>
                    <option value="Mauritania">Mauritania</option>
                    <option value="Mauritius">Mauritius</option>
                    <option value="Mayotte">Mayotte</option>
                    <option value="Mexico">Mexico</option>
                    <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                    <option value="Moldova, Republic of">Moldova, Republic of</option>
                    <option value="Monaco">Monaco</option>
                    <option value="Mongolia">Mongolia</option>
                    <option value="Montenegro">Montenegro</option>
                    <option value="Montserrat">Montserrat</option>
                    <option value="Morocco">Morocco</option>
                    <option value="Mozambique">Mozambique</option>
                    <option value="Myanmar">Myanmar</option>
                    <option value="Namibia">Namibia</option>
                    <option value="Nauru">Nauru</option>
                    <option value="Nepal">Nepal</option>
                    <option value="Netherlands">Netherlands</option>
                    <option value="Netherlands Antilles">Netherlands Antilles</option>
                    <option value="New Caledonia">New Caledonia</option>
                    <option value="New Zealand">New Zealand</option>
                    <option value="Nicaragua">Nicaragua</option>
                    <option value="Niger">Niger</option>
                    <option value="Nigeria">Nigeria</option>
                    <option value="Niue">Niue</option>
                    <option value="Norfolk Island">Norfolk Island</option>
                    <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                    <option value="Norway">Norway</option>
                    <option value="Oman">Oman</option>
                    <option value="Pakistan">Pakistan</option>
                    <option value="Palau">Palau</option>
                    <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                    <option value="Panama">Panama</option>
                    <option value="Papua New Guinea">Papua New Guinea</option>
                    <option value="Paraguay">Paraguay</option>
                    <option value="Peru">Peru</option>
                    <option value="Philippines">Philippines</option>
                    <option value="Pitcairn">Pitcairn</option>
                    <option value="Poland">Poland</option>
                    <option value="Portugal">Portugal</option>
                    <option value="Puerto Rico">Puerto Rico</option>
                    <option value="Qatar">Qatar</option>
                    <option value="Reunion">Reunion</option>
                    <option value="Romania">Romania</option>
                    <option value="Russian Federation">Russian Federation</option>
                    <option value="Rwanda">Rwanda</option>
                    <option value="Saint Helena">Saint Helena</option>
                    <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                    <option value="Saint Lucia">Saint Lucia</option>
                    <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                    <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                    <option value="Samoa">Samoa</option>
                    <option value="San Marino">San Marino</option>
                    <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                    <option value="Saudi Arabia">Saudi Arabia</option>
                    <option value="Senegal">Senegal</option>
                    <option value="Serbia">Serbia</option>
                    <option value="Seychelles">Seychelles</option>
                    <option value="Sierra Leone">Sierra Leone</option>
                    <option value="Singapore">Singapore</option>
                    <option value="Slovakia">Slovakia</option>
                    <option value="Slovenia">Slovenia</option>
                    <option value="Solomon Islands">Solomon Islands</option>
                    <option value="Somalia">Somalia</option>
                    <option value="South Africa">South Africa</option>
                    <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                    <option value="Spain">Spain</option>
                    <option value="Sri Lanka">Sri Lanka</option>
                    <option value="Sudan">Sudan</option>
                    <option value="Suriname">Suriname</option>
                    <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                    <option value="Swaziland">Swaziland</option>
                    <option value="Sweden">Sweden</option>
                    <option value="Switzerland">Switzerland</option>
                    <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                    <option value="Taiwan">Taiwan</option>
                    <option value="Tajikistan">Tajikistan</option>
                    <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                    <option value="Thailand">Thailand</option>
                    <option value="Timor-leste">Timor-leste</option>
                    <option value="Togo">Togo</option>
                    <option value="Tokelau">Tokelau</option>
                    <option value="Tonga">Tonga</option>
                    <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                    <option value="Tunisia">Tunisia</option>
                    <option value="Turkey">Turkey</option>
                    <option value="Turkmenistan">Turkmenistan</option>
                    <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                    <option value="Tuvalu">Tuvalu</option>
                    <option value="Uganda">Uganda</option>
                    <option value="Ukraine">Ukraine</option>
                    <option value="United Arab Emirates">United Arab Emirates</option>
                    <option value="United Kingdom">United Kingdom</option>
                    <option value="United States">United States</option>
                    <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                    <option value="Uruguay">Uruguay</option>
                    <option value="Uzbekistan">Uzbekistan</option>
                    <option value="Vanuatu">Vanuatu</option>
                    <option value="Venezuela">Venezuela</option>
                    <option value="Viet Nam">Viet Nam</option>
                    <option value="Virgin Islands, British">Virgin Islands, British</option>
                    <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                    <option value="Wallis and Futuna">Wallis and Futuna</option>
                    <option value="Western Sahara">Western Sahara</option>
                    <option value="Yemen">Yemen</option>
                    <option value="Zambia">Zambia</option>
                    <option value="Zimbabwe">Zimbabwe</option>
                    </select></td>
            </tr>
        </table>
        <table width=100%>
            <tr></tr>
            <tr>
                <td><label><strong>INSURANCE COMPANY</strong></label></td>
                <td><label><strong>INSURANCE ID</strong></label></td>
            </tr>
            <tr>
                <td><input type="text" name="insuranceco" placeholder="Insurance Company" size="40"  value="<?php echo $row['insuranceco']; ?>"></td>
                <td><input type="text" name="insuranceid" placeholder="Insurance ID" size="40"  value="<?php echo $row['insuranceid']; ?>"></td>
            </tr><tr></tr>
            <tr>
                <td><label><strong>HAVE YOU BEEN DIAGNOSED WITH ANY DISEASES?</strong></label></td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;<input type="radio" name="diseases" value="Yes"  value="<?php echo $row['diseases']; ?>" >YES <br>
                    &nbsp;&nbsp;&nbsp;<input type="radio" name="diseases" value="No"  value="<?php echo $row['diseases']; ?>" checked>NO</td>
            </tr>
        </table><br>
            <tr>
                <input type="checkbox" name="declaration"  value="<?php echo $row['declaration']; ?>" required> I HEREBY DECLARE THAT ALL THE GIVEN INFORMATION ARE ACCURATE. 
            </tr>
            <hr>
        <div class="container">
            <button type="submit" class="registerbtn" ><strong>Update</strong></button>
	        <button type="button" class="registerbtn" onclick="storeFormData()"><strong>STORE</strong></button>
        </div>
        <script>
            function storeFormData() {
                const formData = {
                    firstname: document.getElementsByName('firstname')[0].value,
                    lastname: document.getElementsByName('lastname')[0].value,
                    securityno: document.getElementsByName('securityno')[0].value,
                    dob: document.getElementsByName('dob')[0].value,
                    email: document.getElementsByName('email')[0].value,
                    phnumber: document.getElementsByName('phnumber')[0].value,
                    gender: document.querySelector('input[name="gender"]:checked').value,
                    address1: document.getElementsByName('address1')[0].value,
                    address2: document.getElementsByName('address2')[0].value,
                    city: document.getElementsByName('city')[0].value,
                    state: document.getElementsByName('state')[0].value,
                    country: document.getElementsByName('country')[0].value,
                    insuranceco: document.getElementsByName('insuranceco')[0].value,
                    insuranceid: document.getElementsByName('insuranceid')[0].value,
                    diseases: document.querySelector('input[name="diseases"]:checked').value,
                    declaration: document.getElementsByName('declaration')[0].checked
                };
        
                localStorage.setItem('storedFormData', JSON.stringify(formData));
        
                alert('Form data stored temporarily.');
        
                window.location.href = 'index.html';
            }
        </script>
        
    </form>
</body>
</html>
<?php
    } else {
        echo "Record not found";
    }
}

$conn->close();
?>
