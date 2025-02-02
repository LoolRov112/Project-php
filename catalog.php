<?php
include 'nav.php';
include 'db_connection.php';
$con = OpenCon();
$cart = mysqli_query($con,"SELECT * FROM cart");

if (isset($_POST["submit"])) {
    $userName = $_SESSION['userName'];
    $productID = $_POST['id'];
    $quantity = $_POST['quantity'];
    $found = false;
    if ($quantity > 0) {
        while ($row = mysqli_fetch_array($cart)) {
            if ($row['userName'] == $userName && $row['productID'] == $productID) {
                $productQuery = "SELECT quantity FROM product WHERE id = $productID";
                $productResult = mysqli_query($con, $productQuery);
                $productRow = mysqli_fetch_assoc($productResult);
                if ($productRow) {
                    $stockQuantity = $productRow['quantity'];
                    $newQuantity = $row['chosenQuantity'] + $quantity;
                    if ($newQuantity > $stockQuantity) {
                        echo "<script>alert('לא ניתן להוסיף כמות זו לסל. חורגת מהמלאי הקיים.');</script>";
                        $found = true;
                        break;
                    }                    
                    $update_cart = "UPDATE cart SET chosenQuantity = $newQuantity WHERE userName = '$userName' AND productID = $productID";
                    mysqli_query($con, $update_cart);
                    echo "<script>alert('המוצר עודכן בהצלחה בסל!');</script>";
                    $found = true;
                    break;
                }
            }
        }
        // אם המוצר אינו בסל, מבוצעת הוספה
        if (!$found) {
            $insert_order = "INSERT INTO cart VALUES('$userName', $productID, $quantity)";
            mysqli_query($con, $insert_order);
            echo "<script>alert('המוצר נוסף בהצלחה לסל!');</script>";
        }
    } else {
        echo "<script>alert('יש להזין כמות תקינה.');</script>";
    }
}
if(isset($_POST['update'])){
    $quantity= $_POST['changeQuantity'];
    $productID = $_POST['id'];
    $update_quantity = "UPDATE product set quantity = $quantity where id = $productID";
    mysqli_query($con, $update_quantity);
    echo "<script>
            alert('הכמות עודכנה בהצלחה');</script>";
            header("Refresh:0.5 catalog.php");
}

?>
<html>
<head>
<style>
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
</style>
<script>
function validateQuantity(stock, id) {
    const quantity = document.getElementById('quantity-' + id).value;
    if (quantity > stock || quantity <= 0) {
        alert('הכמות אינה תקינה');
        return false;
    }
    return true;
}
</script>
</head>
<body dir="rtl">
    <?php
    if (isset($_SESSION['fName']) && isset($_SESSION['lName'])){
    if ($_SESSION['isManager'] == 1) {
        echo '<div>
            <button onclick="window.location.href=\'newProduct.php\'">הוסף מוצר</button>
        </div>';
}
}
?>
<div class="cardContainer">
<?php
$product = mysqli_query($con,"SELECT * FROM product");
while($row = mysqli_fetch_array($product)){
    echo '<div class="card">
        <img class="card-img-top" src="imgs/' . $row["image"] . '" alt="' . $row["name"] . '">
        <div class="card-body">
            <h5 class="card-title">' . $row["name"] . '</h5>
            <p class="card-text">' . $row["description"] . '</p>
            <p class="card-text">מחיר: ₪' . $row["price"] . '</p>
            <div>
            <p class="card-text">כמות במלאי: ' . $row["quantity"] . '</p>';
            if (isset($_SESSION['fName']) && isset($_SESSION['lName'])){
            if($_SESSION['isManager']==1){
                echo '<form method="POST">
                    <input type="hidden" name="id" value="' . $row["id"] . '">
                    <input type="number" id="changeQuantity" name="changeQuantity">
                    <button name="update"> עדכן כמות</button>
                    </form>';
            };
        };
            
            echo '</div>';
            if (isset($_SESSION['fName']) && isset($_SESSION['lName'])){
            if($_SESSION['isManager']==0){
            echo '<form method="POST">
                <input type="hidden" name="id" value="' . $row["id"] . '">
                <input id="quantity-' . $row["id"] . '" class="quantity-input" name="quantity" type="number" min="1" max="' . $row["quantity"] . '" placeholder="0">
                <button name= "submit" onclick="return validateQuantity(' . $row["quantity"] . ', ' . $row["id"] . ')">הוסף לסל</button>
            </form>';
            };
        };
        echo '</div>
    </div>';
}
?>
</div>

</body></html>
