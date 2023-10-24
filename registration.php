<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="registration-styles.css">
    </head>
    <body>
        <!-- <div id="navbar">
            <img src="img/valtech-logo-alternate.png">
            <h1 id="logo-text">myVALTECH</h1>
        </div> -->
        <img id="logo" src="img/valtech-black.png">
        <a href="" id="login-button">Login</a>
        <h1 id="form-title">Create a VALTECH account</h1>
        <p id="form-text">Access the myVALTECH portal by creating a VALTECH account</p>
        <div id="form-container">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">

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
                                <option value="2000">2000</option>
                            </select>
                        </div>
                        <div id="month">
                            <select id="month-input" name="month">
                                <option value="January">January</option>
                                <option value="February">February</option>
                                <option value="March">March</option>
                                <option value="April">April</option>
                                <option value="May">May</option>
                                <option value="June">June</option>
                                <option value="July">July</option>
                                <option value="August">August</option>
                                <option value="September">September</option>
                                <option value="October">October</option>
                                <option value="November">November</option>
                                <option value="December">December</option>
                            </select>
                        </div>
                        <div id="day">
                            <select>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                              </select>
                        </div>
                    </div>
                </div>

                <!-- <div id="gender">
                    <label>Gender</label>
                    <div id="gender-input">
                        <div id="male">
                            <input type="radio" name="gender" value="male">
                            <label>Male</label>
                        </div>
                        <div id="female">
                            <input type="radio" name="gender" value="female">
                            <label>Female</label>
                        </div>
                    </div>
                </div> -->

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
            
            <p id="copyright-text">Copyright © 2023 Valenzuela Institute of Technology. All rights reserved.</p>


            <?php
           
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (!empty($_POST["lastName"]) && !empty($_POST["firstName"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["confirm-password"]) && $_POST["password"] == $_POST["confirm-password"]) {
                    $lastName = strtoupper($_POST["lastName"]);
                    $firstName = strtoupper($_POST["firstName"]);
                    $email = $_POST["email"];
                    $password = $_POST["password"];

                    $servername = "localhost";
                    $username = "root";
                    $server_password = "";
                    
                    try {
                        $conn = new PDO("mysql:host=$servername;dbname=db_students", $username, $server_password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        $sql_count = "SELECT COUNT(email) AS num FROM tbl_studentInfo WHERE email = :email";
                        $stmt = $conn->prepare($sql_count);


                        $stmt->bindValue(':email', $email);
                        $stmt->execute();
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);

                        if ($row['num'] > 0) {
                            echo '<script src="registration-fail-duplicate.js"></script>';
                        } else {
                            $sql = "INSERT INTO tbl_studentInfo (lastName, firstName, email, password) VALUES ('$lastName', '$firstName', '$email', '$password')";
                            $conn->exec($sql);
                            echo '<script src="registration-success.js"></script>';
                        }

                    } catch(PDOException $e) {
                        echo "Connection failed: " . $e->getMessage();
                    }
                } else {
                    echo '<script src="registration-fail.js"></script>';
                }

                
                    
            }

        ?>
        </div>
    </body>
</html>