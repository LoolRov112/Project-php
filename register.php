<?php
include 'nav.php';
include 'db_connection.php';
$con = OpenCon();
$user = mysqli_query($con, "SELECT * FROM users");
$errors = [];
if (isset($_POST["submit"])) {
    $user_name = $_POST['user_name'];
    $fName = $_POST['first_name'];
    $lName = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $rePass = $_POST['rePass'];
    // בדיקה אם הסיסמה מכילה לפחות 8 תווים, אות גדולה ומספר
    $isLongEnough = strlen($password) >= 8; 
    $hasUpperCase = false; // בדיקה לאות גדולה
    $hasDigit = false; // בדיקה למספר

    for ($i = 0; $i < strlen($password); $i++) {
        if (ctype_upper($password[$i])) { 
            $hasUpperCase = true;
        }
        if (ctype_digit($password[$i])) { 
            $hasDigit = true;
        }
    }

    if (!$isLongEnough) {
        $errors['password'] = "הסיסמה חייבת להיות באורך של 8 תווים לפחות.";
    } elseif (!$hasUpperCase) {
        $errors['password'] = "הסיסמה חייבת להכיל לפחות אות גדולה אחת.";
    } elseif (!$hasDigit) {
        $errors['password'] = "הסיסמה חייבת להכיל לפחות ספרה אחת.";
    } elseif ($password !== $rePass) { 
        $errors['rePass'] = "הסיסמאות אינן תואמות.";
    } else {
        $user_exists = false;

        while ($row = mysqli_fetch_array($user)) {
            if ($row['userName'] == $user_name) {
                $errors['user_name'] = "המשתמש כבר קיים.";
                $user_exists = true;
                break;
            } elseif ($row['email'] == $email) {
                $errors['email'] = "האימייל כבר קיים.";
                $user_exists = true;
                break;
            } elseif ($row['phone'] == $phone) {
                $errors['phone'] = "הטלפון כבר קיים.";
                $user_exists = true;
                break;
            }
        }

        if (!$user_exists) {
            $insert_user = "INSERT INTO users VALUES(
                '".$user_name."',
                '".$fName."',
                '".$lName."',
                '".$password."',
                '".$email."',
                '".$phone."',
                '".$address."',
                1,
                0,
                null,
                0
            )";
            mysqli_query($con, $insert_user);
            echo "<script>
            alert('נרשמת בהצלחה');</script>";
            header("Refresh:0.5 login.php");
            exit();
        }
    }
}
?>

<html>
<head>
<title>הרשמה לאתר</title>
<style>
body {
    font-family: 'IBM Plex Sans Hebrew';
    background-image: url("imgs/bgAv.jpg");
    background-size: cover;
    margin-top: 5em;        
    display: flex;
    justify-content: center; 
    align-items: center;    
    flex-direction: column;  
}

.formContainer{
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0 auto;
}

h1 {
    text-decoration: underline;
    color: seagreen;
    font-style: italic;
    background-color: lightgoldenrodyellow;
    padding: 20px;
    border-radius: 10px;
}

form {
    background-color: rgba(255, 255, 255, 0.8);
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 10px darkgreen;
    width: 300px;
    text-align: center;
}

input[type="text"], input[type="password"], input[type="tel"], input[type="number"],input[type="email"] {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
}

input[type="submit"] {
    width: 100%;
    padding: 10px;
    background-color: seagreen;
    border: none;
    color: white;
    border-radius: 5px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: darkgreen;
}
</style>

</head>
<body dir="rtl">
<div class="formContainer">
<center>
<h1>הרשמה לאתר משק 95</h1>
<form  method="post" name="register">
שם משתמש: </br>
<input type="text" name="user_name" required />
<span class="error"> <?php echo $errors['user_name'] ?? ''; ?> </span>
<br /><br />
    שם פרטי: </br>
    <input type="text" name="first_name" required /><br /><br />
    שם משפחה: </br>
    <input type="text" name="last_name" required /><br /><br />
    דואר אלקטרוני: </br>
    <input type="email" name="email" required pattern="^[^\s@]+@[^\s@]+\.[^\s@]+$" />
    <span class="error"> <?php echo $errors['email'] ?? ''; ?> </span>
    טלפון: </br>
    <input type="tel" name="phone" required pattern="[0-9]{10}" title="מספר טלפון בתקן ישראלי (10 ספרות)" /><br /><br />

    כתובת: </br>
    <input type="text" name="address" required />
    <br /><br />
    סיסמה: </br>
    <input type="password" name="password" required />
    <span class="error"> <?php echo $errors['password'] ?? ''; ?> </span><br /><br />
    אימות סיסמה: </br>
    <input type="password" name="rePass" required />
    <span class="error"> <?php echo $errors['rePass'] ?? ''; ?> </span><br /><br />
    <input type="submit" name="submit" value="הירשם" />
</form>
<p id="p1"> </p>
</center>
</div>
</body>
</html>';



