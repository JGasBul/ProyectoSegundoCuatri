<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == 1) {
    if ($_SESSION["rol"] == "normal") {
        header("location: parcelas.html?usuario=" . $_SESSION["id"]);
        exit;
    } else {
        header("location: admin.php");
        exit;
    }
}

$username = $password = "";
$username_err = $password_err = $login_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if username is empty
    if (empty(trim($_POST["email"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["email"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        $data = array("email" => $username, "password" => $password);
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_URL, "http://localhost/src/api/user.php/login");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($http_code != 200) {
            //var_dump($http_code);
            echo "<script> document.getElementById('error-mobile').style.visibility = 'visible'; </script>";
        } else {
            $result = json_decode($result);

            session_start();
            foreach ($result as $key => $value) {
                $_SESSION["{$key}"] = $value;
            }
            if ($_SESSION["rol"] == "normal") {
                header("location: parcelas.html?usuario=" . $_SESSION["id"]);
            } else {
                header("location: admin.php");
            }
        }
    }
}
?>