<?php
include 'nav.php';
include 'db_connection.php';
$con = OpenCon();

if(isset($_POST["addProduct"])){
$name = $_POST['name'];
$des = $_POST['description'];
$img = $_POST['image'];
echo $_POST['image'];
$file = 'C:\xampp\htdocs\Labs\Project\Project-php\imgs\Avocado2.jpg';
$newFile = 'C:\xampp\htdocs\Labs\Project\Project-php\imgs\test\Avocado2.jpg';
if(!copy($file,$newFile)){
    echo "fail to copy $file";
}else{
    "copied $file into $newFile\n";
}
$price = $_POST['price'];
$qun = $_POST['quantity'];
$insert = "INSERT INTO `product`(id, `name`, `description`, `image`, `price`, `quantity`)
             VALUES (null,'".$name."','".$des."','".$img."',$price,$qun)";
 mysqli_query($con, $insert);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>הוספת מוצר</title>
    <style>
        .body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background-color: #ffffff;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
        }
        .form-group input, 
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }
        .form-group textarea {
            resize: none;
        }
        .form-group input[type="file"] {
            padding: 3px;
        }
        .form-group button {
            background-color: #007BFF;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease;
        }
        .form-group button:hover {
            background-color: #0056b3;
        }
        .form-container .note {
            font-size: 12px;
            color: #777;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body dir="rtl">
    <div class="body">
    <div class="form-container">
        <h2>הוספת מוצר חדש</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">שם המוצר:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="description">תיאור:</label>
                <textarea id="description" name="description" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="image">תמונה:</label>
                <input type="file" id="image" name="image" required>
            </div>
            <div class="form-group">
                <label for="price">מחיר:</label>
                <input type="number" id="price" name="price" min="0" required>
            </div>
            <div class="form-group">
                <label for="quantity">כמות במלאי:</label>
                <input type="number" id="quantity" name="quantity" min="0" required>
            </div>
            <div class="form-group">
                <button type="submit" name="addProduct">הוסף מוצר</button>
            </div>
        </form>
        <div class="note">
            <p>* כל השדות נדרשים למילוי</p>
        </div>
    </div>
    </div>
</body>
</html>
