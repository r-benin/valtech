<!DOCTYPE html>
<html>
    <head>
        <title>myVALTECH Dashboard</title>
        <link rel="icon" href="img/valtech-black.png">
        <link rel="stylesheet" href="enrollment-styles.css">
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
        <div id="student-profile">
        </div>
        <script src="buttons.js"></script>
    </body>
</html>