<?php
include 'nav.php';
include 'db_connection.php';
include 'sendMail.php';
$con = OpenCon();
$msg = mysqli_query($con, "SELECT * FROM contact");

if (isset($_POST["changeStatus"])) {
    $id = (int)$_POST['id'];
    $updateQuery = "UPDATE contact SET status = 1 WHERE id = $id";
    mysqli_query($con, $updateQuery);
}

// if (isset($_POST["submitReply"])) {
//     $id = (int)$_POST['reply_id']; 
//     $reply = mysqli_real_escape_string($con, $_POST['reply_text']);
    
//     $insertQuery = "INSERT INTO response VALUES ($id, '$reply')";
//     if (mysqli_query($con, $insertQuery)) {
//         echo "<script>alert('התגובה נשמרה בהצלחה!');</script>";
//     } else {
//         echo "<script>alert('שגיאה בשמירת התגובה: " . mysqli_error($con) . "');</script>";
//     }
// }
if (isset($_POST["submitReply"])) {
    $id = (int)$_POST['reply_id']; 
    $reply = mysqli_real_escape_string($con, $_POST['reply_text']);
    
    $insertQuery = "INSERT INTO response VALUES ($id, '$reply')";
    if (mysqli_query($con, $insertQuery)) {
        // שליפת פרטי המשתמש לשליחת דוא"ל
        $userQuery = "SELECT email FROM contact WHERE id = $id";
        $result = mysqli_query($con, $userQuery);
        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            $email = $user['email'];
            
            // שליחת התגובה במייל
            $from = "mayan.yehuda@gmail.com";
            $subject = "תגובה לפנייתך";
            $body = "שלום,\n\nקיבלנו את פנייתך, והנה תגובתנו:\n\n$reply\n\nבברכה,\nהצוות שלנו";
            sendMail($email, $subject, $body, $from);
            
        } else {
            echo "<script>alert('שגיאה בשליפת הדוא\"ל של המשתמש.');</script>";
        }
    } else {
        echo "<script>alert('שגיאה בשמירת התגובה: " . mysqli_error($con) . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .table-container { margin: 3rem auto; width: 80%; background-color: seagreen; border-radius: 8px; padding: 1.5rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); }
        table { width: 100%; border-collapse: collapse; text-align: center; }
        thead { background-color: #333333; }
        th, td { padding: 1rem; border: 1px solid #444444; }
        th { color: #ffdd57; }
        tr:nth-child(even) { background-color: #2a2a2a; color: white; }
        tr:hover { background-color: #444444; }
        .button-container { display: flex; justify-content: center; gap: 10px; }
        .btn { padding: 0.5rem 1rem; border: none; border-radius: 5px; cursor: pointer; transition: background-color 0.3s; }
        .btn-status { background-color: #007bff; color: #fff; }
        .btn-status:hover { background-color: #0056b3; }
        .btn-reply { background-color: #28a745; color: #fff; }
        .btn-reply:hover { background-color: #218838; }
        .popup { position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #1f1f1f; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5); display: none; z-index: 1000; color: #fff; }
        .popup input, .popup textarea { width: 100%; margin-bottom: 1rem; padding: 0.5rem; border: 1px solid #444; border-radius: 4px; background-color: #2a2a2a; color: #fff; }
        .popup button { background-color: #007bff; color: #fff; border: none; padding: 0.5rem 1rem; border-radius: 5px; cursor: pointer; }
        .popup button:hover { background-color: #0056b3; }
        .overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.7); display: none; z-index: 999; }
    </style>
    <script>
        function openPopup(id) {
            document.getElementById('popup').style.display = 'block';
            document.getElementById('overlay').style.display = 'block';
            document.getElementById('reply-id').value = id;
        }

        function closePopup() {
            document.getElementById('popup').style.display = 'none';
            document.getElementById('overlay').style.display = 'none';
        }
    </script>
</head>
<body dir="rtl">
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>שם פרטי</th>
                    <th>שם משפחה</th>
                    <th>פלאפון</th>
                    <th>מייל</th>
                    <th>סטטוס</th>
                    <th>פנייה</th>
                    <th>פעולות</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_array($msg)) {
                    echo '
                        <tr>
                            <td>' . $row['fName'] . '</td>
                            <td>' . $row['lName'] . '</td>
                            <td>' . $row['phone'] . '</td>
                            <td>' . $row['email'] . '</td>
                            <td>' . $row['status'] . '</td>
                            <td>' . $row['msg'] . '</td>
                            <td>
                                <div class="button-container">
                                    <form method="POST" action="" style="display:inline;">
                                        <input type="hidden" name="id" value="' . $row['id'] . '">
                                        <button name="changeStatus" type="submit" class="btn btn-status">שינוי סטטוס</button>
                                    </form>
                                    <button name="response" class="btn btn-reply" onclick="openPopup(' . $row['id'] . ')">תגובה</button>
                                </div>
                            </td>
                        </tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- Popup -->
    <div id="overlay" class="overlay" onclick="closePopup()"></div>
    <div id="popup" class="popup">
        <form method="POST" action="">
            <h3>הכנס תגובה</h3>
            <textarea id="reply-text" name="reply_text" rows="4" placeholder="כתוב תגובה כאן..."></textarea>
            <input type="hidden" id="reply-id" name="reply_id">
            <button type="submit" name="submitReply">שלח</button>
            <button type="button" onclick="closePopup()">ביטול</button>
        </form>
    </div>
</body>
</html>
