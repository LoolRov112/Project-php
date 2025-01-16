<?php 
include 'db_connection.php';
$con = OpenCon();
$user = mysqli_query($con,"SELECT * FROM users");

function generateNewPassword($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $newPassword = '';
    for ($i = 0; $i < $length; $i++) {
        $newPassword .= $characters[rand(0, $charactersLength - 1)];
    }
    return $newPassword;
}

if (isset($_POST["forgotPass"])) 
{
    $user_name = $_POST['user_name'];
    $newPass = generateNewPassword();
    $userFound = false;

    while($row = mysqli_fetch_array($user))
    {
        if ($row['userName'] == $user_name) {
                    $update_query = "UPDATE users SET password = '$newPass' WHERE userName = '".$user_name."'";
                    mysqli_query($con, $update_query);
                    $update_query= mysqli_query($con,"UPDATE users SET attempts = 0 where '" .$row['userName']. "'= '".$user_name."'");
                    echo "<p>הסיסמא החדשה שלך היא: " . $newPass . "</p>";
                    $userFound = true;
                    $_SESSION['userName'] = $row['userName'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['password'] = $newPass;
                    header("Location: sendMail.php");
                    break;        
                }            
    }
        if (!$userFound)  {
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
            <input type="submit" value="החלף סיסמה" name="forgotPass">
            <input type="button" value="חזור לדף הכניסה" onclick="window.location.href='login.php'">
        </form>
    </div>
</body>
</html>
