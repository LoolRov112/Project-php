<?php 
include 'usersArray.php';  // מוודא שמערך המשתמשים נכנס

function generateNewPassword($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $newPassword = '';
    for ($i = 0; $i < $length; $i++) {
        $newPassword .= $characters[rand(0, $charactersLength - 1)];
    }
    return $newPassword;
}

if (isset($_POST["forgotPass"])) {
    $user_name = $_POST['user_name'];
    $userFound = false;

    // עובר על המערך ומחפש את שם המשתמש
    foreach ($users as &$user) {
        if ($user['user_name'] == $user_name) {
            $userFound = true;
            $newPassword = generateNewPassword();  
            $user['password'] = $newPassword;  
            echo "<p>הסיסמה החדשה שלך היא: <strong> $newPassword </strong></p>";
            break;
        }
    }

    // אם לא נמצא המשתמש
    if (!$userFound) {
        echo "<p>שם המשתמש לא נמצא במערכת.</p>";
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
        <form action="" method="post">
            <h1>שחזור סיסמה</h1>
            <input type="text" name="user_name" placeholder="הכנס שם משתמש" required>
            <input type="submit" value="החלף סיסמא" name="forgotPass">
            <input type="button" value="חזור לדף הראשי" onclick="window.location.href='home1.php'">
        </form>
    </div>
</body>
</html>
