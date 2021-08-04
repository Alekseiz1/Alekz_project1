<?php
session_start();

$conn = new SQLite3("db/db_user") or die ("unable to open datebase");
function createTable($sqlStmt, $tableName)
{
    global $conn;
    $stmt = $conn->prepare($sqlStmt);
    if ($stmt->execute()) {
        //echo "<p style='color: green'>".$tableName. ": Table Created Successfully</p>";
    } else {
        echo "<p style='color: red'>".$tableName. ": Table Created Failure</p>";
    }
}

function addUser($username, $unhashedPassword, $name,$profilePic ,$accessLevel) {
   global $conn;
   $hashedPassword = password_hash($unhashedPassword,PASSWORD_DEFAULT);
   $sqlstmt = $conn->prepare("INSERT INTO user (username, password, name,profilePic,accessLevel)VALUES (:userName,:hashedPassword,:name,:profilePic,:accessLevel)");
   $sqlstmt->bindValue(':username',$username);
   $sqlstmt->bindValue(':hashedPassword',$hashedPassword);
   $sqlstmt->bindValue(':name',$name);
   $sqlstmt->bindValue(':profilePic',$profilePic);
   $sqlstmt->bindValue(':accessLevel',$accessLevel);
    if ($sqlstmt->execute()) {

       // echo "<p style='color: green'>User:".$username.":User Created Succesfully</p>";
    }else{  echo "<p style='color: red'>User:".$username.":User Created Failure</p>";

    }
}

$query = file_get_contents("SQL/create-user.sql");
createTable($query,"User");
$query = file_get_contents("SQL/create-messaging.sql");
createTable($query,"Messaging");
$query = file_get_contents("sql/create-orderDetails.sql");
createTable($query,"Order Details");
$query = file_get_contents("sql/create-products.sql");
createTable($query,"Products");

$query= $conn->query("SELECT COUNT(*) as count FROM user");
$rowCount = $query->fetchArray();
$userCount = $rowCount["count"];

if ($userCount == 0) {
    addUser("admin", "admin", "Administrator", "admin.jpg", "Administrator");
    addUser("user", "user", "User", "user.jpg", "User");
    addUser("alek", "alek", "Alek", "alek.jpg", "User");
}
function add_product($productName, $productCategory, $productQuantity, $productPrice, $productImage, $productCode) {
    global$conn;
    $sqlstmt = $conn->prepare("INSERT INTO products (productName, category, quantity, price, image, code) VALUES (:name, :category, :quantity, :price, :image, :code)");
    $sqlstmt->bindValue(':name', $productName);
    $sqlstmt->bindValue(':category', $productCategory);
    $sqlstmt->bindValue(':quantity', $productQuantity);
    $sqlstmt->bindValue(':price', $productPrice);
    $sqlstmt->bindValue(':image', $productImage);
    $sqlstmt->bindValue(':code', $productCode);

    if($sqlstmt->execute()) {
    //    echo"<p style='color: green'>Product:".$productName.": Created Successfully</p>";
    }else{
        echo"<p style='color: red'>Product:".$productName.": Created Failure</p>";
    }
}
$query= $conn->query("SELECT COUNT(*) as count FROM products");
$rowCount = $query->fetchArray();
$productCount = $rowCount["count"];

if($productCount == 0) {
    add_product('False Sarsaparilla','Plants - Medicinal', 29, 26.11,'4389883142_5142ceb6a7_b.jpg','a4d84470');

}

?>