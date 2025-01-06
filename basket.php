<?php
include 'nav.php';
include 'db_connection.php';
$con = OpenCon();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
</head>
<body dir="rtl">
<div class="cardContainer">
<?php
$product = mysqli_query($con,"SELECT * FROM cart c join product p on c.productID=p.id WHERE c.userName='".$_SESSION['userName']."'");
while($row = mysqli_fetch_array($product)){
    // if($row['userName'] = $_SESSION['userName'] )
    echo '<div class="card">
        <img class="card-img-top" src="' . $row["image"] . '" alt="' . $row["name"] . '">
        <div class="card-body">
            <h5 class="card-title">' . $row["name"] . '</h5>
            <p class="card-text">מחיר: ₪' . $row["price"] . '</p>
            <p class="card-text">כמות נבחרת: ' . $row["chosenQuantity"] . '</p>
            <div>
                <input id="quantity-' . $row["id"] . '" class="quantity-input" type="number" min="1" max="' . $row["quantity"] . '" placeholder="1">
                <button onclick="return validateQuantity(' . $row["quantity"] . ', ' . $row["id"] . ')">עדכון כמות </button>
            </div>

        </div>
    </div>';
}
?>
</div>


</body>
</html>