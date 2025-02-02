<?php
include 'nav.php';
include 'db_connection.php';
$con = OpenCon();
$user = mysqli_query($con,"SELECT * FROM users");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: #ffffff;
            margin: 0;
            padding: 0;
        }
        .table-container {
            margin: 3rem auto;
            width: 80%;
            background-color: #1f1f1f;
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }
        thead {
            background-color: #333333;
        }
        th, td {
            padding: 1rem;
            border: 1px solid #444444;
        }
        th {
            color: #ffdd57;
        }
        tr:nth-child(even) {
            background-color: #2a2a2a;
        }
        tr:hover {
            background-color: #444444;
        }
    </style>
</head>
<body>
    <?php
    echo '
     <div class="table-container">
        <table dir="rtl" class="table table-bordered table-striped">
            <thead class="table-dark ">
                <tr>
                    <th>שם משתמש</td>
                    <th>שם פרטי</td>
                    <th>שם משפחה</td>
                    <th>סיסמה</td>
                    <th>מייל</td>
                    <th>טלפון</td>
                    <th>כתובת</td>
                    <th>התחברות אחרונה</td>
                </tr>
            </thead>
            <tbody>';
    while($row = mysqli_fetch_array($user))
    {
       echo   '
                <tr>
                    <td>'.$row['userName']. '</td>
                    <td>'.$row['fName']. '</td>
                    <td>'.$row['lName']. '</td>
                    <td>'.$row['password']. '</td>
                    <td>'.$row['email']. '</td>
                    <td>'.$row['phone']. '</td>
                    <td>'.$row['address']. '</td>
                    <td>'.$row['lastLog']. '</td>
                </tr>';
    }
     echo ' </tbody>
        </table>
        </div>';
    ?>




</body>
</html>