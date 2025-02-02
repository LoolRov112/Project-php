<?php 
include 'db_connection.php';
session_start();  
$con = OpenCon();
$user = mysqli_query($con,"SELECT * FROM users");
if (isset($_POST['submit'])){
    $newPass = $_POST['newPass'];
    $repeatPass = $_POST['repeatPass'];
    $userName = $_SESSION['userName'];
    $isLongEnough = strlen($newPass) >= 8; 
    $hasUpperCase = false; 
    $hasDigit = false; 

    for ($i = 0; $i < strlen($newPass); $i++) {
        if (ctype_upper($newPass[$i])) { 
            $hasUpperCase = true;
        }
        if (ctype_digit($newPass[$i])) { 
            $hasDigit = true;
        }
    }

    if (!$isLongEnough) {
        echo "<script>alert('הסיסמה חייבת להיות באורך של 8 תווים לפחות.');</script>";
    } elseif (!$hasUpperCase) {
        echo "<script>alert('הסיסמה חייבת להכיל לפחות אות גדולה אחת.');</script>";
    } elseif (!$hasDigit) {
        echo "<script>alert('הסיסמה חייבת להכיל לפחות ספרה אחת.');</script>";
    } elseif ($newPass !== $repeatPass) {
        echo "<script>alert('הסיסמאות אינן תואמות כפרה.');</script>";
    } else {
        while($row = mysqli_fetch_array($user)){
            if($row['userName'] == $userName){
                $update_query = "UPDATE users SET password = '$newPass' WHERE userName = '".$userName."'";
                mysqli_query($con, $update_query);
                $update_reset = "UPDATE users SET reset = 0 WHERE userName = '".$userName."'";
                mysqli_query($con, $update_reset);
                break;
                }
            }
            echo "<script>
            alert('סיסמתך שונתה בהצלחה');</script>";
            header("Refresh:0.5 logout.php");
            exit();
    }
}



?>

<!DOCTYPE html>
<html lang="he">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>שחזור סיסמה</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url("imgs/bgAv.jpg");
            background-size: cover;
            margin-top: 5em;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .formContainer {
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

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"], input[type="button"] {
            width: 100%;
            padding: 10px;
            background-color: seagreen;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        input[type="submit"]:hover, input[type="button"]:hover {
            background-color: darkgreen;
        }
    </style>
</head>
<body dir="rtl">
    <div class="formContainer">
        <form action="" method="post" name = "newPassword">
            <h1>עדכון סיסמה</h1>
            <input type="text" name="newPass" placeholder="הכנס סיסמה חדשה " required>
            <input type="text" name="repeatPass" placeholder="חזור על סיסמה חדשה " required>
            <input type="submit" value="החלף סיסמה" name="submit">
            <input type="button" value="חזור לדף הכניסה" onclick="window.location.href='login.php'">
        </form>
    </div>
</body>
</html>
