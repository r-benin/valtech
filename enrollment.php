<!DOCTYPE html>
<html>
    <head>
        <title>myVALTECH Dashboard</title>
        <link rel="icon" href="img/valtech-black.png">
        <link rel="stylesheet" href="enrollment-styles.css">
    </head>
    <body>

        <div class="popup-message">
            <div class="popup-container">
                <img src="img/warning.png" class="popup-img">
                <p class="popup-heading">Access denied!</p>
                <p id="popup-message-text">Complete personal information is required before enrolling.</p>
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

                if (empty($row['region'])) {
                    echo "<script src='popupmsg-enrollment-error.js'>";
                }

                $studentID = $row['studentID'];
                $lastName = $row['lastName'];
                $firstName = $row['firstName'];
                $middleName = $row['middleName'];

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    try {
                        if ($_POST["form-type"] == "enrollment") {
                            $collegeSelect = $_POST["collegeSelect"];
                            $programSelect = $_POST["programSelect"];
                            if ($collegeSelect == "1") {
                                $college = "College of Computing and Information Sciences";
                            } else {
                                $college = "College of Engineering";
                            }
        
                            $sql = "UPDATE tbl_enrollment SET 
                                        enrollmentStatus = 'ENROLLED',
                                        college = '$college', 
                                        program = '$programSelect' 
                                    WHERE studentID = $studentID;";
        
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();

                            echo '<script src="popupmsg-enrollment.js"></script>';
                        }
                    } catch (PDOException $e) {
                        echo $e;
                    }
                }

                $sql = "SELECT * FROM tbl_enrollment WHERE studentID = '$studentID'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();

                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                $enrollmentStatus = $row['enrollmentStatus'];

                if ($enrollmentStatus == "ENROLLED") {
                    $college = $row['college'];
                    $program = $row['program'];
                }


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
            <div id="profile-button" class="unselected-navbar-button" onclick="location.href = 'dashboard.php'">
                <img src="img/profile.png">
                <p class="side-navbar-text">Profile</p>
            </div>
            <div id="enrollment-button" class="selected-navbar-button">
                <img src="img/enrollment.png">
                <p class="side-navbar-text">Enrollment</p>
            </div>
        </div>
        <form id="enrollment-container" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" name="enrollment">
            <p class="heading">Enrollment</p>
            <input type=hidden name="form-type" value="enrollment">
            <div id="enrollment-details">
                <div id="grid-container">
                    <div class="grid-header">Student ID: </div>
                    <div class="grid-text"><?php echo $studentID ?></div>
                    <div class="grid-header">Student Name: </div>
                    <div class="grid-text"><?php echo $lastName . ", " . $firstName . " " . $middleName ?></div>
                    <div class="grid-header">Enrollment Status: </div>
                    <div class="grid-text"><?php echo $enrollmentStatus ?></div>
                    <div class="grid-header">College: </div>
                    <div class="grid-text">
                        <?php if ($enrollmentStatus == "ENROLLED") { echo $college; } else { echo "N/A"; } ?>
                    </div>
                    <div class="grid-header">Program: </div>
                    <div class="grid-text">
                    <?php if ($enrollmentStatus == "ENROLLED") { echo $program; } else { echo "N/A"; } ?>
                    </div>
                </div>
                <div>
                    <div>
                        <label for="college">College</label>
                        <?php
                            if ($enrollmentStatus == "ENROLLED") {
                                echo '<input type="text" value="' . $college . '" disabled></input>';
                            } else {
                                echo '<select name="collegeSelect" id="college-select">';
                                echo '<option disabled selected>- Please select a college -</option>';
                                echo '<option value="1">College of Computing and Information Sciences</option>';
                                echo '<option value ="2">College of Engineering</option>';
                                echo '</select>';
                            }
                        ?>
                    </div>
                </div>
                <div>
                    <div>
                        <label for="program">Program</label>
                        <?php
                            if ($enrollmentStatus == "ENROLLED") {
                                echo '<input type="text" value="' . $program . '" disabled></input>';
                            } else {
                                echo '<select name="programSelect" id="program-select">';
                                echo '</select>';
                                echo '<script src="enrollment.js"></script>';
                            }
                        ?>
                    </div>
                </div>
            </div>
            <?php
                if ($enrollmentStatus != "ENROLLED") {
                    echo '<input type="submit" id="submit-data" value="Enroll"></input>';
                }
            ?>
        </form>
        <script src="buttons.js"></script>
    </body>
</html>