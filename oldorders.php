<?php
include 'nav.php';
include 'db_connection.php';
$con = OpenCon();
$userName = $_SESSION['userName'];
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
<div class="table-container">
    <h1 style="text-align: center;">רשימת הזמנות</h1>
    <table>
        <thead>
            <tr>
                <th>מספר הזמנה</th>
                <th>תאריך הזמנה</th>
                <th>סכום כולל</th>
                <th>מוצרים</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // שאילתת SQL להצגת ההזמנות של המשתמש המחובר
            $orders = mysqli_query($con, "SELECT * FROM `order` WHERE userName = '$userName'");

            if (mysqli_num_rows($orders) > 0) {
                while ($row = mysqli_fetch_array($orders)) {
                    $orderId = $row['id'];
                    $orderDate = $row['date'];
                    $totalSumResult = mysqli_query($con, "SELECT SUM(price * quantity) AS totalSum FROM productinorder WHERE orderNum = $orderId");
                    $totalSumRow = mysqli_fetch_array($totalSumResult);
                    $totalSum = $totalSumRow['totalSum'] ? $totalSumRow['totalSum'] : 0;
                    // שליפת שמות המוצרים שנרכשו בהזמנה זו
                    $productNames = [];
                    $productResult = mysqli_query($con, "SELECT p.name FROM product p JOIN productinorder pi ON p.id = pi.productID WHERE pi.orderNum = $orderId");
                    while ($productRow = mysqli_fetch_array($productResult)) {
                        $productNames[] = $productRow['name'];
                    }
                    $productNamesString = implode(", ", $productNames);
                    // הצגת שורה בטבלה
                    echo "<tr>";
                    echo "<td>" . $orderId . "</td>";
                    echo "<td>" . $orderDate . "</td>";
                    echo "<td>" . $totalSum . " ₪</td>";
                    echo "<td>" . $productNamesString . "</td>";
                    echo "</tr>";
                }
            } else {
                // אם אין הזמנות קודמות
                echo "<tr>";
                echo "<td colspan='4'>אין הזמנות קודמות</td>";
                echo "</tr>";
            }

            mysqli_close($con);
            ?>
        </tbody>
    </table>
</div>
</body>
</html>