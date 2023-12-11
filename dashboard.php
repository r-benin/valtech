<!DOCTYPE html>
<html>
    <head>
        <title>myVALTECH Dashboard</title>
        <link rel="icon" href="img/valtech-black.png">
        <link rel="stylesheet" href="dashboard-styles.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body>

        <div class="popup-message">
            <div class="popup-container">
                <img src="img/check.png">
                <p class="popup-heading">Success!</p>
                <p>Information has been saved.</p>
                <div class="popup-confirm">Confirm</div>
            </div>
        </div>

        <?php
            
            session_start();
            if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
                header('Location: login.php');
                exit;
            }

            $login_email = $_SESSION['email'];
            $login_studentID = $_SESSION['login_studentID'];

            $server_name = "localhost";
            $server_username = "root";
            $server_password = "";
            
            try {
                $conn = new PDO ("mysql:host=$server_name;dbname=db_students", $server_username, $server_password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "SELECT * FROM tbl_studentInfo WHERE email = '$login_email'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();

                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                $lastName = $row['lastName'];
                $firstName = $row['firstName'];
                $middleName = $row['middleName'];
                $suffix = $row['suffix'];
                $gender = $row['gender'];
                $birthdate = $row['birthdate'];
                $email = $row['email'];
                $region = $row['region'];
                $province = $row['province'];
                $city = $row['city'];
                $barangay = $row['barangay'];
                $street = $row['street'];

            } catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }

        ?>

        <?php 
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                try {
                    $middleName = $_POST["middleName"];
                    $suffix = $_POST["suffix"];
                    $gender = $_POST["gender"];
                    $region = $_POST["region_text"];
                    $province = $_POST["province_text"];
                    $city = $_POST["city_text"];
                    $barangay = $_POST["barangay_text"];
                    $street = $_POST["street"];

                    if ($_POST['form-type'] == 'personal-information') {
                        $sql = "UPDATE tbl_studentinfo SET 
                                    middleName = '$middleName', 
                                    suffix = '$suffix',
                                    gender = '$gender',
                                    region = '$region',
                                    province = '$province',
                                    city = '$city',
                                    barangay = '$barangay',
                                    street = '$street'
                                WHERE email = '$login_email';";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                    }  
                } catch (PDOException $e) {
                    echo "Query failed! " . $e->getMessage();
                }
                
            }
            

        
        ?>

        
        <div id="navbar">
            <img id="menu-button" src="img/menu.png">
            <img id="logo" src="img/myvaltech.png">
            <div id="user-container">
                <?php echo "<p id='user-name'>$firstName $lastName</p>"; ?>
                <img id="user-image" src="img/default.png">
                <div id="logout-container">
                    <div id="logout-button"><img src="img/logout.png">Log out</div>
                </div>
            </div>
        </div>
        <div id="side-navbar">
            <div id="profile-button" class="selected-navbar-button">
                <img src="img/profile.png">
                <p class="side-navbar-text">Profile</p>
            </div>
            <div id="enrollment-button" class="unselected-navbar-button" onclick="location.href = 'enrollment.php'">
                <img src="img/enrollment.png">
                <p class="side-navbar-text">Enrollment</p>
            </div>
            
        </div>
        <form id="student-profile" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" name="personal-information" method="POST">
            <input type="hidden" name="form-type" value="personal-information">
            <div class="profile-heading"><p>Personal Information</p></div>
            <div id="personal-info-container">
                <div id="profile-picture-upload">
                    <div id="profile-picture-preview">
                        <img id="profile-picture-preview" src="img/default-picture.png">
                        <label for="img-upload">Upload</label>
                        <input type="file" id="img-upload" accept="image/*">
                    </div>
                </div>
                <div id="personal-info">
                    <div>
                        <div>
                            <label for="last-name">Last Name</label>
                            <input type="text" value="<?php echo $lastName ?>" disabled>
                        </div>
                    </div>
                    <div>
                        <div>
                            <label for="first-name">First Name</label>
                            <input type="text" value="<?php echo $firstName?>" disabled>
                        </div>
                    </div>
                    <div>
                        <div>
                            <label for="middle-name">Middle Name<span class="field-tooltip"> (Leave blank if none)</span></label>
                            <?php
                                if (!empty($region)) {
                                    echo '<input type="text" name="middleName" value="' . $middleName . '" disabled></input>';
                                } else {
                                    echo '<input type="text" name="middleName"></input>';
                                }
                            ?>
                            
                        </div>
                    </div>
                    <div>
                        <div>
                            <label for="suffix">Suffix<span class="field-tooltip"> (Leave blank if none)</span></label>
                            <?php
                                if (!empty($region)) {
                                    echo '<input type="text" name="suffix" value="' . $suffix . '" disabled></input>';
                                } else {
                                    echo '<input type="text" name="suffix"></input>';
                                }
                            ?>
                        </div>
                    </div>
                    <div>
                        <div>
                            <label for="gender">Gender</label>
                                <?php 
                                    if ($gender != "male" && $gender != "female") {
                                        echo '<select required name="gender">';
                                        echo "<option disabled selected>- Select Gender -</option>";
                                    }
                                    if ($gender == "male") {
                                        echo '<select required name="gender" disabled>';
                                        echo "<option value='male' selected>Male</option>";
                                        echo "<option value='female'>Female</option>";
                                    } else if ($gender == "female") {
                                        echo '<select required name="gender" disabled>';
                                        echo "<option value='male' disabled>Male</option>";
                                        echo "<option value='female' disabled selected>Female</option>";
                                    } else {
                                        echo "<option value='male'>Male</option>";
                                        echo "<option value='female'>Female</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div>
                        <div>
                            <label for="birthdate">Birthdate</label>
                            <input type="date" value="<?php echo $birthdate ?>" disabled>
                        </div>
                    </div>
                    <div>
                        <div>
                            <label for="email">E-Mail</label>
                            <input type="text" value="<?php echo $email ?>" disabled>
                        </div>
                    </div>
                </div>
            </div>
            <div class="profile-heading"><p>Address</p></div>
            <div id="address-container">
                <div class="address-select">
                    <label>Region</label>
                    <?php
                        if (!empty($region)) {
                            echo '<input type="text" value="' . $region . '" disabled></input>';
                        } else {
                            echo '<select id="region"></select>';
                        }
                    ?>
                    <input type="hidden" name="region_text" id="region-text" required>
                </div>
                <div class="address-select">
                    <label>Province</label>  
                    <?php
                        if (!empty($region)) {
                            echo '<input type="text" value="' . $province . '" disabled></input>';
                        } else {
                            echo '<select id="province"></select>';
                        }
                    ?>
                    <input type="hidden" name="province_text" id="province-text" required>
                </div>
                <div class="address-select">
                    <label>City</label>  
                    <?php
                        if (!empty($region)) {
                            echo '<input type="text" value="' . $city . '" disabled></input>';
                        } else {
                            echo '<select id="city"></select>';
                        }
                    ?>
                    <input type="hidden" name="city_text" id="city-text" required>
                </div>
                <div class="address-select">
                    <label>Barangay</label>  
                    <?php
                        if (!empty($region)) {
                            echo '<input type="text" value="' . $barangay . '" disabled></input>';
                        } else {
                            echo '<select id="barangay"></select>';
                        }
                    ?>
                    <input type="hidden" name="barangay_text" id="barangay-text" required>
                </div>
                <div id="address-field">
                    <label>Street Address / House No.</label>
                    <?php
                        if (!empty($region)) {
                            echo '<input type="text" value="' . $street . '" disabled></input>';
                        } else {
                            echo '<input type="text" name="street" required>';
                        }
                    ?>
                </div>
            </div>
            <input type="submit" id="submit-data" value="Submit"></input>
        </form>
        <script src="dashboard.php"></script>
        <script src="buttons.js"></script>
    </body>
</html>

<script src="ph-address-selector.js"></script>