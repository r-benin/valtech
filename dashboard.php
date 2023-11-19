<!DOCTYPE html>
<html>
    <head>
        <title>myVALTECH Dashboard</title>
        <link rel="icon" href="img/valtech-black.png">
        <link rel="stylesheet" href="dashboard-styles.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body>

        <?php
            
            session_start();
            if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
                header('Location: login.php');
                exit;
            }

            $login_email = $_SESSION['email'];

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
                $birthdate = $row['birthdate'];
                $email = $row['email'];

            } catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
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
            <div id="enrollment-button" class="unselected-navbar-button">
                <img src="img/enrollment.png">
                <p class="side-navbar-text">Enrollment</p>
            </div>
            
        </div>
        <form id="student-profile">
            <h1>Personal Information</h1>
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
                            <input type="text" value="<?php echo $lastName ?>">
                        </div>
                    </div>
                    <div>
                        <div>
                            <label for="first-name">First Name</label>
                            <input type="text" value="<?php echo $firstName?>">
                        </div>
                    </div>
                    <div>
                        <div>
                            <label for="middle-name">Middle Name</label>
                            <input type="text">
                        </div>
                    </div>
                    <div>
                        <div>
                            <label for="suffix">Suffix</label>
                            <input type="text">
                        </div>
                    </div>
                    <div>
                        <div>
                            <label for="gender">Gender</label>
                            <select>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <div>
                            <label for="birthdate">Birthdate</label>
                            <input type="date" value="<?php echo $birthdate ?>">
                        </div>
                    </div>
                    <div>
                        <div>
                            <label for="nationality">Nationality</label>
                            <input type="text">
                        </div>
                    </div>
                    <div>
                        <div>
                            <label for="email">E-Mail</label>
                            <input type="text" value="<?php echo $email ?>" disabled>
                        </div>
                    </div>
                    <div>
                        <div>
                            <label for="mobile-number">Mobile Number</label>
                            <input type="tel">
                        </div>
                    </div>
                </div>
            </div>
            <div id="address-container">
                <div>
                    <label>Region</label>
                    <select id="region"></select>
                    <input type="hidden" name="region_text" id="region-text">
                </div>
                <div>
                    <label>Province</label>  
                    <select id="province"></select>
                    <input type="hidden" name="province_text" id="province-text">
                </div>
                <div>
                    <label>City</label>  
                    <select id="city"></select>
                    <input type="hidden" name="city_text" id="city-text">
                </div>
                <div>
                    <label>Barangay</label>  
                    <select id="barangay"></select>
                    <input type="hidden" name="barangay_text" id="barangay-text">
                </div>
            </div>
        </form>
        <script src="buttons.js"></script>
    </body>
</html>

<script src="ph-address-selector.js"></script>