<!DOCTYPE html>
<html>
    <head>
        <title>myVALTECH Sign up</title>
        <link rel="icon" href="img/valtech-black.png">
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>

        <?php
            
            $servername = "localhost";
            $username =  "root";
            $server_password = "";

            try {
                $conn = new PDO ("mysql:host=$servername;dbname=db_students", $username, $server_password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch(PDOException $e) {
                echo "Connection failed:" . $e->getMessage();
            }
        
        ?>

        <img id="logo" src="img/valtech-black.png">

        <div id="button-container">
            <button id="login-button" onclick="location.href = 'login.php'">Login</button>
            <button id="signup-button" onclick="location.href = 'registration.php'">Sign up</button>
        </div>

        
        
        <h1 id="form-title">Create a VALTECH account</h1>
        <p id="form-text">Access the myVALTECH portal by creating a VALTECH account</p>
        <div id="registration-container">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" name="registration-form">
                    <input type="hidden" name="form-type" value="registration-form">
                    <div id="name">
                        <div id="last-name">
                            <label>Last Name</label>
                            <input name="lastName" class="text-input">
                        </div>
                        <div id="first-name">
                            <label>First Name</label>
                            <input name="firstName" class="text-input">
                        </div>
                    </div>

                    <div id="birthdate">
                        <label for="birthdate">Birthdate</label>
                        <div id="birthdate-input">
                            <div id="year">
                                <select id="year-input" name="year">
                                <?php
                                    for ($i = 1990; $i < 2024; $i++) {
                                        echo "<option value='$i'>$i</option>";
                                    }
                                ?>
                                </select>
                            </div>
                            <div id="month">
                                <select id="month-input" name="month">
                                    <option value="1">January</option>
                                    <option value="2">February</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                            </div>
                            <div id="day">
                                <select id="day-input" name ="day">
                                <?php
                                    for ($i = 1; $i < 32; $i++) {
                                        echo "<option value='$i'>$i</option>";
                                    }
                                ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div id="email">
                        <label>E-mail</label>
                        <input type="email" name="email" class="text-input">  
                    </div>

                    <div id="password" class="password">
                        <label>Password</label>
                        <input type="password" name="password" class="text-input">  
                    </div>

                    <div id="confirm-password" class="password">
                        <label>Confirm password</label>
                        <input type="password" name="confirm-password" class="text-input">  
                    </div>
                    
                    <input type="submit" id="sign-up" value="Sign up"></input>

                    <p id="sign-up-text">By clicking on sign-up, you agree to our Terms of Service and acknowledge our Privacy Policy.</p>
                    
                    <div id="form-message">
                        <p id="form-message-text">Registration sucessful! You may now login with your account.</p>
                    </div>
                </form>
            </div>

        <p id="copyright-text">Copyright © 2023 Valenzuela Institute of Technology. All rights reserved.</p>
                                        
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if ($_POST['form-type'] == "registration-form") {
                    if (!empty($_POST["lastName"]) && !empty($_POST["firstName"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["confirm-password"]) && $_POST["password"] == $_POST["confirm-password"]) {
                        $lastName = strtoupper($_POST["lastName"]);
                        $firstName = strtoupper($_POST["firstName"]);
                        $year = $_POST["year"];
                        $month = $_POST["month"];
                        $day = $_POST["day"];
                        $birthdate = $year . "-" . $month . "-" . $day;
                        $email = $_POST["email"];
                        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    
                        try {
                            $sql_count = "SELECT COUNT(email) AS num FROM tbl_studentInfo WHERE email = :email";
                            $stmt = $conn->prepare($sql_count);
    
    
                            $stmt->bindValue(':email', $email);
                            $stmt->execute();
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
                            if ($row['num'] > 0) {
                                echo '<script src="registration-fail-duplicate.js"></script>';
                            } else {
                                $sql = "INSERT INTO tbl_studentInfo (lastName, firstName, birthdate, email, password) VALUES ('$lastName', '$firstName', '$birthdate', '$email', '$password')";
                                $conn->exec($sql);
                                echo '<script src="registration-success.js"></script>';
                            }
    
                        } catch(PDOException $e) {
                            echo "Connection failed: " . $e->getMessage();
                        }
                    } else if ($_POST["password"] != $_POST["confirm-password"]) {
                        echo '<script src="registration-password-fail.js"></script>';
                    } else{
                        echo '<script src="registration-fail.js"></script>';
                    }

                }
            }

        ?>

    </body>
</html>