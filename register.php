<?php
include 'usersArray.php';
include 'nav.php';
echo '<html>
<head>
<title>הרשמה לאתר</title>
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

input[type="text"], input[type="password"], input[type="tel"], input[type="number"] {
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
<form action="checkSignUp.php" method="post" name="register">
שם משתמש: </br>
<input type="text" name="user_name" required /><br /><br />
    שם פרטי: </br>
    <input type="text" name="first_name" required /><br /><br />
    שם משפחה: </br>
    <input type="text" name="last_name" required /><br /><br />
    דואר אלקטרוני: </br>
    <input type="text" name="email" required /><br /><br />
    טלפון: </br>
    <input type="tel" name="phone" required pattern="[0-9]{10}" title="מספר טלפון בתקן ישראלי (10 ספרות)" /><br /><br />

    כתובת: </br>
    <input type="text" name="address" required /><br /><br />
    סיסמה: </br>
    <input type="password" name="password" required /><br /><br />
    <input type="submit" value="הירשם" />
</form>
<p id="p1"> </p>
</center>
</div>
</body>
</html>';

// echo "<pre>";
// print_r($users);
// echo "</pre>";

?>

