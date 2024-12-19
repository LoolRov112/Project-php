<?php
include 'usersArray.php';
include 'nav.php';
session_unset();


if (isset($_POST["submit"])) {
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    $userFound = false;

    foreach ($users as $user) {
        if ($user['user_name'] == $user_name) {
            if($user['password'] != $password) {
                if(!isset($_SESSION['user_name'])) {
                    $_SESSION['user_name'] = 1;
                    echo "<p>סיסמא לא נכונה</p>";
                } else {
                    $_SESSION['user_name'] += 1;
                }

                if($_SESSION['user_name'] >= 3) {
                    echo "<p>הגעת למספר הניסיונות המרבי. אנא נסה מאוחר יותר.</p>"; 
                }
            } else {
                $_SESSION['first_name'] = $user['first_name'];
                $_SESSION['last_name'] = $user['last_name'];
                
                header("Location: home1.php");
            }
        }
    }
}

            


if(isset($_POST["forgetPass"]))
    header("Location: forgetPass.php");
?>

<html>
<head>
    <title>כניסה לאתר</title>
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
        input[type="button"] {
            width: 100%;
            padding: 10px;
            background-color: seagreen;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

    input[type="button"]:hover {
            background-color: darkgreen;
    }

    </style>
</head>
<body dir="rtl">
<div class="formContainer">
    <center>
        <h1>כניסה לאתר משק 95</h1>
        <form action="" method="post" name="login">
            שם משתמש: </br>
            <input type="text" name="user_name" required /><br /><br />
            סיסמה: </br>
            <input type="password" name="password" required /><br /><br />
            <input type="submit" name="submit" value="כניסה" />
        </form>
        <input type="button" value="שכחתי סיסמא" onclick="window.location.href='forgetPass.php'">
    </center>
</div>
</body>
</html>
<?php?>