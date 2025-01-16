<?php
include 'nav.php';
include 'db_connection.php';
$con = OpenCon();

if(isset($_POST["submit"])){
    $fName= $_POST['fName'];
    $lName= $_POST['lName'];
    $email= $_POST['email'];
    $phone= $_POST['phone'];
    $msg= $_POST['message'];

    $insert_contact = "INSERT INTO contact values(null, '". $fName."','".$lName."','".$phone."','".$email."','".$msg."',0)";
    mysqli_query($con, $insert_contact);
    echo "<script>
            alert('תגובתך נרשמה בהצלחה');
            window.location.href = 'home1.php';
        </script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <style>
        * {
            font-family: Karantina;
        }

        .container {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            margin-top:2em;
            }

        .contact-form {
            display: flex;
            flex-direction: column;
            width: 100%;
            max-width: 600px;
            margin: 2em 0;
            padding: 2em;
            border-radius: 10px;
            background-color: #f7f7ff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .contact-form h2 {
            text-align: center;
            margin-bottom: 1.5em;
        }

        .contact-form label {
            margin-bottom: 0.5em;
            font-size: 1.2em;
        }

        .contact-form input,
        .contact-form textarea {
            margin-bottom: 1.5em;
            padding: 0.8em;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
            width: 100%;
        }

        .contact-form button {
            padding: 1em;
            background-color: #6dbe45;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1.2em;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .contact-form button:hover {
            background-color: #4b7f3f;  
        }
    </style>
</head>
<body dir="rtl">
    <div class="container">
        <div class="contact-form">
            <h2>צור קשר</h2>
            <form action="#" method="POST">
                <label for="fName">שם פרטי:</label>
                <input type="text" id="name" name="fName" required>

                <label for="lName">שם משפחה:</label>
                <input type="text" id="name" name="lName" required>

                <label for="email">דוא"ל:</label>
                <input type="email" id="email" name="email" required>

                <label for="phone">טלפון:</label>
                <input type="tel" id="phone" name="phone" required>

                <label for="message">הודעה:</label>
                <textarea id="message" name="message"  required></textarea>
                <button type="submit" name="submit">שלח</button>
            </form>
        </div>
    </div>
</body>
</html>
';

