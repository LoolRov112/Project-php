<?php
include 'nav.php';
include 'db_connection.php';
$con = OpenCon();
if (isset($_POST['delete'])) {
    $product_id = $_POST['product_id'];
    $user_name = $_SESSION['userName'];
    $delete_query = "DELETE FROM cart WHERE userName = '$user_name' AND productID = $product_id";
    mysqli_query($con, $delete_query);
    echo "<script>alert('המוצר נמחק מהסל');</script>";
}

if (isset($_POST['update_quantity'])) {
    $product_id = $_POST['product_id'];
    $new_quantity = $_POST['quantity'];

    if ($new_quantity > 0) {
        $user_name = $_SESSION['userName'];
        $update_query = "UPDATE cart SET chosenQuantity = $new_quantity WHERE userName = '$user_name' AND productID = $product_id";
        if (mysqli_query($con, $update_query)) {
            echo '<script>alert("הכמות עודכנה בהצלחה!");</script>';
        } else {
            echo '<script>alert("שגיאה בעדכון הכמות.");</script>';
        }
    } else {
        echo '<script>alert("הכמות לא יכולה להיות אפס או שלילית.");</script>';
    }
}
if(isset($_POST['confirm'])){
    $userName = $_SESSION['userName'];
    mysqli_query($con, "INSERT INTO `order` VALUES (null, '".$userName."', NOW())");
    // משיכת מספר ההזמנה האחרון
    $result = mysqli_query($con, "SELECT max(id) AS orderNum FROM `order` WHERE userName='".$userName."'");
    $row = mysqli_fetch_array($result);
    $orderNum = $row['orderNum'];
    $cart = mysqli_query($con, "SELECT * FROM cart WHERE userName = '".$userName."'");
    while($row = mysqli_fetch_array($cart)){
        // שליפת המחיר של המוצר
        $productPriceResult = mysqli_query($con, "SELECT price, quantity FROM product WHERE id ='".$row['productID']."'");
        $productPriceRow = mysqli_fetch_array($productPriceResult);
        $productPrice = $productPriceRow['price'];
        $currentStock = $productPriceRow['quantity']; // מלאי נוכחי של המוצר
        // עדכון המלאי של המוצר
        $newStock = $currentStock - $row['chosenQuantity'];
        if($newStock >= 0){
             $update_stock = mysqli_query($con, "UPDATE product SET quantity = '".$newStock."' WHERE id = '".$row['productID']."'");
             $insert_order = mysqli_query($con, "INSERT INTO productinorder VALUES ('".$orderNum."', '".$userName."', '".$row['productID']."', '".$row['chosenQuantity']."', '".$productPrice."')");
        }
        else{
            $update_stock = mysqli_query($con, "UPDATE cart SET chosenQuantity = '".$currentStock."' WHERE productID = '".$row['productID']."'");
            echo "<script>
            alert('הכמות אינה תקינה, כמות עודכנה בסל');</script>";
            header("Refresh:0.5");
            return;
        }
    }
    // מחיקת המוצרים מה-cart של המשתמש
    $delete_cart = mysqli_query($con, "DELETE FROM cart WHERE userName = '".$userName."'");
    echo "<script>
        alert('הזמנתך בוצעה בהצלחה');</script>";
}
$cartFound = false;

?>
<script>
function validateQuantity(stock, id) {
    const quantity = document.getElementById('quantity-' + id).value;
    if (quantity > stock || quantity <= 0) {
        alert('הכמות אינה תקינה');
        return false;
    }
    alert('הכמות הוזנה בהצלחה!');
    return true;
}

function openOrderPopup() {
    const popup = document.getElementById('orderPopup');
    popup.style.display = 'block';
}

function closeOrderPopup() {
    const popup = document.getElementById('orderPopup');
    popup.style.display = 'none';
}
</script>
<style>
    .order-button-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100px; 
    margin-top: 20px; 
}
.order-button {
    background-color: #4CAF50; 
    color: white; 
    border: none;
    padding: 15px 30px;
    font-size: 18px; 
    border-radius: 10px;
    cursor: pointer;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    transition: transform 0.2s, background-color 0.2s;
}

.order-button:hover {
    background-color: #45a049;
    transform: scale(1.05);
}

.order-button:active {
    transform: scale(0.95); /* הנמכה קלה בלחיצה */
}
    body {
    margin-top: 4em;
    font-family: Arial, sans-serif;
}
.cardContainer {
    display: flex;
    flex-wrap: wrap;  
    justify-content: center;
    gap: 20px;  
    margin: 0 auto; 
}
.card {
    width: 18rem;
    border-radius: 15px;
    border: 1px solid #ccc; 
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    background-color: beige;
    display: flex;
    flex-direction: column;
    transition: transform 0.5s;
}
.card:hover {
    transform: scale(1.1);
}
.card-img-top {
    width: 100%;
}
.card-body {
    padding: 15px;
    
}
.card-title {
    font-size: 1.5em;
    font-weight: bold;
}
.card-text {
    font-size: 14px;
    color: #333;
    line-height: 1.5;
    font-size: 1.3em;
}
.popup {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 80%;
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    border-radius: 10px;
    z-index: 1000;
    padding: 20px;
    box-sizing: border-box;
}
.popup-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 999;
}
.close-btn {
    background: red;
    color: white;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
    border-radius: 5px;
}


.popup {
  display: none;
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 60%; /* התאמה לגודל הדף */
  background-color: beige; /* התאמה לצבע כרטיסים */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* צל */
  border-radius: 15px; /* פינות מעוגלות */
  z-index: 1000;
  padding: 20px;
  box-sizing: border-box;
  font-family: Arial, sans-serif; /* התאמה לפונט */
  text-align: center;
  animation: fadeIn 0.3s ease-in-out; /* אנימציה לפתיחה */
}

.popup h2 {
  margin-bottom: 15px;
  font-size: 24px;
  color: #333;
}

.popup table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 10px;
  margin-bottom: 20px;
}

.popup table th,
.popup table td {
  border: 1px solid #ccc;
  padding: 10px;
  font-size: 16px;
}

.popup table th {
  background-color: #4CAF50;
  color: white;
}

.popup table td {
  background-color: #fff;
}

.popup h3 {
  margin-top: 20px;
  font-size: 20px;
  color: #333;
}

.popup form {
  margin-top: 15px;
}

.popup input[type="text"] {
  width: 80%;
  padding: 10px;
  margin: 10px 0;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 16px;
}

.popup button {
  background-color: #4CAF50;
  color: white;
  border: none;
  padding: 10px 20px;
  font-size: 16px;
  border-radius: 5px;
  cursor: pointer;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  transition: transform 0.2s, background-color 0.2s;
}

.popup button:hover {
  background-color: #45a049;
  transform: scale(1.05);
}

.popup .close-btn {
  position: absolute;
  top: 10px;
  right: 10px;
  background-color: red;
  color: white;
  border: none;
  padding: 5px 10px;
  border-radius: 50%;
  font-size: 16px;
  cursor: pointer;
}

.popup .close-btn:hover {
  background-color: darkred;
}

.popup-overlay {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  z-index: 999;
}

@keyframes fadeIn {
  from {
      opacity: 0;
      transform: translate(-50%, -55%);
  }
  to {
      opacity: 1;
      transform: translate(-50%, -50%);
  }
}
</style>
<!DOCTYPE html>
<html lang="en">
    <head>
    <script src='basket.js'></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>סל קניות</title>
    
</head>
<body dir="rtl">
<div>
<div class="cardContainer">
<?php
$cnt=0;
$product = mysqli_query($con,"SELECT * FROM cart c join product p on c.productID=p.id WHERE c.userName='".$_SESSION['userName']."'");
while($row = mysqli_fetch_array($product)){
    $cnt++;
    echo '<div class="card">
        <img class="card-img-top" src="imgs/' . $row["image"] . '" alt="' . $row["name"] . '">
        <div class="card-body">
            <h5 class="card-title">' . $row["name"] . '</h5>
            <p class="card-text">מחיר: ₪' . $row["price"] . '</p>
            <p class="card-text">כמות נבחרת: ' . $row["chosenQuantity"] . '</p>
            <form action="" method="POST">
                <input id="quantity-' . $row["id"] . '" class="quantity-input" type="number" name="quantity" min="1" max="' . $row["quantity"] . '" placeholder="1">
                <input type="hidden" name="product_id" value="' . $row["productID"] . '">
                <button type="submit" name="update_quantity">עדכון כמות</button>
            </form>
            <form method="POST">
                <input type="hidden" name="product_id" value="' . $row["productID"] . '">
                <button  type="submit" name="delete">🗑️</button>
            </form>
        </div>           
    </div>';
}
if($cnt>0){
        echo'</div><div class="order-button-container">
                <button class="order-button" onclick="openOrderPopup()">אישור הזמנה</button>
            </div>';
        }
else '</div>';
?>




<div id="orderPopup" class="popup">
    <button class="close-btn" onclick="closeOrderPopup()">✖</button>
    <h2>פרטי הזמנה</h2>
    <table>
        <thead>
            <tr>
                <th>שם מוצר</th>
                <th>כמות</th>
                <th>מחיר</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $orderTotal = 0;
            mysqli_data_seek($product, 0); // Reset pointer to reuse the query result
            while ($row = mysqli_fetch_array($product)) {
                echo '<tr>
                    <td>' . $row["name"] . '</td>
                    <td>' . $row["chosenQuantity"] . '</td>
                    <td>₪' . ($row["price"] * $row["chosenQuantity"]) . '</td>
                </tr>';
                $orderTotal += $row["price"] * $row["chosenQuantity"];
            }
            ?>
        </tbody>
    </table>
    <h3>סה"כ להזמנה: ₪<?php echo $orderTotal; ?></h3>
    <form method="POST" onsubmit="return validateCreditCardForm()">
        <label for="credit-card">מספר כרטיס אשראי (16 ספרות):</label><br>
        <input type="text" id="credit-card" name="credit-card" required>
        <br><br>
        <label for="cvv">קוד CVV (3 ספרות):</label><br>
        <input type="text" id="cvv" name="cvv" required>
        <br><br>
        <label for="expiry-date">תאריך תפוגה (MM/YY):</label><br>
        <input type="text" id="expiry-date" name="expiry-date" required>
        <br><br>
        <button type="submit" name="confirm">אישור</button>
    </form>
</div>
<div class="popup-overlay" id="popupOverlay" onclick="closeOrderPopup()"></div>
</div>
</body>
</html>
