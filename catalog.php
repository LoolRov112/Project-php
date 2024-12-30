<?php
include 'nav.php';
include 'db_connection.php';
$con = OpenCon();
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
    background-color: #fff;
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
    background-color: beige;
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
    if (quantity > stock) {
        alert('כמות המבוקשת גדולה מהמלאי הקיים!');
        return false;
    }
    alert('הכמות הוזנה בהצלחה!');
    return true;
}
</script>
</head>
<body dir="rtl">
<div class="cardContainer">
<?php
$product = mysqli_query($con,"SELECT * FROM product");
while($row = mysqli_fetch_array($product)){
    echo '<div class="card">
        <img class="card-img-top" src="' . $row["image"] . '" alt="' . $row["name"] . '">
        <div class="card-body">
            <h5 class="card-title">' . $row["name"] . '</h5>
            <p class="card-text">' . $row["description"] . '</p>
            <p class="card-text">מחיר: ₪' . $row["price"] . '</p>
            <p class="card-text">כמות במלאי: ' . $row["quantity"] . '</p>

        </div>
    </div>';
}
?>
</div>

<div align="center" style="margin-top:2em">
    <form method="post" enctype="multipart/form-data">
        בחר קובץ להעלאה
        <input type="file" name ='test' id="fileToUpload">
        <br>
        <br>
            <!-- <input type="file" name="file2" id="fileToUpload"> -->
        <br>
        <input type="submit" value="השוואה" name="submit">
    </form>
</div>

<?php   
 
if(isset($_POST["submit"])){
    echo $_POST['test'];
    // $file1= fopen($_POST['file1'], "r");
    // $file2= fopen($_POST["file2"], "r");
    // echo $file1;
    // $flag=0;
    // while(!feof($file1) || !feof($file2)){
    //     if(strcasecmp(fgetc($file1) , fgetc($file2))!=0){
    //         echo '<p>לא זהים</p>';
    //         $flag=1;
    //         break;
    //     }
    // }
    // if($flag==0)
    //     echo '<p>קבצים זהים</p>';
    // fclose($file1);
    // fclose($file2);
}
?>
</body></html>
