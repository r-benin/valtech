<!DOCTYPE html>
<html>
    <head>
        <title>myVALTECH Login</title>
        <link rel="icon" href="img/valtech-black.png">
        <link rel="stylesheet" href="styles.css">
        <script src="button-colors.js" defer></script>
    </head>
    <body>

        <?php
            session_start();

            if(isset($_SESSION['login']) && $_SESSION['login'] == true) {
                header("location: dashboard.php");
                exit;
            }
            
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

        
        
        <h1 id="form-title">Log in into your VALTECH account</h1>
        <p id="form-text">Access the myVALTECH portal by logging into your VALTECH account</p>

        <div id="login-container">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" name="login-form">
                <input type="hidden" name="form-type" value="login-form">
                <div id="email">
                    <label>E-mail</label>
                    <input type="email" name="login-email" class="text-input">  
                </div>

                <div id="password" class="password">
                    <label>Password</label>
                    <input type="password" name="login-password" class="text-input">  
                </div>

                <input type="submit" id="login" value="Login"></input>

                <div id="login-message">
                    <p id="login-message-text">Login failed! An account with that e-mail does not exist.</p>
                </div>
            </form>
            
        </div>

        <p id="copyright-text">Copyright © 2023 Valenzuela Institute of Technology. All rights reserved.</p>

            <?php

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if ($_POST['form-type'] == "login-form") {
                    if (!empty($_POST["login-email"]) && !empty($_POST["login-password"])) {
                        $login_email = $_POST["login-email"];
                        $login_password = $_POST["login-password"];

                        try {
                            $sql_count = "SELECT COUNT(email) AS num FROM tbl_studentInfo WHERE email = :email";
                            $stmt = $conn->prepare($sql_count);

                            $stmt->bindValue(':email', $login_email);
                            $stmt->execute();

                            $row = $stmt->fetch(PDO::FETCH_ASSOC);

                            if ($row['num'] == 0) {
                                echo "<script src='login-incorrect.js'></script>";
                            } else {
                                $sql = "SELECT password from tbl_studentInfo WHERE email = :email";
                                $stmt = $conn->prepare($sql);

                                $stmt->bindValue(':email', $login_email);
                                $stmt->execute();

                                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                                if (password_verify($login_password, $row['password'])) {
                                    echo "<script>console.log('Logged in!')</script>";
                                    session_start();
                                    $_SESSION['login'] = true;
                                    $_SESSION['email'] = $login_email;
                                    header('Location: dashboard.php');
                                } else {
                                    echo "<script src='login-incorrect.js'></script>";
                                }
                            }
                        } catch(PDOException $e) {
                            echo "Connection failed:" . $e->getMessage();
                        }
                    } else {
                        echo "<script src='login-fail.js'></script>";
                    }
                }
            }

            ?>

    </body>
</html>